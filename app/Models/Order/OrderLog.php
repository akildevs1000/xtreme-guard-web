<?php

namespace App\Models\Order;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderLog extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'status',
        'status_name',
        'status_date',
        'comment',
    ];

    // protected $casts = [
    //     'created_at' => 'datetime:Y-m-d H:i:s',  // You can add a specific format here
    //     'updated_at' => 'datetime:Y-m-d H:i:s',
    // ];


    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Dubai')->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Dubai')->format('Y-m-d H:i:s');
    }
}
