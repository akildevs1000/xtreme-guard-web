<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_order_id',
        'amount',
        'method',
        'address',
    ];

    protected $casts = [
        'import_order_id' => 'integer',
        'address' => 'array',
    ];

    protected $appends = [
        'location',
    ];

    public function getLocationAttribute()
    {
        $obj = json_decode($this->attributes['address']);
        if ($obj && $obj->city) {
            return $obj->city;
        }
        return "";
    }
}
