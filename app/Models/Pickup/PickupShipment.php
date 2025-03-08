<?php

namespace App\Models\Pickup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupShipment extends Model
{
    use HasFactory;

    protected $table = 'pickup_shipments';

    protected $fillable = [
        'pickup_id',
        'order_id',
        'pickup_shiping_reference_number',
        'reference1',
        'reference2',
        'reference3',
        'foreign_hawb',
        'has_errors',
        'notifications',
        'shipment_label_url',
        'label_file_contents',
    ];

    // public function details()
    // {
    //     return $this->hasOne(ShipmentDetail::class);
    // }

    // public function trackingResult()
    // {
    //     return $this->hasOne(OrderTracking::class, 'tracking_id', 'shiping_reference_number')->orderBy('updated_at', 'desc');
    // }
}
