<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Model;
use App\Models\ImportOrder\OrderGiftCardDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderGiftCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_order_id',
        'gift_cards_amount',
        'base_gift_cards_amount',
    ];

    protected $casts = [
        'import_order_id' => 'integer',
        'gift_cards_amount' => 'decimal:2',
        'base_gift_cards_amount' => 'decimal:2',
    ];

    public function giftItems()
    {
        return $this->hasMany(OrderGiftCardDetail::class, 'order_gift_card_id');
    }

    // return $this->hasMany(OrderCoupon::class, 'import_order_id', 'order_id');

}
