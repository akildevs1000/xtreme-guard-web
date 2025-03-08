<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_order_id',
        'sku',
        'name',
        'price',
        'product_id',
        'tax_amount',
        'qty_ordered',
        'price_incl_tax',
        'discount_percent',
        'discount_amount',
        'product_type',
        'promotional_offers',
    ];

    protected $casts = [
        'promotional_offers' => 'array',
        'price' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'price_incl_tax' => 'decimal:2',
        'discount_percent' => 'decimal:2',
        'discount_amount' => 'decimal:2',

    ];


    public function items()
    {
        return $this->hasMany(OrderProductItem::class, 'order_product_id');
    }
}
