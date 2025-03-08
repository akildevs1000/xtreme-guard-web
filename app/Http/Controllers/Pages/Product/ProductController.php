<?php

namespace App\Http\Controllers\Pages\Product;

use App\Models\User;
use App\Models\Product\ProductImage;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepo;
use App\Http\Requests\Product\StoreRequest;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    protected $modelName = 'Product';
    protected $routeName = 'product.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(Product $model, ProductRepo $repo)
    {
        $this->model = $model;
        $this->repo = $repo;
        $this->isDestroyingAllowed = true;
    }


    public function index1(Request $request)
    {
        if ($request->ajax()) {

            $permissions = [
                'isDelete' => true,
                'isEdit' => true,
                'isView' => true,
                'isPrint' => false
            ];

            $user = $this->model->query();
            // return $this->model->query()->get();
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

        return view('pages.product.index', [
            'title' =>   $this->modelName,
        ]);
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

            $product = $this->model->query();
            // return $this->model->query()->get();

            logActivity('User Master', 'User Master', 'View');

            return Datatables::of($product)->addIndexColumn()
                ->addColumn('action', function ($product) use ($permissions) {
                    return actionBtns(
                        $product->id,
                        'product.edit',
                        'product',
                        $product->name,
                        $permissions
                    );
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.product.index', [
            'title' =>   $this->modelName,
        ]);
    }

    public function create()
    {
        return view('pages.product.create', [
            'categories' => Category::get(['id', 'name']),
            'title' =>   $this->modelName,
        ]);
    }

    // public function store(Request $request)
    public function store(StoreRequest $request)
    {
        try {

            // return $request->all();

            $created =  $this->repo->createProduct($request);
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
