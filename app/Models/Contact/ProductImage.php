<?php

namespace App\Models\Product;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'image'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageAttribute($value)
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
