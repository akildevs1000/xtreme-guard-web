<?php

namespace App\Models\Employee;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'employee_id',
        'designation',
        'phone_number',
        'email',
        'branch',
        'department',
        'joining_date',
        'country',
        'description',
        'img',
        'cover_img',
        // Add any additional fields you need
    ];

    protected $appends = [
        'full_name',
    ];

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function setJoiningDateAttribute($value)
    {
        // Parse the input date and set the attribute
        $this->attributes['joining_date'] = Carbon::createFromFormat('d M, Y', $value)->format('Y-m-d');
    }


}
