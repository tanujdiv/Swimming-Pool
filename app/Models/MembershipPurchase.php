<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPurchase extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'phone',
        'email',
        'membership_id',
        'price',
        'start_date',
        'end_date',
        'status'
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
