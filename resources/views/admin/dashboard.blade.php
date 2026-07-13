@extends('layouts.admin')

@section('content')

<div class="admin-dash-wrapper">

    <div class="container-fluid">

        <div class="admin-dash-header mb-4">
            <h2 class="admin-dash-main-title">📊 Pool Admin Dashboard</h2>
            <p class="admin-dash-subtitle">Real-time statistics, metrics, and summary of pool bookings.</p>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="admin-dash-stat-card card-blue">
                    <div class="admin-dash-card-icon">🏊</div>
                    <div>
                        <h4 class="admin-dash-card-label">Capacity</h4>
                        <h2 class="admin-dash-card-value">{{ $pool->capacity ?? 0 }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="admin-dash-stat-card card-orange">
                    <div class="admin-dash-card-icon">👥</div>
                    <div>
                        <h4 class="admin-dash-card-label">Occupied</h4>
                        <h2 class="admin-dash-card-value">{{ $currentOccupancy }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="admin-dash-stat-card card-green">
                    <div class="admin-dash-card-icon">₹</div>
                    <div>
                        <h4 class="admin-dash-card-label">Revenue</h4>
                        <h2 class="admin-dash-card-value">₹{{ number_format($revenue, 2) }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="admin-dash-grid-card">
                    <h5 class="admin-dash-grid-label">Total Memberships</h5>
                    <h2 class="admin-dash-grid-value text-default-color">{{ $totalMemberships }}</h2>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="admin-dash-grid-card border-success-glow">
                    <h5 class="admin-dash-grid-label">Active Memberships</h5>
                    <h2 class="admin-dash-grid-value text-success-color">{{ $activeMemberships }}</h2>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="admin-dash-grid-card border-danger-glow">
                    <h5 class="admin-dash-grid-label">Expired Memberships</h5>
                    <h2 class="admin-dash-grid-value text-danger-color">{{ $expiredMemberships }}</h2>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="admin-dash-grid-card border-warning-glow">
                    <h5 class="admin-dash-grid-label">Pending Bookings</h5>
                    <h2 class="admin-dash-grid-value text-warning-color">{{ $pendingBookings }}</h2>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="admin-dash-grid-card border-success-glow">
                    <h5 class="admin-dash-grid-label">Completed Bookings</h5>
                    <h2 class="admin-dash-grid-value text-success-color">{{ $completedBookings }}</h2>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="admin-dash-grid-card border-danger-glow">
                    <h5 class="admin-dash-grid-label">Cancelled Bookings</h5>
                    <h2 class="admin-dash-grid-value text-danger-color">{{ $cancelledBookings }}</h2>
                </div>
            </div>
        </div>

        <div class="admin-dash-banner-card mt-2">
            <div class="admin-dash-banner-content">
                <div>
                    <h4 class="admin-dash-banner-label">📅 Today's Bookings Summary</h4>
                    <p class="admin-dash-banner-desc">Total active schedule reservations managed today.</p>
                </div>
                <h2 class="admin-dash-banner-value">{{ $todayBookings }}</h2>
            </div>
        </div>

    </div>

</div>

@endsection