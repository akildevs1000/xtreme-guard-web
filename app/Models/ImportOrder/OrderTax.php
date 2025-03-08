<?php

namespace App\Models\ImportOrder;

use Illuminate\Database\Eloquent\Model;
use App\Models\ImportOrder\OrderAppliedTax;
use App\Models\ImportOrder\OrderItemAppliedTaxDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderTax extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_order_id',
        'tax_amount',
        'base_tax_amount',
    ];

    protected $casts = [
        'import_order_id' => 'integer',
        'tax_amount' => 'decimal:2',
        'base_tax_amount' => 'decimal:2',
    ];

    public function appliedTaxes()
    {
        return $this->hasMany(OrderAppliedTax::class, 'order_tax_id');
    }

    public function itemAppliedTaxes()
    {
        return $this->hasMany(OrderItemAppliedTax::class, 'order_tax_id');
    }
}
