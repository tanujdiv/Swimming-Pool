<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function index()
    {
        $data = Availability::latest()->get();
        return view('admin.availability.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required'
        ]);

        Availability::create([
            'date' => $request->date,
            'is_closed' => $request->has('is_closed'),
            'open_time' => $request->open_time,
            'close_time' => $request->close_time
        ]);

        return back()->with('success', 'Availability Saved');
    }
}
