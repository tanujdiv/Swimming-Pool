<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipPurchase extends Model
{
    protected $fillable = [
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
}
