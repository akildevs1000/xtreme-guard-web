<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCoupon  extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_order_id',
        'coupon',
        'category',
    ];
}
