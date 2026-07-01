<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|unique:coupons,code',
            'discount_type' => 'required',
            'discount_value' => 'required|numeric|min:1',
            'expires_at' => 'nullable|date'
        ]);

        $data['is_active'] = true;

        Coupon::create($data);

        return back()->with('success', 'Coupon Added');
    }

    public function update(Request $request, Coupon $coupon)
    {
        $data = $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'discount_type' => 'required',
            'discount_value' => 'required|numeric|min:1',
            'expires_at' => 'nullable|date'
        ]);

        $coupon->update($data);

        return back()->with('success', 'Coupon Updated');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return back()->with('success', 'Coupon Deleted');
    }

    public function toggle(Coupon $coupon)
    {
        $coupon->is_active = !$coupon->is_active;
        $coupon->save();

        return back()->with('success', 'Coupon Status Changed');
    }
}
