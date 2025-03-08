<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPromotionOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_product_id',
        'import_order_id',
        'free_gifts',
        'special_promo_bundle_campaign_1',
    ];
}
