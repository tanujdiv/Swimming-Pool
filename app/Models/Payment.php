<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [

        'user_id',

        'booking_id',

        'membership_purchase_id',

        'razorpay_order_id',

        'razorpay_payment_id',

        'razorpay_signature',

        'amount',

        'payment_for',

        'status',

    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function membershipPurchase()
    {
        return $this->belongsTo(MembershipPurchase::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
