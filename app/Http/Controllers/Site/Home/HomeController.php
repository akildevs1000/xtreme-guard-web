<?php

namespace App\Http\Controllers\Site\Home;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category\Category;
use App\Models\Product\Product;

class HomeController extends Controller
{
    protected $modelName = 'Home';
    protected $routeName = 'user.index';
    protected $isDestroyingAllowed;
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
        $this->isDestroyingAllowed = true;

        // administration-logged-users-tracking-view
    }

    public function index(Request $request)
    {

        $products = Product::get();


        return view('site.home.index', [
            'categories' => Category::get(),
            'products' => $products,
        ]);
    }
}
