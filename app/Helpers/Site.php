<?php

use App\Models\Category\Category;

if (!function_exists('getCategories')) {
    function getCategories()
    {
        return Category::get();
    }
}
