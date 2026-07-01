<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipPurchase;

class MembershipPurchaseController extends Controller
{
    public function index()
    {
        $purchases = MembershipPurchase::with('membership')
            ->latest()
            ->get();

        return view('admin.membership-purchases.index', compact('purchases'));
    }
}
