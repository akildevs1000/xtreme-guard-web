<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemAppliedTax extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'order_tax_id',
        'item_id',
        'associated_item_id',
    ];


    public function itemAppliedTaxeDetails()
    {
        return $this->hasMany(OrderItemAppliedTaxDetail::class, 'order_item_applied_tax_id');
    }
}
