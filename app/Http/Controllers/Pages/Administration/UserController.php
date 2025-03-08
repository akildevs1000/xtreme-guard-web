<?php

namespace App\Http\Controllers\Pages\Administration;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Administration\UserLoginActivityLog;

class UserController extends Controller
{
    protected $modelName = 'User';
    protected $routeName = 'user.index';
    protected $isDestroyingAllowed;
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
        $this->isDestroyingAllowed = true;
        $this->middleware('userpermission:administration-users-view')->only('index');
        $this->middleware('userpermission:administration-users-edit')->only('edit');
        $this->middleware('userpermission:administration-user-activity-view')->only('userActivity');
        $this->middleware('userpermission:administration-logged-users-tracking-view')->only('loggedUserTracking');

        // administration-logged-users-tracking-view
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $permissions = [
                'isDelete' => can('administration-users-delete'),
                'isEdit' => can('administration-users-edit'),
                'isView' => false,
                'isPrint' => false
            ];

            $user = $this->model->query();

            // if ($request->has('role') && $request->filled('role') && $request->role != -1) {
            //     $user->whereHas('roles', function ($q) use ($request) {
            //         $q->where('name', $request->role);
            //     });
            // }

            logActivity('User Master', 'User Master', 'View');

            return Datatables::of($user)->addIndexColumn()
                ->addColumn('action', function ($user) use ($permissions) {
                    return actionBtns(
                        $user->id,
                        'user.edit',
                        'administration/user',
                        $user->username,
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages/administration/user/index', [
            'title' =>   $this->modelName,
        ]);
    }

    public function userActivity(Request $request)
    {
        if ($request->ajax()) {

            $permissions = [
                'isDelete' =>  false,
                'isEdit' => can('administration-users-edit'),
                'isView' => false,
                'isPrint' => false
            ];

            $userLogs = DB::table('user_logs')
                ->where('log_action', '!=', 'View');
            // ->orderBy('created_at', 'desc');


            logActivity('User Activity', 'User Activity', 'View');

            return Datatables::of($userLogs)->addIndexColumn()
                ->addColumn('action', function ($userLogs) use ($permissions) {
                    return actionBtns(
                        $userLogs->id,
                        'user.edit',
                        'user',
                        '',
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages/administration/user/user-activity', [
            'title' =>   'User Activity',
        ]);
    }

    public function loggedUserTracking(Request $request)
    {
        if ($request->ajax()) {
            $permissions = [
                'isDelete' =>  false,
                'isEdit' => false,
                'isView' => false,
                'isPrint' => false
            ];

            $baseUrl = config('app.url') . '/public/storage/';
            $defaultImg = asset('storage/demo/dm-profile.jpg');


            $loggedUserModel = UserLoginActivityLog::select([
                'user_login_activity_logs.id', // Explicitly mention the table
                'user_login_activity_logs.user_id',
                // 'ut.img as user_img',
                'action as login_status',
                'ip_address',
                'device',
                'os',
                'browser',
                'login_time',
                'logout_time',
                'status',
                'ut.username',

                DB::raw("
                CASE
                    WHEN ut.img IS NULL OR ut.img = '' THEN '$defaultImg'
                    ELSE CONCAT('$baseUrl', ut.img)
                END AS user_img
                    "),

                DB::raw(
                    "CONCAT(
                        '<div class=\"d-flex align-items-center mb-3\">',
                        '<div class=\"flex-shrink-0 avatar-sm\">',
                        '<div class=\"avatar-title bg-light text-primary rounded-4\" style=\"font-size:30px\">',
                        CASE
                            WHEN device = 'Mobile' THEN '<i class=\"ri-smartphone-line\"></i>'
                            WHEN device = 'Tablet' THEN '<i class=\"ri-tablet-line\"></i>'
                            WHEN device = 'Desktop' THEN '<i class=\"ri-computer-line\"></i>'
                            ELSE '<i class=\"ri-question-line\"></i>'
                        END,
                        '</div>',
                        '</div>',
                        '<div class=\"flex-grow-1 ms-3\">',
                        '<h6>', device, '</h6>',
                        '<p class=\"text-muted mb-0\">',
                        'User <b>', ut.username , '</b> logged in successfully using <b>', IFNULL(browser, ''), '</b> on a running <b>', os,
                        '</b><b> ', DATE_FORMAT(login_time, '%M %d at %l:%i %p'), '</b> from the IP address <b>', ip_address, '</b>',
                        '</p>',
                        '</div>',
                        '</div>'
                    ) AS formatted_message"
                )
            ])->orderByDesc('login_time')
                ->whereNotNull('login_time')
                ->join('users as ut', 'ut.id', '=', 'user_login_activity_logs.user_id');

            logActivity('Logged User History', 'Logged User History', 'View');

            return Datatables::of($loggedUserModel)->addIndexColumn()
                ->addColumn('action', function ($loggedUserModel) use ($permissions) {
                    return actionBtns(
                        $loggedUserModel->id,
                        'user.edit',
                        'user',
                        '',
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages/administration/user/logged-user-tracking', [
            'title' =>   'Logged User History',
        ]);
    }

    public function create()
    {
        logActivity('User Create', 'User Create', 'View');
        return view('pages/administration/user/create', [
            'title' =>   'Create User',
            'roles' =>   Role::get(),
            'userWithRoles' => User::with('roles')->get()
        ]);
    }

    public function store(StoreRequest $request)
    {
        try {
            $created = $this->model->create($request->validated());

            if ($created) {
                logActivity('User Create', "User ID " . $created->id, 'Create');
                if ($request->hasFile('img')) {
                    $path =  $request->file('img')->store('profile', 'public');
                    $created->img = $path;
                    $created->save();
                }
                return  $this->response($this->modelName . ' created successfully', ['data' => $created], true);
            }
        } catch (\Throwable $th) {
            throw $th;
            return  $this->response($th->getMessage(), null, false);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(User $user)
    {
        try {
            // Load the user with roles eagerly loaded
            $userWithRoles = User::with('roles')->get();

            // Get attribute statistics
            $attributeStats = $this->getAttributeStats($user);

            logActivity('User Edit', 'User ID ' . $user->id, 'View');

            // return $this->getUserActivitesByuserId();

            return view('pages/administration/user/edit', [
                'roles' =>   Role::get(),
                'user' => $user,
                'title' =>   'Update User',
                'userWithRoles' => $userWithRoles,
                'userLogs' => $this->getUserActivitesByuserId($user->id) ?? [],
                'percentageFilled' => $attributeStats['percentageFilled'],
            ]);
        } catch (\Throwable $th) {
            // Handle any errors here if needed
            // Log or return an error response
            throw $th; // Uncomment this line if you want to throw the exception for debugging
        }
    }

    public function update(UpdateRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            // Check if the password is provided and hash it if it is
            if (!empty($data['password'])) {
                $data['password'] = $data['password'];
            } else {
                // If the password is not provided, remove it from the data array
                unset($data['password']);
            }

            $userUpdated = $user->update($data);
            if ($userUpdated) {
                logActivity('User Update', "User ID " . $user->id, 'Update');

                if ($request->hasFile('img')) {
                    $path = $request->file('img')->store('profile', 'public');
                    $user->img = $path;
                    $user->save();
                }
                return $this->response($this->modelName . ' updated successfully', ['data' => $user], true);
            }
        } catch (\Throwable $th) {
            return $this->response($th->getMessage(), null, false);
        }
    }

    public function destroy(User $User)
    {
        try {
            $deleted = $User->delete();
            if ($deleted) {

                logActivity('User Delete', "User ID " . $User->id, 'Delete');

                return $this->response($this->modelName . ' successfully deleted.', $deleted, true);
            } else {
                return $this->response($this->modelName . ' cannot deleted.', null, false);
            }
        } catch (\Throwable $th) {
            return $this->response($th, null, false);
        }
    }

    private function getAttributeStats(User $user)
    {
        // Convert user to array for easier manipulation
        $userArray = json_decode(json_encode($user), true);

        // Initialize counters
        // $totalAttributes = count($userArray) - 6;
        $totalAttributes = count($userArray);
        $filledAttributes = 0;

        // Count filled attributes
        foreach ($userArray as $key => $value) {
            if (!empty($value)) {
                $filledAttributes++;
            }
        }

        // Calculate percentage of filled attributes
        $percentageFilled = ($totalAttributes > 0) ? ($filledAttributes / $totalAttributes) * 100 : 0;

        // Return attribute statistics
        return [
            'totalAttributes' => $totalAttributes,
            'filledAttributes' => $filledAttributes,
            'percentageFilled' => round($percentageFilled, 0),
        ];
    }

    private function getUserActivitesByuserId($userId)
    {
        $logs = DB::table('user_logs')
            ->where('log_action', '!=', 'View')
            ->orderBy('created_at', 'desc')
            ->take(100)
            ->join('users as ut', 'ut.id', '=', 'user_logs.user_id')
            ->where('ut.id', $userId)
            ->get([
                'user_logs.user_id',
                'user_logs.user_name',
                'user_logs.form_name',
                'user_logs.form_record_id',
                'user_logs.log_action',
                'user_logs.created_at',
                'ut.img' // Image field from users
            ]);


        // Manually apply the image logic
        $defaultImage = 'https://hancockogundiyapartners.com/wp-content/uploads/2019/07/dummy-profile-pic-300x300.jpg';

        $userLogs = $logs->transform(function ($log) use ($defaultImage) {
            $log->img = !empty($log->img) && Storage::exists('public/' . $log->img)
                ? asset('storage/' . $log->img)
                : $defaultImage;
            return $log;
        });

        return $userLogs;
    }
}
