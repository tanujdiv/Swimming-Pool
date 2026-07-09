<?php

use App\Http\Controllers\Admin\AvailabilityController;
use App\Http\Controllers\Admin\BookingManagementController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\MembershipPurchaseController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\PaymentController;
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

    Route::get('/admin/notifications', [NotificationController::class, 'index'])
        ->name('admin.notifications');

    Route::post('/admin/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
        ->name('admin.notifications.read');

    Route::get('/admin/memberships', [MembershipController::class, 'index'])
        ->name('admin.memberships');

    Route::post('/admin/memberships', [MembershipController::class, 'store'])
        ->name('admin.memberships.store');

    Route::get('/admin/coupons', [CouponController::class, 'index'])
        ->name('admin.coupons');

    Route::post('/admin/coupons', [CouponController::class, 'store'])
        ->name('admin.coupons.store');

    Route::put('/admin/coupons/{coupon}', [CouponController::class, 'update'])
        ->name('admin.coupons.update');

    Route::delete('/admin/coupons/{coupon}', [CouponController::class, 'destroy'])
        ->name('admin.coupons.delete');

    Route::post('/admin/coupons/{coupon}/toggle', [CouponController::class, 'toggle'])
        ->name('admin.coupons.toggle');

    Route::get(
        '/admin/membership-purchases',
        [MembershipPurchaseController::class, 'index']
    )->name('admin.membership.purchases');
});


Route::get('/register', [AuthController::class, 'registerPage']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'loginPage'])->name("login");
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);


Route::middleware('auth')->group(function () {

    Route::get('/memberships', [BookingController::class, 'memberships'])->name('memberships');


    Route::view('/renew-membership', 'frontend.renew-membership')->name('membership.renew.page');

    Route::get('/booking', [BookingController::class, 'index'])->name('booking');

    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

    Route::post('/buy-membership', [BookingController::class, 'buyMembership'])
        ->name('membership.buy');

    Route::post('/membership/{purchase}/renew', [BookingController::class, 'renewMembership'])
        ->name('membership.renew');

    Route::get('/membership/history', [MembershipPurchaseController::class, 'history'])
        ->name('membership.history');

    Route::post(
        '/payment/create-order',
        [PaymentController::class, 'createOrder']
    )->name('payment.create');

    Route::post(
        '/booking/payment',
        [BookingController::class, 'paymentPage']
    )->name('booking.payment');

    Route::post(
        '/booking/confirm',
        [BookingController::class, 'confirmBooking']
    )->name('booking.confirm');

    Route::post(
        '/booking/pay-online',
        [BookingController::class, 'onlinePayment']
    )->name('booking.online.payment');
});
