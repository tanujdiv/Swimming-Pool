<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\PoolInfo;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingManagementController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->paginate(20);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function checkIn(Booking $booking)
    {
        $booking->status = 'checked_in';
        $booking->save();

        return back()->with('success', 'Customer Checked In');
    }

    public function checkOut(Booking $booking)
    {
        $booking->status = 'completed';
        $booking->save();

        return back()->with('success', 'Customer Checked Out');
    }

    public function extend(Request $request, Booking $booking)
    {
        $request->validate([
            'extra_hours' => 'required|numeric|min:0.5'
        ]);

        $setting = Setting::first();
        $pool = PoolInfo::first();

        $extraHours = $request->extra_hours;

        $newEnd = Carbon::parse($booking->end_at)
            ->addMinutes($extraHours * 60);

        $overlap = Booking::where('id', '!=', $booking->id)
            ->whereNotIn('status', ['cancelled', 'completed'])
            ->where('start_at', '<', $newEnd)
            ->where('end_at', '>', $booking->end_at)
            ->sum('total_people');

        if (($overlap + $booking->total_people) > $pool->capacity) {
            return back()->with('error', 'Cannot extend due to capacity');
        }

        $booking->end_at = $newEnd;
        $booking->end_time = $newEnd->format('H:i:s');

        $extraPrice =
            ($booking->adults * $setting->adult_price * $extraHours)
            +
            ($booking->children * $setting->child_price * $extraHours);

        $booking->duration_hours += $extraHours;
        $booking->total_price += $extraPrice;
        $booking->save();

        return back()->with('success', 'Booking Extended');
    }
}
