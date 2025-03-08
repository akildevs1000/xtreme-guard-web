<?php

namespace App\Models\Contact;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Category\Category;
use App\Models\Product\ProductImage;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\ProductAttachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'company',
        'country'
    ];


    // public function setNameAttribute($value)
    // {
    //     $this->attributes['name'] = $value;
    //     $this->attributes['slug'] = Str::slug($value);
    //     $this->attributes['sku'] = 'SKU-' . ucwords(Str::slug($value));
    // }
}
