<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $api = new Api(
            config('razorpay.key'),
            config('razorpay.secret')
        );

        $order = $api->order->create([

            'receipt' => 'BOOK_' . time(),

            'amount' => intval($request->amount * 100),

            'currency' => 'INR',

            'payment_capture' => 1,

        ]);

        return response()->json([

            'success' => true,

            'order' => $order

        ]);
    }
}