<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $fillable = [
        'date',
        'is_closed',
        'open_time',
        'close_time'
    ];
}