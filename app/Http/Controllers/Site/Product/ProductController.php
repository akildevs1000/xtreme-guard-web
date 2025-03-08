<?php

namespace App\Http\Controllers\Site\Product;

use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        // return $products;
        return view('site.product.products', [
            'products' => $products,
            'categories' => $products,
        ]);
    }

    public function show(string $id)
    {

        $product = Product::whereId($id)->with('gallery', 'category', 'attributes', 'files')->first();
        // return $product;
        return view('site.product.show', [
            'product' => $product,
        ]);
    }
}
