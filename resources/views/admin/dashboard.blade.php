@extends('layouts.admin')

@section('content')

<h1 class="mb-4">Dashboard</h1>

<div class="row g-4">

    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <h3>50</h3>
            <p>Total Capacity</p>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <h3>23</h3>
            <p>Occupied</p>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <h3>₹18,000</h3>
            <p>Revenue</p>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <h3>12</h3>
            <p>Bookings</p>
        </div>
    </div>

</div>

@endsection