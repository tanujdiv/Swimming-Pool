<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'name',
        'price',
        'days',
    ];


    public function purchases()
    {
        return $this->hasMany(MembershipPurchase::class);
    }
}
