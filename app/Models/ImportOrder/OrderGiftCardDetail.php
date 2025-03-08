<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderGiftCardDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_order_id',
        'order_gift_card_id',
        'code',
        'amount',
        'base_amount',
    ];

    protected $casts = [
        'import_order_id' => 'integer',
        'order_gift_card_id' => 'integer',
        'amount' => 'decimal:2',
        'base_amount' => 'decimal:2',
    ];
}
