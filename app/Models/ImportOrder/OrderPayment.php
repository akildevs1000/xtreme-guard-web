<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_order_id',
        'amount',
        'payment_method',
        'currency',
        'method_code',
        'method_title',
        'method_icon',
    ];

    protected $casts = [
        'import_order_id' => 'integer',
        'amount' => 'decimal:2',
    ];
}
