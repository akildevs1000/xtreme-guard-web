<?php

namespace App\Models\Shipment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $table = 'shipments';

    protected $fillable = [
        'order_id',
        'shiping_reference_number',
        'reference1',
        'reference2',
        'reference3',
        'foreign_hawb',
        'has_errors',
        'notifications',
        'shipment_label_url',
        'label_file_contents',
    ];

    public function details()
    {
        return $this->hasOne(ShipmentDetail::class);
    }

    public function trackingResult()
    {
        return $this->hasOne(OrderTracking::class, 'tracking_id', 'shiping_reference_number')
            ->orderBy('update_date_time_converted', 'desc');
    }
}
