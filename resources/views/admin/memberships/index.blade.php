@extends('layouts.admin')

@section('content')

    <div class="admin-membership-crud-wrapper">

        <div class="container-fluid">

            <div class="admin-membership-crud-header mb-4">
                <h2 class="admin-membership-crud-main-title">✨ Membership Plan Management</h2>
                <p class="admin-membership-crud-subtitle">Create new subscription packages and monitor existing membership
                    setups.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success admin-membership-crud-alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-lg-5 mb-4">
                    <div class="admin-membership-crud-card">
                        <h3 class="admin-membership-crud-card-title">➕ Add New Plan</h3>

                        <form method="POST" action="{{ route('admin.memberships.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="admin-membership-crud-label">Plan Name</label>
                                <input class="form-control admin-membership-crud-input" name="name"
                                    placeholder="e.g., Monthly Pro Pack" required>
                            </div>

                            <div class="mb-3">
                                <label class="admin-membership-crud-label">Price (₹)</label>
                                <input class="form-control admin-membership-crud-input" type="number" name="price"
                                    placeholder="e.g., 1499" required>
                            </div>

                            <div class="mb-3">
                                <label class="admin-membership-crud-label">Validity Duration (Days)</label>
                                <input class="form-control admin-membership-crud-input" type="number" name="days"
                                    placeholder="e.g., 30" required>
                            </div>

                            <button class="admin-membership-crud-btn">🚀 Save Plan</button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-7 mb-4">
                    <div class="admin-membership-crud-list-container">
                        <h3 class="admin-membership-crud-card-title mb-3">📋 Active Subscription Packages</h3>

                        <div class="row">
                            @forelse($plans as $plan)
                                <div class="col-md-6 mb-3">
                                    <div class="admin-membership-crud-stat-card">
                                        <div class="admin-membership-crud-badge">🏊 Pool Access</div>
                                        <h4 class="admin-membership-crud-plan-name">{{ $plan->name }}</h4>

                                        <div class="admin-membership-crud-details">
                                            <div class="admin-membership-crud-price">₹{{ number_format($plan->price, 2) }}</div>
                                            <div class="admin-membership-crud-days">⏱️ {{ $plan->days }} Days Validity</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="admin-membership-crud-empty">No subscription packages found. Create one using the
                                        form.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection