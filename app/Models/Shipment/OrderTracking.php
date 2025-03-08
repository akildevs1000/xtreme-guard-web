<?php

namespace App\Models\Shipment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTracking extends Model
{
    use HasFactory;

    protected $table = 'order_trackings';

    protected $fillable = [
        'order_id',
        'tracking_id',
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

    protected $appends = [
        'converted_date'
    ];

    public function getConvertedDateAttribute($value)
    {
        return getDateAndTime($this->attributes['update_date_time'] ?? '---');
    }
}
