<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipPurchase;
use Illuminate\Support\Facades\Auth;

class MembershipPurchaseController extends Controller
{
    public function index()
    {
        MembershipPurchase::where('end_date', '<', now()->toDateString())
            ->where('status', 'active')
            ->update([
                'status' => 'expired'
            ]);

        $purchases = MembershipPurchase::with('membership')
            ->latest()
            ->get();

        return view('admin.membership-purchases.index', compact('purchases'));
    }

    public function history()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        MembershipPurchase::where('end_date', '<', now()->toDateString())
            ->where('status', 'active')
            ->update([
                'status' => 'expired'
            ]);

        $purchases = MembershipPurchase::with('membership')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('frontend.membership-history', compact('purchases'));
    }
}
