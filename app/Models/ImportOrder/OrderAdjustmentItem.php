<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAdjustmentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_adjustment_id',
        'sku',
        'qty',
        'amount',
        'currency',
        'requires_return',
        'parent_sku',
    ];
}
