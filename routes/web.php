<?php

use App\Http\Controllers\Admin\AvailabilityController;
use App\Http\Controllers\Admin\BookingManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('frontend.home');
});

Route::middleware(['admin'])->group(function () {

    Route::get('/admin', function () {
        return view('admin.dashboard');
    });

    Route::get('/admin/settings', [SettingController::class, 'index'])->name("setting");

    Route::post('/admin/settings', [SettingController::class, 'update'])->name("setting.store");

    Route::get('/admin/availability', [AvailabilityController::class, 'index'])
        ->name('admin.availability');

    Route::post('/admin/availability/store', [AvailabilityController::class, 'store'])
        ->name('admin.availability.store');

    Route::get('/admin/bookings', [BookingManagementController::class, 'index'])
        ->name('admin.bookings');
});

Route::get('/register', [AuthController::class, 'registerPage']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'loginPage']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);



Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
