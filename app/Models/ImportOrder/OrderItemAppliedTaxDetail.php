<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemAppliedTaxDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_item_applied_tax_id',
        'amount',
        'base_amount',

    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'base_amount' => 'decimal:2',
    ];
}
