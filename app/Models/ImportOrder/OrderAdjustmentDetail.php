<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAdjustmentDetail extends Model
{
    use HasFactory;

    protected $table = 'order_adjustment_details';

    protected $fillable = [
        'order_adjustment_id',
        'order_adjustment',
        'refund_request_id',
        'amount',
        'currency',
    ];
}
