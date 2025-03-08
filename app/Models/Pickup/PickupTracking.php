<?php

namespace App\Models\Pickup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupTracking extends Model
{
    use HasFactory;

    protected $table = 'pickup_trackings';

    protected $fillable = [
        'order_pickup_id',
        'import_order_id',
        'entity',
        'reference',
        'collection_date',
        'pickup_date',
        'last_status',
        'last_status_description',
        'collected_waybills',
        'has_errors',
        'org_collection_date',
        'org_pickup_date',
        'reference1',
        'reference2',
        'reference3',
        'reference4',
        'reference5',
    ];

    protected $casts = [
        'collection_date' => 'datetime',
        'pickup_date' => 'datetime',
        'collected_waybills' => 'array',
        'has_errors' => 'boolean',
    ];
}
