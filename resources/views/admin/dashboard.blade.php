@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <h4>Capacity</h4>
                <h2>{{ $pool->capacity ?? 0 }}</h2>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <h4>Occupied</h4>
                <h2>{{ $currentOccupancy }}</h2>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stat-card">
                <h4>Revenue</h4>
                <h2>₹{{ $revenue }}</h2>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="dash-card">
                <h5>Total Memberships</h5>
                <h2>{{ $totalMemberships }}</h2>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="dash-card">
                <h5>Active Memberships</h5>
                <h2>{{ $activeMemberships }}</h2>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="dash-card">
                <h5>Expired Memberships</h5>
                <h2>{{ $expiredMemberships }}</h2>
            </div>
        </div>
    </div>

    <div class="stat-card mt-3">
        <h4>Active Bookings</h4>
        <h2>{{ $activeBookings }}</h2>
    </div>


@endsection