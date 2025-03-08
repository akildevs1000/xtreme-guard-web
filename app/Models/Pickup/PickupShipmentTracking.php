<?php

namespace App\Models\Pickup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupShipmentTracking extends Model
{
    use HasFactory;

    protected $table = 'pickup_shipment_trackings';

    protected $fillable = [
        'order_id',
        'pickup_shipment_id',
        'pickup_shipment_tracking_id',
        'waybill_number',
        'update_code',
        'update_description',
        'update_date_time',
        'update_date_time_converted',
        'update_location',
        'comments',
        'problem_code',
        'gross_weight',
        'chargeable_weight',
        'weight_unit',
    ];

    protected $casts = [
        'update_date_time_converted' => 'datetime',
    ];
}
