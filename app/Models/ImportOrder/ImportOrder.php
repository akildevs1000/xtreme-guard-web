<?php

namespace App\Models\ImportOrder;

use App\Models\Order\OrderLog;
use App\Models\Shipment\Shipment;
use App\Models\Pickup\OrderPickup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImportOrder extends Model
{
    use HasFactory;

    const SHIPPED_ORDER = 1;
    const CONFIRMED_ORDER = 1;
    const PENDING_ORDER = 0;
    const DELIVERED_ORDER = 1;

    // protected $table = 'import_orders';
    protected $fillable = [
        'order_id',
        'invoice_no',
        'store_id',
        'order_status',
        'order_type',
        'order_date',
        'update_date',
        'subtotal',
        'total_due',
        'shipping_amount',
        'total_item_count',
        'total',
        'discount',
        'tax_total',
        'shipping_amount_tax',
        'is_confirmed',
        'is_shipped',
        'cancel_reason_message',
        'confirmed_date',
        'shipped_date',
        'is_delivered',
        'delivered_date',
    ];

    protected $appends = [
        'report_customer_name',
        'report_confirmed',
        'report_shipped',
        'order_location',
        'order_date_only',
        'order_status_title',
        'out_for_delivery',
        // 'delivered',
        'order_aramex_status',
        'is_return',
    ];

    public function coupons()
    {
        return $this->hasMany(OrderCoupon::class, 'import_order_id', 'order_id');
    }

    public function couponsForReport()
    {
        return $this->hasOne(OrderCoupon::class, 'import_order_id', 'order_id');
    }

    public function customer()
    {
        return $this->belongsTo(OrderCustomer::class, 'order_id', 'import_order_id');
    }

    public function billingAddress()
    {
        return $this->belongsTo(OrderBillingAddress::class, 'order_id', 'import_order_id');
    }

    public function payment()
    {
        return $this->belongsTo(OrderPayment::class, 'order_id', 'import_order_id');
    }

    public function shipping()
    {
        return $this->belongsTo(OrderShipping::class, 'order_id', 'import_order_id');
    }

    public function gift()
    {
        return $this->belongsTo(OrderGiftCard::class, 'order_id', 'import_order_id');
    }

    public function tax()
    {
        return $this->belongsTo(OrderTax::class, 'order_id', 'import_order_id');
    }

    public function adjustments()
    {
        return $this->belongsTo(OrderAdjustment::class, 'order_id', 'import_order_id');
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'import_order_id', 'order_id');
    }

    public function tracking()
    {
        return $this->belongsTo(Shipment::class, 'order_id', 'order_id')->with('details', 'trackingResult');
    }

    public function orderLog()
    {
        return $this->belongsTo(OrderLog::class, 'order_id', 'order_id');
    }

    public function orderReturn()
    {
        return $this->belongsTo(OrderPickup::class, 'order_id', 'order_id');
    }

    public function getReportCustomerNameAttribute($value)
    {
        return $this->customer ? $this->customer->full_name : null;
    }

    public function getReportConfirmedAttribute()
    {
        return $this->is_confirmed ? 'Yes' : 'No';
    }

    public function getReportShippedAttribute()
    {
        return $this->is_shipped ? 'Yes' : 'No';
    }

    public function getOrderLocationAttribute()
    {
        return $this->shipping->address ? $this->shipping->address['city'] : '---';
    }

    public function getOrderDateOnlyAttribute()
    {
        return date('d-m-Y', strtotime($this->order_date));
    }

    public function getOrderStatusTitleAttribute()
    {
        if ($this->order_id) {
            return OrderLog::whereOrderId($this->order_id)
                ->where('status', '!=', 'shipped_to_warehouse_created_shipment_by_aramex')
                ->orderBy('updated_at', 'desc')->first()->status_name ?? [];
        }
        return '';

        // return ucfirst(str_replace('_', ' ', $this->order_status ?? '---'));
    }

    public function getOutForDeliveryAttribute()
    {
        if ($this->order_id) {
            return OrderLog::whereOrderId($this->order_id)->whereStatus('Shipped')->first();
        }
        return '';
    }

    public function getIsReturnAttribute()
    {
        if ($this->order_id) {
            return OrderLog::whereOrderId($this->order_id)->whereStatus('return')->first();
        }
        return '';
    }

    // public function getDeliveredAttribute()
    // {
    //     if ($this->order_id) {
    //         return OrderLog::whereOrderId($this->order_id)->whereStatus('delivered')->first();
    //     }
    //     return '';
    // }

    public function getOrderAramexStatusAttribute()
    {
        if ($this->order_id) {
            return OrderLog::whereOrderId($this->order_id)->orderBy('updated_at', 'desc')->first();
        }
        return '';
    }

    public function getCreatedAtAttribute($value)
    {
        // Format it as needed after casting
        return \Carbon\Carbon::parse($value)->timezone('Asia/Dubai')->format('Y-m-d H:i:s');

        // return \Carbon\Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
