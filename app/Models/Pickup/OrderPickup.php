<?php

namespace App\Models\Pickup;

use App\Models\ImportOrder\ImportOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shipment\OrderTracking;

class OrderPickup extends Model
{
    use HasFactory;

    protected $table = 'order_pickups';

    protected $fillable = [
        'order_id',
        'pickup_id',
        'guid',
        'reference1',
        'reference2',
        'processed_shipments',
        'notifications',
        'transaction',
        'is_return_delivered',
        'return_delivered_date',
    ];

    protected $casts = [
        'processed_shipments' => 'array',
        'notifications' => 'array',
        'transaction' => 'array',
    ];

    public function pickupTracking()
    {
        return $this->hasOne(PickupTracking::class, 'reference', 'pickup_id')->orderBy('updated_at', 'desc');
        // return $this->hasOne(PickupTracking::class)->orderBy('updated_at', 'desc');
    }

    public function pickupShipment()
    {
        return $this->hasOne(PickupShipment::class, 'pickup_id')->orderBy('updated_at', 'desc');
    }

    public function order()
    {
        return $this->belongsTo(ImportOrder::class, 'order_id', 'order_id');
    }

    public function pickupedShipment()
    {
        return $this->belongsTo(PickupShipment::class, 'order_id', 'order_id');
    }
}
