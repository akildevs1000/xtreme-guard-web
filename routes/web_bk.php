<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pages\Order\OrderController;
use App\Http\Controllers\Pages\Order\ImportController;
use App\Http\Controllers\Pages\Order\PickupController;
use App\Http\Controllers\Pages\Order\ShipmentController;
use App\Http\Controllers\Pages\Shipment\TrackingController;
use App\Http\Controllers\Pages\Administration\RoleController;
use App\Http\Controllers\Pages\Administration\UserController;
use App\Http\Controllers\Pages\Dashboard\DashboardController;
use App\Http\Controllers\Pages\Administration\PermissionController;
use App\Http\Controllers\Pages\Administration\SettingController;
use App\Http\Controllers\Pages\Order\WarehouseStockController;
use App\Http\Controllers\Pages\Report\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('pages/dashboard/index');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth', 'verified'])->group(function () {

// Route::resource('order', DashboardController::class);

// Route::get('/', function () { return view('pages/dashboard/index'); });

Route::get('/', fn() =>  redirect(route('dashboard.index')));

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('dashboard', DashboardController::class);
    Route::resource('administration/role', RoleController::class);
    Route::resource('administration/permission', PermissionController::class);
    Route::resource('administration/user', UserController::class);
    Route::resource('administration/setting', SettingController::class);
    Route::get('administration/user-activity', [UserController::class, 'userActivity']);

    Route::resource('order/import-order', ImportController::class);

    Route::resource('order/order', OrderController::class);
    Route::get('order/confirmed-order', [OrderController::class, 'confirmedOrder']);
    Route::get('order/delivered-order', [OrderController::class, 'deliveredOrder']);
    Route::get('order/pickup-order', [OrderController::class, 'pickupedOrder']);

    Route::resource('order/shipping', ShipmentController::class);
    Route::get('order/shipping/export-single-order/{orderid}', [ShipmentController::class, 'exportBySingleOrder']);
    Route::get('order/order-invoice-pdf/{orderid}', [OrderController::class, 'previewInvoicePDF']);
    Route::get('order/order-invoice-pdf-download/{orderid}', [OrderController::class, 'downloadInvoicePDF']);
    Route::get('order/order-invoice-pdf-email/{orderid}', [OrderController::class, 'sendMailToCustomer']);

    Route::resource('order/pickup', PickupController::class);
    Route::get('shipment/pickup/get-pickup-tracking-info-by-trackId/{trackingId}', [PickupController::class, 'getPickupTrackingByPickupTrackingId']);
    Route::get('order/return-order/{orderid}', [PickupController::class, 'returnOrder']);

    Route::resource('order/warehouse', WarehouseStockController::class);


    Route::get('report/{reporttype}', [ReportController::class, 'viewReportIntial']);
    Route::post('report/{reporttype}', [ReportController::class, 'getReport']);

    Route::resource('shipment/tracking', TrackingController::class);
    Route::get('shipment/tracking/get-tracking-info-by-trackId/{trackingId}', [TrackingController::class, 'getTrackingShipmentByTrackingId']);
});

Route::get('pgrid', [ReportController::class, 'phpGrid']);

Route::get('/test-table', function () {
    return view('test');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/dev.php';
