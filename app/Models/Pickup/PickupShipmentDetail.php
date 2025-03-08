<?php

namespace App\Models\Pickup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupShipmentDetail extends Model
{
    use HasFactory;

    protected $table = 'pickup_shipment_details';

    protected $fillable = [
        'pickup_shipment_id',
        'pickup_shiping_reference_number',
        'origin',
        'destination',
        'chargeable_weight_unit',
        'chargeable_weight_value',
        'description_of_goods',
        'goods_origin_country',
        'number_of_pieces',
        'product_group',
        'product_type',
        'payment_type',
        'payment_options',
        'customs_value_currency_code',
        'customs_value_amount',
        'cash_on_delivery_amount',
        'additional_data',
        'insurance_currency_code',
        'insurance_amount',
        'cash_additional_currency_code',
        'cash_additional_amount',
        'collect_currency_code',
        'collect_amount',
        'services',
        'origin_city',
        'destination_city',
        'ship_attachment',
    ];

    // public function shipment()
    // {
    //     return $this->belongsTo(Shipment::class);
    // }
}
