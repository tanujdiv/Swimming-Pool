@extends('layouts.app')

@section('content')

    <div class="container py-5">

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

        <div class="payment-box">

            <h2 class="mb-4">
                Booking Summary
            </h2>

            <table class="table table-bordered align-middle">

                <tr>
                    <th width="35%">Name</th>
                    <td>{{ $requestData['customer_name'] }}</td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td>{{ $requestData['phone'] }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $requestData['email'] ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Adults</th>
                    <td>{{ $requestData['adults'] }}</td>
                </tr>

                <tr>
                    <th>Children</th>
                    <td>{{ $requestData['children'] ?? 0 }}</td>
                </tr>

                <tr>
                    <th>Date</th>
                    <td>{{ $requestData['booking_date'] }}</td>
                </tr>

                <tr>
                    <th>Start Time</th>
                    <td>{{ $requestData['start_time'] }}</td>
                </tr>

                <tr>
                    <th>Duration</th>
                    <td>{{ $requestData['duration_hours'] }} Hour</td>
                </tr>

                <tr>
                    <th>Coupon Discount</th>
                    <td class="text-success">
                        ₹{{ number_format($discount, 2) }}
                    </td>
                </tr>

                <tr class="table-primary">

                    <th>Total Amount</th>

                    <th>

                        ₹{{ number_format($subtotal, 2) }}

                    </th>

                </tr>

            </table>

            <form id="paymentForm" method="POST" action="{{ route('booking.confirm') }}">

                @csrf

                @foreach($requestData as $key => $value)

                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">

                @endforeach

                <input type="hidden" name="subtotal" value="{{ $subtotal }}">

                <div class="mb-4">

                    <label class="form-label fw-bold">

                        Select Payment Method

                    </label>

                    @if($setting->pay_online)

                        <div class="form-check mb-2">

                            <input class="form-check-input" type="radio" name="payment_method" value="online" checked>

                            <label class="form-check-label">

                                Pay Online

                            </label>

                        </div>

                    @endif

                    @if($setting->pay_on_pool)

                        <div class="form-check">

                            <input class="form-check-input" type="radio" name="payment_method" value="offline">

                            <label class="form-check-label">

                                Pay On Pool

                            </label>

                        </div>

                    @endif

                </div>

                <button id="continueBtn" class="btn btn-primary w-100">

                    Continue

                </button>

            </form>

        </div>

    </div>

    <script>

        const form = document.getElementById('paymentForm');

        const btn = document.getElementById('continueBtn');

        btn.addEventListener('click', function (e) {

            e.preventDefault();

            btn.disabled = true;

            btn.innerHTML = "Please Wait...";

            const method = document.querySelector(
                'input[name="payment_method"]:checked'
            ).value;

            if (method === "online") {

                form.action = "{{ route('booking.online.payment') }}";

            } else {

                form.action = "{{ route('booking.confirm') }}";

            }

            form.submit();

        });

    </script>

@endsection