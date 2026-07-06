<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MembershipPurchase;
use App\Models\PoolInfo;

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

        $totalMemberships = MembershipPurchase::count();

        $activeMemberships = MembershipPurchase::where(
            'status',
            'active'
        )->count();

        $expiredMemberships = MembershipPurchase::where(
            'status',
            'expired'
        )->count();

        return view('admin.dashboard', compact(
            'pool',
            'currentOccupancy',
            'revenue',
            'activeBookings',
            'totalMemberships',
            'activeMemberships',
            'expiredMemberships',
        ));
    }
}
