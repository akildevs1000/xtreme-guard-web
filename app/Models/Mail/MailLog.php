<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    use HasFactory;

    const IVOICE_CONFIRMED_MAIL = 1;
    const IVOICE_SHIPPED_MAIL = 2;
    const IVOICE_OUT_FOR_DELIVERY_MAIL = 3;
    const IVOICE_DELIVERED_MAIL = 4;
    const RETURN_CREATED = 5;
    const RETURN_OUT_FOR_PICKUP_MAIL = 6;
    const RETURN_DELIVERED_MAIL = 7;
    const LOW_STOCK_STATUS = 10;

    protected $table = 'mail_logs';

    protected $fillable = [
        'uuid',
        'order_id',
        'mail_class',
        'subject',
        'mail_type',
        'content',
        'from',
        'attachment_path',
        'view_path',
        'description',
        'to',
        'cc',
        'bcc',
        'is_sent',
        'sent_at',
        'delivered_at',
        'opens',
        'last_opened_at',
        'clicks',
        'rejected_at',
    ];

    protected $casts = [
        'from' => 'array',
        'to' => 'array',
        'cc' => 'array',
        'bcc' => 'array',
        'sent_at' => 'datetime:Y-m-d H:i',
        'delivered_at' => 'datetime',
        'last_opened_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    protected $hidden = ['content'];

    protected $appends = ['from_as_string', 'preview', 'attach_preview', 'view_order'];

    public function getFromAsStringAttribute()
    {
        return json_decode($this->form);
        return json_encode($this->from)[0];
    }

    public function scopeFilterByMailType($query, $request)
    {
        $query = $query->when(
            $request->filled('mailType') && $request->has('mailType') && $request->mailType > 0,
            function ($q) use ($request) {
                $q->where('mail_type', $request->mailType);
            }
        );

        $query = $query->when(env('APP_ENV') == 'production', function ($q) {
            $q->where('to', '!=', 'm.fahath@mirnah.com');
        });

        return $query;
    }

    public function getViewOrderAttribute()
    {
        if (!$this->view_path) {
            return null;
        }

        return url('order/order', [
            'orderId' => $this->order_id
        ]);
    }

    public function getPreviewAttribute()
    {
        if (!$this->view_path) {
            return null;
        }

        $orderId = $this->mail_type == 10 ? 0 : $this->order_id;

        return url('administration/mail-preview', [
            'path'    => $this->view_path,
            'orderId' => $orderId
        ]);
    }

    public function getAttachPreviewAttribute()
    {
        if ($this->attachment_path && $this->order_id) {
            return url('administration/mail-attach-preview', ['path' => $this->attachment_path, 'orderId' => $this->order_id]);
        }
        return 'not available';
    }

    // public function getSentAtAttribute($value)
    // {
    //     return \Carbon\Carbon::parse($value)->format('Y-m-d');
    // }

    // public function getFromAttribute($value)
    // {
    //     $array = json_decode($value, true);
    //     return json_encode($array);
    // }
}
