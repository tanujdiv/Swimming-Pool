@extends('layouts.app')

@section('content')

    <div class="booking-payment-wrapper">

        <div class="container">

            @if(session('success'))
                <div class="alert alert-success booking-payment-alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger booking-payment-alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="booking-payment-card">

                <div class="booking-payment-header">

                    <div class="booking-payment-icon">
                        💳
                    </div>

                    <h2 class="booking-payment-title">
                        Booking Summary
                    </h2>

                    <p class="booking-payment-subtitle">
                        Please review your booking details and select a payment method.
                    </p>

                </div>

                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle booking-payment-table">
                        <tbody>
                            <tr>
                                <th width="40%">Name</th>
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
                                <td class="discount-text">
                                    ₹{{ number_format($discount, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <th>Subtotal</th>
                                <td>
                                    ₹<span id="subtotalText">{{ number_format($subtotal, 2) }}</span>
                                </td>
                            </tr>
                            <tr id="offlineChargeRow" style="display:none;">
                                <th>Pay On Pool Charge</th>
                                <td>
                                    ₹<span id="offlineChargeText">{{ number_format($setting->offline_charge, 2) }}</span>
                                </td>
                            </tr>
                            <tr id="gatewayChargeRow">
                                <th>Gateway Charge</th>
                                <td>
                                    ₹<span id="gatewayChargeText">{{ number_format($setting->gateway_charge, 2) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>GST</th>
                                <td>
                                    ₹<span id="gstAmount">0.00</span>
                                </td>
                            </tr>
                            <tr class="final-amount-row">
                                <th>Final Amount</th>
                                <th>
                                    ₹<span id="finalAmount">0.00</span>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <form id="paymentForm" method="POST" action="{{ route('booking.confirm') }}">

                    @csrf

                    @foreach($requestData as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <input type="hidden" id="subtotal_input" name="subtotal" value="{{ $subtotal }}">
                    <input type="hidden" id="offline_charge" value="{{ $setting->offline_charge }}">
                    <input type="hidden" id="gateway_charge" value="{{ $setting->gateway_charge }}">
                    <input type="hidden" id="gst_percentage" value="{{ $setting->gst_percentage }}">

                    <div class="mb-4">

                        <label class="booking-payment-label">
                            Select Payment Method
                        </label>

                        @if($setting->pay_online)
                            <div class="form-check booking-payment-radio mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" value="online" id="payOnline"
                                    checked>
                                <label class="form-check-label" for="payOnline">
                                    Pay Online (Razorpay)
                                </label>
                            </div>
                        @endif

                        @if($setting->pay_on_pool)
                            <div class="form-check booking-payment-radio">
                                <input class="form-check-input" type="radio" name="payment_method" value="offline"
                                    id="payOffline">
                                <label class="form-check-label" for="payOffline">
                                    Pay On Pool
                                </label>
                            </div>
                        @endif

                    </div>

                    <button id="continueBtn" class="booking-payment-btn">
                        Continue & Confirm
                    </button>

                </form>

            </div>

        </div>

    </div>

    <script>
        const form = document.getElementById("paymentForm");
        const btn = document.getElementById("continueBtn");

        function calculateTotal() {
            let subtotal = parseFloat(document.getElementById("subtotal_input").value);
            let originalSubtotal = {{ $subtotal }};
            let offline = parseFloat(document.getElementById("offline_charge").value);
            let gateway = parseFloat(document.getElementById("gateway_charge").value);
            let gst = parseFloat(document.getElementById("gst_percentage").value);
            let method = document.querySelector('input[name="payment_method"]:checked').value;

            subtotal = originalSubtotal;

            if (method == "offline") {
                document.getElementById("offlineChargeRow").style.display = "";
                document.getElementById("gatewayChargeRow").style.display = "none";
                subtotal += offline;
            } else {
                document.getElementById("offlineChargeRow").style.display = "none";
                document.getElementById("gatewayChargeRow").style.display = "";
                subtotal += gateway;
            }

            let gstAmount = (subtotal * gst) / 100;
            let finalAmount = subtotal + gstAmount;

            document.getElementById("gstAmount").innerHTML = gstAmount.toFixed(2);
            document.getElementById("finalAmount").innerHTML = finalAmount.toFixed(2);
            document.getElementById("subtotal_input").value = finalAmount.toFixed(2);
        }

        document.querySelectorAll('input[name="payment_method"]').forEach(function (item) {
            item.addEventListener("change", calculateTotal);
        });

        calculateTotal();

        btn.addEventListener("click", function (e) {
            e.preventDefault();
            btn.disabled = true;
            btn.innerHTML = "Please Wait...";

            let method = document.querySelector('input[name="payment_method"]:checked').value;

            if (method === "online") {
                form.action = "{{ route('booking.online.payment') }}";
            } else {
                form.action = "{{ route('booking.confirm') }}";
            }

            form.submit();
        });
    </script>

@endsection