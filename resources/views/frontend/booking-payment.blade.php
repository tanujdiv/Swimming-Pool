@extends('layouts.app')

@section('content')

    <div class="container py-5">

        <div class="payment-box">

            <h2 class="mb-4">
                Booking Summary
            </h2>

            <table class="table">

                <tr>
                    <th>Name</th>
                    <td>{{ $requestData['customer_name'] }}</td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td>{{ $requestData['phone'] }}</td>
                </tr>

                <tr>
                    <th>Date</th>
                    <td>{{ $requestData['booking_date'] }}</td>
                </tr>

                <tr>
                    <th>Duration</th>
                    <td>{{ $requestData['duration_hours'] }} Hour</td>
                </tr>

                <tr>
                    <th>Discount</th>
                    <td>₹{{ $discount }}</td>
                </tr>

                <tr>
                    <th>Subtotal</th>
                    <td>₹{{ $subtotal }}</td>
                </tr>

            </table>

            <form method="POST" action="{{ route('booking.confirm') }}">

                @csrf

                @foreach($requestData as $key => $value)

                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">

                @endforeach

                <input type="hidden" name="subtotal" value="{{ $subtotal }}">

                <div class="mb-4">

                    <label class="form-label">
                        Payment Method
                    </label>

                    @if($setting->pay_online)

                        <div class="form-check">

                            <input type="radio" class="form-check-input" name="payment_method" value="online" checked>

                            Online Payment

                        </div>

                    @endif

                    @if($setting->pay_on_pool)

                        <div class="form-check">

                            <input type="radio" class="form-check-input" name="payment_method" value="offline">

                            Pay On Pool

                        </div>

                    @endif

                </div>

                <button class="btn btn-primary w-100">

                    Continue

                </button>

            </form>

        </div>

    </div>

@endsection