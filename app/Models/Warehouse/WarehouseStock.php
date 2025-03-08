<?php

namespace App\Models\Warehouse;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WarehouseStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'item_code',
        'qty',
        'unit',
        'barcode',
        'item_type',
        'description',
    ];

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Dubai')->format('Y-m-d H:i:s');
    }
}
