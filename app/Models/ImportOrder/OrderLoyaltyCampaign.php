<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLoyaltyCampaign   extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_order_id',
        'discounted_skus',
        'spent_points',
        'discount_amount',
    ];

    protected $casts = [
        'import_order_id' => 'integer',
        'discounted_skus' => 'array',
        'spent_points' => 'integer',
        'discount_amount' => 'decimal:2',
    ];
}
