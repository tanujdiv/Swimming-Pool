<?php

use App\Http\Controllers\Admin\AvailabilityController;
use App\Http\Controllers\Admin\BookingManagementController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('frontend.home');
});

Route::middleware(['admin'])->group(function () {
    
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

    Route::get('/admin/settings', [SettingController::class, 'index'])->name("setting");

    Route::post('/admin/settings', [SettingController::class, 'update'])->name("setting.store");

    Route::get('/admin/availability', [AvailabilityController::class, 'index'])
        ->name('admin.availability');

    Route::post('/admin/availability/store', [AvailabilityController::class, 'store'])
        ->name('admin.availability.store');

    Route::get('/bookings', [BookingManagementController::class, 'index'])
        ->name('admin.bookings');

    Route::post('/booking/{booking}/checkin', [BookingManagementController::class, 'checkIn'])
        ->name('admin.booking.checkin');

    Route::post('/booking/{booking}/checkout', [BookingManagementController::class, 'checkOut'])
        ->name('admin.booking.checkout');

    Route::post('/booking/{booking}/extend', [BookingManagementController::class, 'extend'])
        ->name('admin.booking.extend');
});

Route::get('/register', [AuthController::class, 'registerPage']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'loginPage']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);



Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
