<?php

namespace App\Http\Controllers\Pages\Contact;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Contact\Contact;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Repositories\Contact\ContactRepo;
use App\Http\Requests\Contact\StoreRequest;

class ContactController extends Controller
{
    protected $modelName = 'Contact';
    protected $routeName = 'contacts.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(Contact $model, ContactRepo $repo)
    {
        $this->model = $model;
        $this->repo = $repo;
        $this->isDestroyingAllowed = true;
    }

    public function index(Request $request)
    {
        // return $this->model->query()->get();

        if ($request->ajax()) {

            $permissions = [
                'isDelete' => true,
                'isEdit' => false,
                'isView' => false,
                'isPrint' => false
            ];

            $model = $this->model->query();
            // return $this->model->query()->get();

            logActivity('Contact Master', 'Contact Master', 'View');

            return Datatables::of($model)->addIndexColumn()
                ->addColumn('action', function ($model) use ($permissions) {
                    return actionBtns(
                        $model->id,
                        'contacts.edit',
                        'contacts',
                        $model->name,
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.contact.index', [
            'title' =>   $this->modelName,
        ]);
    }

    // public function store(Request $request)
    public function store(StoreRequest $request)
    {
        try {
            // return $request->all();

            $created =  $this->repo->createContact($request);
            if ($created) {
                return  $this->response($this->modelName . ' created successfully', ['data' => $created], true);
            }
        } catch (\Throwable $th) {
            return  $this->response($th->getMessage(), null, false);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
