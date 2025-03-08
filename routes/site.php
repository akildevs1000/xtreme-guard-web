<?php

use App\Http\Controllers\Site\Home\HomeController;
use App\Http\Controllers\Site\Organization\ContactController;
use App\Http\Controllers\Site\Product\ProductController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('site.test');
// });

Route::resource('/', HomeController::class);
Route::resource('product', ProductController::class);
Route::resource('contact', ContactController::class);
