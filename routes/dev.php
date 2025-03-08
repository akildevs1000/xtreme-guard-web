<?php

use Illuminate\Support\Str;
use App\Providers\JTIService;
use App\Mail\OrderInvoiceMail;
use App\Models\Order\OrderLog;
use App\Models\Shipment\Shipment;
use App\Models\Pickup\OrderPickup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Pickup\PickupTracking;
use Illuminate\Support\Facades\Route;
use App\Models\Shipment\OrderTracking;
use App\Models\Shipment\ShipmentDetail;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\BufferedOutput;
use App\Http\Controllers\Pages\Application\MailController;
use App\Models\Mail\MailLog;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::get('/dev1', function () {

//     // ===========gmt and local====================
//     // // Set the default timezone to GMT for calculations
//     // date_default_timezone_set('GMT');

//     // // Get the current timestamp and set the current date
//     // $current_time = time(); // Current time as a timestamp
//     // $current_timestamp = $current_time * 1000; // Current timestamp in milliseconds

//     // // Create a DateTime object for the current time in GMT
//     // $current_date = new DateTime('now', new DateTimeZone('GMT'));
//     // $current_day = $current_date->format('l'); // Get the current day (e.g., Sunday)

//     // // Check if the current time is within the specified range (8 AM to 6 PM)
//     // $ready_time = $current_date->setTime(8, 0)->getTimestamp() * 1000; // Start with 8 AM in milliseconds

//     // // If current day is Sunday, set to next Monday
//     // if ($current_day === 'Sunday') {
//     //     $current_date->modify('next Monday');
//     // }

//     // // If the current time is outside the 8 AM to 6 PM range, adjust to 8:30 AM
//     // if ($current_time < $ready_time || $current_time >= $ready_time + (10 * 3600)) {
//     //     $ready_time = $current_date->setTime(8, 30)->getTimestamp() * 1000; // Set to 8:30 AM in milliseconds
//     // }

//     // // Set the next day timestamp
//     // $next_day_timestamp = $current_date->modify('+1 day')->getTimestamp() * 1000; // Next day timestamp in milliseconds
//     // $last_pickup_time = $ready_time + (1 * 3600 * 1000); // Last pickup time is 1 hour after ready time
//     // $closing_time = $last_pickup_time + (1 * 3600 * 1000); // Closing time is 1 hour after last pickup

//     // // Convert times to Dubai timezone for output
//     // $timezone = new DateTimeZone('Asia/Dubai');
//     // $ready_time_dubai = (new DateTime("@" . ($ready_time / 1000)))->setTimezone($timezone)->format('Y-m-d H:i:s');
//     // $next_day_timestamp_dubai = (new DateTime("@" . ($next_day_timestamp / 1000)))->setTimezone($timezone)->format('Y-m-d H:i:s');
//     // $last_pickup_time_dubai = (new DateTime("@" . ($last_pickup_time / 1000)))->setTimezone($timezone)->format('Y-m-d H:i:s');
//     // $closing_time_dubai = (new DateTime("@" . ($closing_time / 1000)))->setTimezone($timezone)->format('Y-m-d H:i:s');

//     // return [
//     //     'next_day_timestamp' => $next_day_timestamp,
//     //     'ready_time' => $ready_time,
//     //     'last_pickup_time' => $last_pickup_time,
//     //     'closing_time' => $closing_time,
//     //     'ready_time_dubai' => $ready_time_dubai, // Converted to Dubai time
//     //     'next_day_timestamp_dubai' => $next_day_timestamp_dubai, // Converted to Dubai time
//     //     'last_pickup_time_dubai' => $last_pickup_time_dubai, // Converted to Dubai time
//     //     'closing_time_dubai' => $closing_time_dubai, // Converted to Dubai time
//     // ];

//     // ===========gmt and local====================







//     // Set the default timezone to GMT
//     date_default_timezone_set('GMT');

//     // Get the current timestamp and set the current date
//     $current_time = time(); // Current time as a timestamp
//     $current_timestamp = $current_time * 1000; // Current timestamp in milliseconds

//     // Create a DateTime object for the current time in GMT
//     $current_date = new DateTime('now', new DateTimeZone('GMT'));
//     $current_day = $current_date->format('l'); // Get the current day (e.g., Sunday)

//     // Set the ready time to 8 AM
//     $ready_time = $current_date->setTime(8, 0)->getTimestamp() * 1000; // Start with 8 AM in milliseconds

//     // If current day is Sunday, set to next Monday
//     if ($current_day === 'Sunday') {
//         $current_date->modify('next Monday');
//     }


//     // Check if the current time is within the specified range (8 AM to 6 PM)
//     if ($current_time >= $ready_time && $current_time < $ready_time + (10 * 3600)) {
//         // Current time is between 8 AM and 6 PM, use current time as ready_time
//         $ready_time = $current_time * 1000; // Set ready time to current time in milliseconds
//     } else {
//         // If the current time is outside the 8 AM to 6 PM range, adjust to 8:30 AM
//         $ready_time = $current_date->setTime(8, 30)->getTimestamp() * 1000; // Set to 8:30 AM in milliseconds
//     }

//     // Set the next day timestamp
//     $next_day_timestamp = $current_date->modify('+1 day')->getTimestamp() * 1000; // Next day timestamp in milliseconds
//     $last_pickup_time = $ready_time + (1 * 3600 * 1000); // Last pickup time is 1 hour after ready time
//     $closing_time = $last_pickup_time + (1 * 3600 * 1000); // Closing time is 1 hour after last pickup

//     return [
//         'next_day_timestamp' => $next_day_timestamp,
//         'ready_time' => $ready_time,
//         'last_pickup_time' => $last_pickup_time,
//         'closing_time' => $closing_time,
//         'date' => date('Y-m-d H:i:s', $ready_time / 1000), // Convert milliseconds to seconds
//     ];









//     // ==============================
//     // Set the default timezone to GMT
//     date_default_timezone_set('GMT');

//     // Get the current timestamp and set the current date
//     $current_time = time(); // Current time as a timestamp
//     $current_timestamp = $current_time * 1000; // Current timestamp in milliseconds

//     // Create a DateTime object for the current time in GMT
//     $current_date = new DateTime('now', new DateTimeZone('GMT'));
//     $current_day = $current_date->format('l'); // Get the current day (e.g., Sunday)

//     // Check if the current time is within the specified range (8 AM to 6 PM)
//     $ready_time = $current_date->setTime(8, 0)->getTimestamp() * 1000; // Start with 8 AM in milliseconds

//     // If current day is Sunday, set to next Monday
//     if ($current_day === 'Sunday') {
//         $current_date->modify('next Monday');
//     }

//     // If the current time is outside the 8 AM to 6 PM range, adjust to 8:30 AM
//     if ($current_time < $ready_time || $current_time >= $ready_time + (10 * 3600)) {

//         $ready_time = $current_date->setTime(8, 30)->getTimestamp() * 1000; // Set to 8:30 AM in milliseconds
//     }

//     // Set the next day timestamp
//     $next_day_timestamp = $current_date->modify('+1 day')->getTimestamp() * 1000; // Next day timestamp in milliseconds
//     $last_pickup_time = $ready_time + (1 * 3600 * 1000); // Last pickup time is 1 hour after ready time
//     $closing_time = $last_pickup_time + (1 * 3600 * 1000); // Closing time is 1 hour after last pickup

//     return [
//         'next_day_timestamp' => $next_day_timestamp,
//         'ready_time' => $ready_time,
//         'last_pickup_time' => $last_pickup_time,
//         'closing_time' => $closing_time,
//         'date' => date('Y-m-d H:i:s', $ready_time / 1000), // Convert milliseconds to seconds
//     ];

//     // ==============================





//     // return OrderTracking::get();
//     // return OrderAdjustmentItem::get();
//     date_default_timezone_set('Asia/Dubai');

//     $epochTimestamp = time();
//     $round = round(microtime(true) * 1000);




//     // Get the current timestamp and set the current date
//     $current_time = time(); // Current time as a timestamp
//     $current_timestamp = $current_time * 1000; // Current timestamp in milliseconds

//     // Set environment variables (for example, in Laravel, you can use config or env)
//     $next_day_timestamp = addDays($current_timestamp / 1000, 1); // Next day timestamp in milliseconds
//     $ready_time = $next_day_timestamp + (1 * 3600 * 1000); // Add 1 hour in milliseconds
//     $last_pickup_time = $next_day_timestamp + (2 * 3600 * 1000); // Add 2 hours in milliseconds
//     $closing_time = $next_day_timestamp + (3 * 3600 * 1000); // Add 3 hours in milliseconds


//     return [
//         // 'time()' => $epochTimestamp,
//         // 'round()' => $round,
//         // 'date' => date('Y-m-d H:i', $epochTimestamp), // Convert milliseconds to seconds

//         'next_day_timestamp' => $next_day_timestamp,
//         'ready_time' => $ready_time,
//         'last_pickup_time' => $last_pickup_time,
//         'closing_time' => $closing_time,

//         'date' => date('Y-m-d H:i', $next_day_timestamp / 1000), // Convert milliseconds to seconds

//     ];

//     // return view('test');
//     // return 'ggg';
// });

// function addDays($date, $days)
// {
//     // Return the timestamp in milliseconds
//     return strtotime("+$days days", $date) * 1000;
// }
