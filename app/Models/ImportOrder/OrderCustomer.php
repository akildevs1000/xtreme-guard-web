<?php

namespace App\Models\ImportOrder;

use App\Models\ImportOrder\ImportOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderCustomer extends Model
{
    use HasFactory;

    // protected $table = 'order_customers';


    protected $fillable = [
        'uuid',
        'import_order_id',
        'email',
        'first_name',
        'last_name',
        'phone',
        'dob',
        'age_verified',
    ];


    protected $appends = [
        'full_name',
    ];

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }
}
