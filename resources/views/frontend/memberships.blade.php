@extends('layouts.app')

@section('content')

    <div class="membership-plan-wrapper">

        <div class="container">

            <div class="membership-plan-top-header">
                <h2 class="membership-plan-main-title">Membership Plans</h2>

                <a href="{{ route('membership.history') }}" class="membership-plan-history-btn">
                    📜 View History
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success membership-plan-alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger membership-plan-alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                @foreach($plans as $plan)
                    <div class="col-md-4 mb-4">

                        <div class="membership-plan-card">

                            <div class="membership-plan-badge">
                                🏊 Premium Access
                            </div>

                            <h3 class="membership-plan-name">
                                {{ $plan->name }}
                            </h3>

                            <div class="membership-plan-price-box">
                                <h4 class="membership-plan-price">₹{{ number_format($plan->price, 0) }}</h4>
                                <p class="membership-plan-days">{{ $plan->days }} Days Validity</p>
                            </div>

                            <form method="POST" action="{{ route('membership.buy') }}" class="membership-plan-form">
                                @csrf

                                <input type="hidden" name="membership_id" value="{{ $plan->id }}">

                                <div class="mb-3">
                                    <input class="form-control membership-plan-input" name="customer_name"
                                        placeholder="Full Name" required>
                                </div>

                                <div class="mb-3">
                                    <input class="form-control membership-plan-input" name="phone" placeholder="Phone Number"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <input class="form-control membership-plan-input" type="email" name="email"
                                        placeholder="Email Address" required>
                                </div>

                                <button class="membership-plan-btn">
                                    ⚡ Buy Now
                                </button>
                            </form>

                        </div>

                    </div>
                @endforeach
            </div>

        </div>

    </div>

@endsection