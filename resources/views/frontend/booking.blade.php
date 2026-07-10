@extends('layouts.app')

@section('content')

    <div class="booking-page-wrapper">

        <div class="container">

            @if(session('success'))
                <div class="alert alert-success booking-page-alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger booking-page-alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="booking-page-card">

                <div class="booking-page-header">

                    <div class="booking-page-icon">
                        🏊
                    </div>

                    <h2 class="booking-page-title">
                        Book Your Swimming Slot
                    </h2>

                    <p class="booking-page-subtitle">
                        Fill in the details below and reserve your slot instantly.
                    </p>

                </div>

                <form method="POST" action="{{ route('booking.payment') }}">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="booking-page-label">

                                Full Name

                            </label>

                            <input type="text" name="customer_name" class="form-control booking-page-input"
                                placeholder="Enter your full name">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="booking-page-label">

                                Phone Number

                            </label>

                            <input type="text" name="phone" class="form-control booking-page-input"
                                placeholder="Enter phone number">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="booking-page-label">

                                Email Address

                            </label>

                            <input type="email" name="email" class="form-control booking-page-input"
                                placeholder="Enter email">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="booking-page-label">

                                Adults

                            </label>

                            <input type="number" name="adults" class="form-control booking-page-input" min="1"
                                placeholder="Number of adults">

                        </div>

                        @if($setting && $setting->children_enabled)

                            <div class="col-md-6 mb-4">

                                <label class="booking-page-label">

                                    Children

                                </label>

                                <input type="number" name="children" class="form-control booking-page-input" min="0"
                                    placeholder="Number of children">

                            </div>

                        @endif

                        <div class="col-md-6 mb-4">

                            <label class="booking-page-label">

                                Booking Date

                            </label>

                            <input type="date" name="booking_date" class="form-control booking-page-input">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="booking-page-label">

                                Start Time

                            </label>

                            <input type="time" name="start_time" class="form-control booking-page-input">

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="booking-page-label">

                                Duration

                            </label>

                            <select name="duration_hours" class="form-select booking-page-input">

                                <option value="1">1 Hour</option>
                                <option value="1.5">1.5 Hours</option>
                                <option value="2">2 Hours</option>
                                <option value="2.5">2.5 Hours</option>
                                <option value="3">3 Hours</option>
                                <option value="3.5">3.5 Hours</option>
                                <option value="4">4 Hours</option>

                            </select>

                        </div>

                        <div class="col-12 mb-4">

                            <label class="booking-page-label">

                                Coupon Code

                            </label>

                            <input type="text" name="coupon_code" class="form-control booking-page-input"
                                placeholder="Enter coupon code (optional)">

                        </div>

                    </div>

                    <button type="submit" id="payButton" class="booking-page-btn">

                        💳 Pay & Book Slot

                    </button>

                </form>

            </div>

        </div>

    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

@endsection