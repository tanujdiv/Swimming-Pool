<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingManagementController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->paginate(20);

        return view('admin.bookings.index', compact('bookings'));
    }
}