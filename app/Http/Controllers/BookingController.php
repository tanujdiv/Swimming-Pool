<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PoolInfo;
use App\Models\Setting;
use App\Models\Availability;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('frontend.booking', compact('setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'email'          => 'nullable|email|max:255',
            'adults'         => 'required|integer|min:1',
            'children'       => 'nullable|integer|min:0',
            'booking_date'   => 'required|date',
            'start_time'     => 'required',
            'duration_hours' => 'required|numeric|min:1',
        ]);

        $setting = Setting::first();
        $pool = PoolInfo::first();

        if (!$setting || !$pool) {
            return back()->with('error', 'Pool settings not configured.');
        }

        $children = $request->children ?? 0;
        $totalPeople = $request->adults + $children;

        if ($totalPeople > $pool->capacity) {
            return back()->with('error', 'Total people exceed pool capacity');
        }

        /*
        |--------------------------------------------------------------------------
        | Time Calculation
        |--------------------------------------------------------------------------
        */
        $bookingDate = $request->booking_date;

        $start = Carbon::parse($request->start_time);
        $end = $start->copy()->addMinutes($request->duration_hours * 60);

        $startAt = Carbon::parse(
            $bookingDate . ' ' . $start->format('H:i:s')
        );

        $endAt = Carbon::parse(
            $bookingDate . ' ' . $end->format('H:i:s')
        );

        /*
        |--------------------------------------------------------------------------
        | Availability Check
        |--------------------------------------------------------------------------
        */
        $availability = Availability::where('date', $bookingDate)->first();

        if ($availability) {
            if ($availability->is_closed) {
                return back()->with('error', 'Pool closed on selected date');
            }

            if ($availability->open_time && $availability->close_time) {
                $open = Carbon::parse(
                    $bookingDate . ' ' . $availability->open_time
                );

                $close = Carbon::parse(
                    $bookingDate . ' ' . $availability->close_time
                );

                if ($startAt < $open || $endAt > $close) {
                    return back()->with('error', 'Selected time not available');
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Overlap Capacity Check
        |--------------------------------------------------------------------------
        */
        $overlappingBookings = Booking::whereNotIn(
            'status',
            ['cancelled', 'completed']
        )
            ->where('start_at', '<', $endAt)
            ->where('end_at', '>', $startAt)
            ->get();

        $occupied = $overlappingBookings->sum('total_people');

        if (($occupied + $totalPeople) > $pool->capacity) {
            return back()->with(
                'error',
                'Not enough capacity for selected slot'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Price Calculation
        |--------------------------------------------------------------------------
        */
        $price =
            ($request->adults * $setting->adult_price * $request->duration_hours)
            +
            ($children * $setting->child_price * $request->duration_hours);

        /*
        |--------------------------------------------------------------------------
        | Coupon Apply
        |--------------------------------------------------------------------------
        */
        if ($request->coupon_code) {
            $coupon = Coupon::where('code', $request->coupon_code)
                ->where('is_active', true)
                ->first();

            if ($coupon) {
                if ($coupon->discount_type == 'fixed') {
                    $price -= $coupon->discount_value;
                } elseif ($coupon->discount_type == 'percent') {
                    $price -= ($price * $coupon->discount_value) / 100;
                }

                if ($price < 0) {
                    $price = 0;
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Save Booking
        |--------------------------------------------------------------------------
        */
        Booking::create([
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'adults' => $request->adults,
            'children' => $children,
            'total_people' => $totalPeople,
            'booking_date' => $bookingDate,
            'start_time' => $start->format('H:i:s'),
            'end_time' => $end->format('H:i:s'),
            'start_at' => $startAt,
            'end_at' => $endAt,
            'duration_hours' => $request->duration_hours,
            'total_price' => $price,
            'full_pool' => false,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Booking Successful');
    }
}
