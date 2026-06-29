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
            'adult_price' => 'required|numeric',
            'child_price' => 'required|numeric',
            'full_pool_price' => 'required|numeric',
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
            ['id'=>1],
            [
                'adult_price'=>$request->adult_price,
                'child_price'=>$request->child_price,
                'full_pool_price'=>$request->full_pool_price,
                'min_duration'=>$request->min_duration,
                'max_duration'=>$request->max_duration,
                'step_minutes'=>$request->step_minutes,
                'children_enabled'=>$request->has('children_enabled'),
                'full_pool_enabled'=>$request->has('full_pool_enabled'),
                'booking_enabled'=>$request->has('booking_enabled'),
            ]
        );

        return back()->with('success', 'Settings Updated');
    }
}