<?php

namespace App\Models\ImportOrder;

use App\Models\ImportOrder\OrderTax;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderAppliedTax extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_tax_id',
        'amount',
        'base_amount',
    ];

    protected $casts = [
        'import_order_id' => 'integer',
        'amount' => 'decimal:2',
        'base_amount' => 'decimal:2',
    ];
}
