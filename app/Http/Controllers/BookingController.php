<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PoolInfo;
use App\Models\Setting;
use App\Models\Availability;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Membership;
use App\Models\MembershipPurchase;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

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
                ->where(function ($q) {
                    $q->whereNull('expires_at')
                        ->orWhere('expires_at', '>=', now()->toDateString());
                })
                ->first();

            if (!$coupon) {
                return back()->with('error', 'Invalid or expired coupon');
            }

            if ($coupon->discount_type == 'fixed') {
                $price -= $coupon->discount_value;
            } else {
                $price -= ($price * $coupon->discount_value) / 100;
            }

            if ($price < 0) {
                $price = 0;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Save Booking
        |--------------------------------------------------------------------------
        */
        // Booking::create([
        //     'customer_name' => $request->customer_name,
        //     'phone' => $request->phone,
        //     'email' => $request->email,
        //     'adults' => $request->adults,
        //     'children' => $children,
        //     'total_people' => $totalPeople,
        //     'booking_date' => $bookingDate,
        //     'start_time' => $start->format('H:i:s'),
        //     'end_time' => $end->format('H:i:s'),
        //     'start_at' => $startAt,
        //     'end_at' => $endAt,
        //     'duration_hours' => $request->duration_hours,
        //     'total_price' => $price,
        //     'full_pool' => false,
        //     'status' => 'pending',
        // ]);

        return back()->with('success', 'Booking Successful');
    }

    public function memberships()
    {
        $plans = Membership::latest()->get();
        return view('frontend.memberships', compact('plans'));
    }

    public function buyMembership(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')
                ->with('error', 'Please login first to buy membership');
        }

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'membership_id' => 'required|exists:memberships,id'
        ]);

        $membership = Membership::findOrFail($request->membership_id);

        $start = now()->toDateString();
        $end = now()->addDays($membership->days)->toDateString();

        MembershipPurchase::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'membership_id' => $membership->id,
            'price' => $membership->price,
            'start_date' => $start,
            'end_date' => $end,
            'status' => 'active',
        ]);

        return back()->with('success', 'Membership Purchased Successfully');
    }
    public function renewMembership(MembershipPurchase $purchase)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if ($purchase->user_id != Auth::id()) {
            abort(403);
        }

        $days = $purchase->membership->days;

        $purchase->end_date = now()
            ->addDays($days)
            ->toDateString();

        $purchase->status = 'active';
        $purchase->save();

        return back()->with('success', 'Membership Renewed Successfully');
    }

    public function paymentPage(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'duration_hours' => 'required|numeric|min:1',
        ]);

        $setting = Setting::first();

        $children = $request->children ?? 0;

        $price =
            ($request->adults * $setting->adult_price * $request->duration_hours)
            +
            ($children * $setting->child_price * $request->duration_hours);

        $discount = 0;

        if ($request->coupon_code) {

            $coupon = Coupon::where('code', $request->coupon_code)
                ->where('is_active', true)
                ->first();

            if ($coupon) {

                if ($coupon->discount_type == 'fixed') {

                    $discount = $coupon->discount_value;
                } else {

                    $discount = ($price * $coupon->discount_value) / 100;
                }
            }
        }

        $price -= $discount;

        if ($price < 0) {
            $price = 0;
        }

        return view(
            'frontend.booking-payment',
            [
                'requestData' => $request->all(),
                'subtotal' => $price,
                'discount' => $discount,
                'setting' => $setting,
            ]
        );
    }

    public function onlinePayment(Request $request)
    {
        $amount = $request->subtotal;

        return view(
            'frontend.razorpay-payment',
            [
                'booking' => $request->all(),
                'amount' => $amount
            ]
        );
    }

    public function confirmBooking(Request $request)
    {
        $request->validate([
            'customer_name'      => 'required|string|max:255',
            'phone'              => 'required|string|max:20',
            'email'              => 'nullable|email',
            'adults'             => 'required|integer|min:1',
            'children'           => 'nullable|integer|min:0',
            'booking_date'       => 'required|date',
            'start_time'         => 'required',
            'duration_hours'     => 'required|numeric|min:1',
            'subtotal'           => 'required|numeric',

            'payment_method'     => 'required|in:online,offline',

            'payment_id'         => 'nullable|string',
            'razorpay_order_id'  => 'nullable|string',
            'razorpay_signature' => 'nullable|string',
        ]);



        if ($request->payment_method == 'online') {

            $api = new Api(

                config('razorpay.key'),

                config('razorpay.secret')

            );

            try {

                $api->utility->verifyPaymentSignature([

                    'razorpay_order_id' => $request->razorpay_order_id,

                    'razorpay_payment_id' => $request->payment_id,

                    'razorpay_signature' => $request->razorpay_signature,

                ]);
            } catch (SignatureVerificationError $e) {

                return redirect()

                    ->route('booking')

                    ->with('error', 'Payment verification failed.');
            }
        }

        $setting = Setting::first();

        if (!$setting) {
            return redirect()
                ->route('booking')
                ->with('error', 'Pool settings not configured.');
        }

        $children = $request->children ?? 0;

        $calculatedAmount =
            ($request->adults * $setting->adult_price * $request->duration_hours)
            +
            ($children * $setting->child_price * $request->duration_hours);

        // Coupon
        if ($request->coupon_code) {

            $coupon = Coupon::where('code', $request->coupon_code)
                ->where('is_active', true)
                ->where(function ($q) {
                    $q->whereNull('expires_at')
                        ->orWhere('expires_at', '>=', now()->toDateString());
                })
                ->first();

            if ($coupon) {

                if ($coupon->discount_type == 'fixed') {
                    $calculatedAmount -= $coupon->discount_value;
                } else {
                    $calculatedAmount -= ($calculatedAmount * $coupon->discount_value) / 100;
                }
            }
        }

        if ($calculatedAmount < 0) {
            $calculatedAmount = 0;
        }

        // Gateway / Offline Charge
        if ($request->payment_method == 'online') {
            $calculatedAmount += $setting->gateway_charge;
        } else {
            $calculatedAmount += $setting->offline_charge;
        }

        // GST
        $gst = ($calculatedAmount * $setting->gst_percentage) / 100;

        $calculatedAmount += $gst;

        $calculatedAmount = round($calculatedAmount, 2);

        if (round((float) $request->subtotal, 2) != $calculatedAmount) {

            return redirect()
                ->route('booking')
                ->with('error', 'Invalid payment amount.');
        }

        if ((float) $request->subtotal !== (float) $calculatedAmount) {

            return redirect()
                ->route('booking')
                ->with('error', 'Invalid payment amount.');
        }

        $totalPeople = $request->adults + $children;

        $start = Carbon::parse($request->start_time);

        $end = $start->copy()->addMinutes($request->duration_hours * 60);



        DB::transaction(function () use (
            $request,
            $children,
            $totalPeople,
            $start,
            $end,
            $calculatedAmount,
        ) {

            $booking = Booking::create([

                'customer_name' => $request->customer_name,

                'phone' => $request->phone,

                'email' => $request->email,

                'adults' => $request->adults,

                'children' => $children,

                'total_people' => $totalPeople,

                'booking_date' => $request->booking_date,

                'start_time' => $start->format('H:i:s'),

                'end_time' => $end->format('H:i:s'),

                'start_at' => Carbon::parse(
                    $request->booking_date . ' ' . $start->format('H:i:s')
                ),

                'end_at' => Carbon::parse(
                    $request->booking_date . ' ' . $end->format('H:i:s')
                ),

                'duration_hours' => $request->duration_hours,

                'total_price' => $calculatedAmount,

                'payment_method' => $request->payment_method,

                'payment_status' => $request->payment_method == 'online'
                    ? 'paid'
                    : 'pending',

                'payment_id' => $request->payment_id,

                'razorpay_order_id' => $request->razorpay_order_id,

                'razorpay_signature' => $request->razorpay_signature,

                'status' => 'pending',

                'full_pool' => false,

            ]);


            Notification::create([

                'title' => 'New Booking',

                'message' =>
                $booking->customer_name .
                    ' booked a slot on ' .
                    $booking->booking_date .
                    ' at ' .
                    $booking->start_time,

            ]);

            Payment::create([

                'user_id' => Auth::id(),

                'booking_id' => $booking->id,

                'membership_purchase_id' => null,

                'razorpay_order_id' => $request->razorpay_order_id,

                'razorpay_payment_id' => $request->payment_id,

                'razorpay_signature' => $request->razorpay_signature,

                'amount' => $calculatedAmount,

                'payment_for' => 'booking',

                'status' => $request->payment_method == 'online'
                    ? 'paid'
                    : 'pending',

            ]);
        });
        return redirect()
            ->route('booking')
            ->with('success', 'Booking Successfully Created.');
    }
}
