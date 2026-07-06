<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MembershipPurchase;
use App\Models\PoolInfo;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $pool = PoolInfo::first();

        $currentOccupancy = Booking::where('status', 'checked_in')
            ->sum('total_people');

        $revenue = Booking::where('status', 'completed')
            ->sum('total_price');

        $activeBookings = Booking::whereIn('status', ['pending', 'checked_in'])
            ->count();

        $completedBookings = Booking::where(
            'status',
            'completed'
        )->count();

        $pendingBookings = Booking::where(
            'status',
            'pending'
        )->count();

        $totalMemberships = MembershipPurchase::count();

        $activeMemberships = MembershipPurchase::where(
            'status',
            'active'
        )->count();

        $expiredMemberships = MembershipPurchase::where(
            'status',
            'expired'
        )->count();

        $todayBookings = Booking::whereDate(
            'booking_date',
            Carbon::today()
        )->count();

        $cancelledBookings = Booking::where(
            'status',
            'cancelled'
        )->count();

        return view('admin.dashboard', compact(
            'pool',
            'currentOccupancy',
            'revenue',
            'activeBookings',
            'totalMemberships',
            'activeMemberships',
            'expiredMemberships',
            'pendingBookings',
            'todayBookings',
            'completedBookings',
            'cancelledBookings',
        ));
    }
}
