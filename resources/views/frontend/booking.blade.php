@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container py-5">
        <div class="booking-box">

            <h2 class="mb-4">Book Swimming Slot</h2>

            <form method="POST" action="{{ route('booking.store') }}">
                @csrf

                <label>Name</label>
                <input name="customer_name" class="form-control mb-3">

                <label>Phone</label>
                <input name="phone" class="form-control mb-3">

                <label>Email</label>
                <input name="email" class="form-control mb-3">

                <label>Adults</label>
                <input name="adults" type="number" class="form-control mb-3">

                @if($setting && $setting->children_enabled)
                    <label>Children</label>
                    <input name="children" type="number" class="form-control mb-3">
                @endif

                <label>Date</label>
                <input name="booking_date" type="date" class="form-control mb-3">

                <label>Start Time</label>
                <input name="start_time" type="time" class="form-control mb-3">

                <label>Duration</label>
                <select name="duration_hours" class="form-control mb-3">
                    <option value="1">1 Hour</option>
                    <option value="1.5">1.5 Hour</option>
                    <option value="2">2 Hour</option>
                    <option value="2.5">2.5 Hour</option>
                    <option value="3">3 Hour</option>
                    <option value="3.5">3.5 Hour</option>
                    <option value="4">4 Hour</option>
                </select>

                <label>Coupon Code</label>
                <input name="coupon_code" class="form-control mb-3">

                <button class="btn btn-primary w-100">Book Now</button>
            </form>

        </div>
    </div>

@endsection