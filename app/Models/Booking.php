<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'customer_name',
        'phone',
        'email',
        'adults',
        'children',
        'total_people',
        'booking_date',
        'start_time',
        'end_time',
        'start_at',
        'end_at',
        'duration_hours',
        'total_price',
        'full_pool',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->whereNotIn('status', ['cancelled', 'completed']);
    }
}
