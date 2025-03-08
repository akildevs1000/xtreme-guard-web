<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttachment extends Model
{
    use HasFactory;

    protected $table = 'product_attachments';

    protected $fillable = [
        'product_id',
        'file_name',
        'desc',
        'path',
    ];

    /**
     * Get the product that owns the attachment.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
