<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_product_id',
        'import_order_id',
        'sku',
        'name',
        'qty',
        'original_price',
        'original_price_incl_tax',
        'special_promo_bundle_campaign_1',

    ];

    protected $casts = [
        'import_order_id' => 'integer',
        'tax_amount' => 'decimal:2',
        'base_tax_amount' => 'decimal:2',
        'original_price' => 'decimal:2',
        'original_price_incl_tax' => 'decimal:2',
    ];
}
