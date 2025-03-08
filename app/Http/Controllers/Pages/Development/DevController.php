<?php

namespace App\Http\Controllers\Pages\Development;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Models\Administration\CronFailure;

class DevController extends Controller
{
    protected $modelName = 'Dashboard';
    protected $routeName = 'dashboard.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct()
    {
        $this->isDestroyingAllowed = true;
    }

    public  function getRoutes(Request $request)
    {
        try {
            $routes = Route::getRoutes()->get();

            return view('pages/development/route-list', [
                'title' =>   'Route Lis',
                'routes' =>   $routes,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public  function viewCronFailed($id, Request $request)
    {
        try {

            $CronFailure =  CronFailure::find($id);

            return view('pages/development/cron-failed', [
                'title' =>   'Cron Failed',
                'CronFailure' =>   $CronFailure,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public  function fixedCronFailed($id, Request $request)
    {
        try {

            $cronFailure = CronFailure::find($id);

            if ($cronFailure) {
                CronFailure::where('job_name', $cronFailure->job_name)
                    ->update(['is_fixed' => 1]);

                return back()->with('success', 'Job status updated successfully.');
            } else {
                return back()->with('error', 'Job not found.');
            }

            return redirect()->back()->with('success', 'Issue have been updated successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function fixedCronFailedList(Request $request)
    {
        $records = CronFailure::filter($request)
            // ->orderBy('failed_at', 'desc')
            ->orderBy('is_fixed', 'asc')
            ->paginate(10)
            ->withQueryString();

        // $CronFailure =  CronFailure::find($id);
        // logActivity('Warehouse Sync History', 'Warehouse Sync History', 'View');

        return view('pages/development/cron-failed-list', [
            'title' =>   'Scheduler Failed History',
            'records' =>   $records ?? [],
        ]);
    }

    public function Permissions(Request $request)
    {
        if ($request->ajax()) {
            $permissions = [
                'isDelete' =>  false,
                'isEdit' => false,
                'isView' => false,
                'isPrint' => false
            ];

            $permissionList = DB::table('permissions');

            return Datatables::of($permissionList)->addIndexColumn()
                ->addColumn('action', function ($permissionList) use ($permissions) {
                    return actionBtns(
                        $permissionList->id,
                        'user.edit',
                        'user',
                        '',
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages/development/permission', [
            'title' =>   'permission Lis',
        ]);
    }
}
