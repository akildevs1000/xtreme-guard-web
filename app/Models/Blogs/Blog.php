<?php

namespace App\Models\Blogs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'author',
        'category',
        'tag',
        'image',
        'status'
    ];
}
