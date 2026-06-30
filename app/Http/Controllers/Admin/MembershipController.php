<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $plans = Membership::latest()->get();

        return view('admin.memberships.index', compact('plans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'days'  => 'required|integer|min:1',
        ]);

        Membership::create($data);

        return back()->with('success', 'Membership Added Successfully');
    }
}
