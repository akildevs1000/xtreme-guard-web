<?php

namespace App\Models\Category;

use App\Helpers\Media;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Media;

    protected $fillable = [
        'name',
        'slug',
        'img',
        'is_active',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function getImgAttribute($value)
    {
        // Define the default image URL
        $defaultImage = 'https://hancockogundiyapartners.com/wp-content/uploads/2019/07/dummy-profile-pic-300x300.jpg';

        // Check if the value is empty
        if (!$value) {
            return $defaultImage;
        }

        // Check if the file exists in storage
        if (Storage::exists('public/' . $value)) {
            return asset('storage/' . $value);
        } else {
            return $defaultImage;
        }
    }
}
