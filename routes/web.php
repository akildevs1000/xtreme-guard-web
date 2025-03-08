<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pages\Development\DevController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Pages\Administration\RoleController;
use App\Http\Controllers\Pages\Administration\UserController;
use App\Http\Controllers\Pages\Dashboard\DashboardController;
use App\Http\Controllers\Pages\Administration\SettingController;
use App\Http\Controllers\Pages\Administration\PermissionController;
use App\Http\Controllers\Pages\Administration\MailTrackingController;
use App\Http\Controllers\Pages\Blog\BlogController;
use App\Http\Controllers\Pages\Category\CategoryController;
use App\Http\Controllers\Pages\Contact\ContactController;
use App\Http\Controllers\Pages\Product\ProductController;

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

// Route::get('/', fn() =>  redirect(route('dashboard.index')));

Route::prefix('admin')->middleware(['auth', 'logged.session'])->group(function () {
    // Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('dashboard', DashboardController::class);

    Route::resource('administration/role', RoleController::class);

    Route::resource('administration/permission', PermissionController::class);

    Route::resource('administration/user', UserController::class);

    Route::resource('administration/setting', SettingController::class);

    Route::resource('category', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('blogs', BlogController::class);

    Route::resource('administration/mail-tracking', MailTrackingController::class);
    Route::get('administration/mail-preview/{path}/{orderId}', [MailTrackingController::class, 'preview']);
    Route::get('administration/mail-attach-preview/{path}/{orderId}', [MailTrackingController::class, 'preview']);
    Route::get('administration/mail-open/{type}/{orderId}', [MailTrackingController::class, 'openFromMail']);

    Route::get('administration/user-activity', [UserController::class, 'userActivity']);
    Route::get('administration/logged-user-tracking', [UserController::class, 'loggedUserTracking']);
});

Route::get('reset-login-session/{username}', [AuthenticatedSessionController::class, 'resetLoginSession']);
Route::post('reset-login-session/{username}', [AuthenticatedSessionController::class, 'resetLoginSessionSubmit']);


Route::get('/test-table', function () {
    return view('test');
});

Route::get('/test-voice', function () {
    return view('test');
});

Route::get('development/permissions', [DevController::class, 'permissions']);
Route::get('development/route-list', [DevController::class, 'getRoutes']);
Route::get('development/cron-failed/{id}', [DevController::class, 'viewCronFailed']);
Route::get('development/cron-failed-fixed/{id}', [DevController::class, 'fixedCronFailed']);
Route::get('development/cron-failed-fixed-list', [DevController::class, 'fixedCronFailedList']);


require __DIR__ . '/auth.php';
require __DIR__ . '/dev.php';
require __DIR__ . '/site.php';
