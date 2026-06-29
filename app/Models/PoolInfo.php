<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoolInfo extends Model
{
    protected $fillable = [
        'name',
        'type',
        'length',
        'width',
        'min_depth',
        'max_depth',
        'capacity',
        'description',
        'rules',
        'address',
        'google_map'
    ];
}
