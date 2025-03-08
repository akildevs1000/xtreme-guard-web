<?php

use Illuminate\Support\Facades\Route;
use App\Models\Shipment\OrderTracking;
use App\Models\ImportOrder\OrderAdjustmentItem;

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


Route::get('/dev', function () {
    return OrderTracking::get();
    return OrderAdjustmentItem::get();

    $epochTimestamp = time();
    $round = round(microtime(true) * 1000);

    return [
        'time()' => $epochTimestamp,
        'round()' => $round,
        'date' => date('Y-m-d h:i'),
    ];

    return view('test');
    // return 'ggg';
});
