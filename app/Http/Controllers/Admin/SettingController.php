<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PoolInfo;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $pool = PoolInfo::first();
        $setting = Setting::first();

        return view('admin.settings.index', compact('pool', 'setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'capacity' => 'required|integer|min:1',

            'adult_price' => 'required|numeric|min:0',
            'child_price' => 'required|numeric|min:0',
            'full_pool_price' => 'required|numeric|min:0',

            'min_duration' => 'nullable|numeric|min:1',
            'max_duration' => 'nullable|numeric|min:1',
            'step_minutes' => 'nullable|integer|min:1',

            'offline_charge' => 'required|numeric|min:0',
            'gateway_charge' => 'required|numeric|min:0',
            'gst_percentage' => 'required|numeric|min:0',

            'pay_online' => 'nullable',
            'pay_on_pool' => 'nullable',

            'children_enabled' => 'nullable',
            'full_pool_enabled' => 'nullable',
            'booking_enabled' => 'nullable',
        ]);

        PoolInfo::updateOrCreate(
            ['id' => 1],
            [
                'name' => $request->name,
                'type' => $request->type,
                'length' => $request->length,
                'width' => $request->width,
                'min_depth' => $request->min_depth,
                'max_depth' => $request->max_depth,
                'capacity' => $request->capacity,
                'description' => $request->description,
                'rules' => $request->rules,
                'address' => $request->address,
                'google_map' => $request->google_map,
            ]
        );

        Setting::updateOrCreate(
            ['id' => 1],
            [
                'adult_price' => $request->adult_price,
                'child_price' => $request->child_price,
                'full_pool_price' => $request->full_pool_price,

                'min_duration' => $request->min_duration,
                'max_duration' => $request->max_duration,
                'step_minutes' => $request->step_minutes,

                'children_enabled' => $request->has('children_enabled'),
                'full_pool_enabled' => $request->has('full_pool_enabled'),
                'booking_enabled' => $request->has('booking_enabled'),

                // Payment Settings
                'pay_online' => $request->has('pay_online'),
                'pay_on_pool' => $request->has('pay_on_pool'),
                'offline_charge' => $request->offline_charge,
                'gateway_charge' => $request->gateway_charge,
                'gst_percentage' => $request->gst_percentage,
            ]
        );

        return back()->with('success', 'Settings Updated Successfully');
    }
}
