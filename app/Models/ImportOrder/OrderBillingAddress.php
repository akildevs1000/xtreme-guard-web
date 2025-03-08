<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBillingAddress  extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_order_id',
        'city',
        'street',
        'postcode',
        'telephone',
        'country_id',
        'parent_id',
        'company',
        'firstname',
        'lastname',
        'email',
        'entity_id',
        'address_type',
        'increment_id',
        'store_id',
        'store_name',
        'administrative_area_level_2',
        'sublocality_level_2',
    ];

    protected $casts = [
        'import_order_id' => 'integer',
        'street' => 'array',
        'parent_id' => 'integer',
        'entity_id' => 'integer',
        'increment_id' => 'integer',
        'store_id' => 'integer',
    ];
}
