<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Model;
use App\Models\ImportOrder\OrderAdjustmentItem;
use App\Models\ImportOrder\OrderAdjustmentDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderAdjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_order_id',
        'type',
        'status',
        'inform_warehouse',
        'open_date',
        'tax_amount',
    ];

    protected $casts = [
        'inform_warehouse' => 'boolean',
        'open_date' => 'datetime',
        'tax_amount' => 'decimal:2',
    ];


    public function adjDetail()
    {
        return $this->hasOne(OrderAdjustmentDetail::class);
    }

    public function adjItems()
    {
        return $this->hasMany(OrderAdjustmentItem::class);
    }
}
