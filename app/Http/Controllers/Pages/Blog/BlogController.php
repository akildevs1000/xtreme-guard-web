<?php

namespace App\Http\Controllers\Pages\Blog;

use App\Models\Blogs\Blog;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use App\Repositories\BlogRepo\BlogRepo;
use App\Http\Requests\Blog\StoreRequest;

class BlogController extends Controller
{
    protected $modelName = 'Blog';
    protected $routeName = 'blogs.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(Blog $model, BlogRepo $repo)
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
                'isEdit' => true,
                'isView' => false,
                'isPrint' => false
            ];

            $model = $this->model->query();
            // return $this->model->query()->get();

            logActivity($this->modelName . 'Master', $this->modelName . ' Master', 'View');

            return Datatables::of($model)->addIndexColumn()
                ->addColumn('action', function ($model) use ($permissions) {
                    return actionBtns(
                        $model->id,
                        'blogs.edit',
                        'blogs',
                        $model->name,
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.blog.index', [
            'title' =>   $this->modelName,
        ]);
    }

    public function create()
    {
        return view('pages.blog.create', [
            'categories' => Category::get(['id', 'name']),
            'title' =>   $this->modelName,
        ]);
    }

    // public function store(Request $request)
    public function store(StoreRequest $request)
    {
        try {
            $created =  $this->repo->createBlog($request);
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
