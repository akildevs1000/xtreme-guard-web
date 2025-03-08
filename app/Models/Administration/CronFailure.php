<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronFailure extends Model
{
    use HasFactory;

    protected $table = 'cron_failures';

    protected $fillable = [
        'job_name',
        'recipient_email',
        'error_message',
        'failed_at',
        'is_fixed',
    ];

    public $timestamps = false;

    public function scopeFilter($query, $request)
    {
        return $query->when($request->filled('filter_date'), function ($query) use ($request) {
            // Check if the filter_date contains the " to " separator
            if (strpos($request->filter_date, " to ") !== false) {
                [$start_date, $end_date] = explode(" to ", $request->filter_date);

                // Format start date and end date
                $start_date = date("Y-m-d 00:00:00", strtotime(trim($start_date))); // Start of the day
                $end_date = date("Y-m-d 23:59:59", strtotime(trim($end_date)));   // End of the day

                // If start and end date are the same, treat it as a single date
                if ($start_date == $end_date) {
                    $query->whereDate('failed_at', '=', $start_date); // Use whereDate for single day filter
                } else {
                    $query->whereBetween('failed_at', [$start_date, $end_date]);
                }
            } else {

                // Handle the case where only a single date is provided
                $start_date = date("Y-m-d 00:00:00", strtotime(trim($request->filter_date)));
                $end_date = date("Y-m-d 23:59:59", strtotime(trim($request->filter_date)));

                // Apply single date filtering
                $query->whereBetween('failed_at', [$start_date, $end_date]);
            }
            // Apply ordering
        });
    }
}
