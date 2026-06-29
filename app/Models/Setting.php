<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'adult_price',
        'child_price',
        'full_pool_price',
        'min_duration',
        'max_duration',
        'step_minutes',
        'children_enabled',
        'full_pool_enabled',
        'booking_enabled'
    ];
}
