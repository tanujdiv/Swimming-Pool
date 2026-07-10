@extends('layouts.app')

@section('content')

    <div class="booking-gateway-wrapper">

        <div class="container">

            @if(session('success'))
                <div class="alert alert-success booking-gateway-alert">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger booking-gateway-alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="booking-gateway-card">

                <div class="booking-gateway-header">

                    <div class="booking-gateway-icon">
                        🔒
                    </div>

                    <h2 class="booking-gateway-title">
                        Complete Payment
                    </h2>

                    <p class="booking-gateway-subtitle">
                        Securely complete your transaction via Razorpay gateway.
                    </p>

                </div>

                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle booking-gateway-table">
                        <tbody>
                            <tr>
                                <th width="40%">Name</th>
                                <td>{{ $booking['customer_name'] }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $booking['phone'] }}</td>
                            </tr>
                            <tr class="gateway-amount-row">
                                <th>Total Amount</th>
                                <th>
                                    ₹{{ number_format($amount, 2) }}
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button id="rzp-button" class="booking-gateway-btn">
                    💳 Pay ₹{{ number_format($amount, 2) }}
                </button>

                <form id="successForm" method="POST" action="{{ route('booking.confirm') }}">

                    @csrf

                    @foreach($booking as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <input type="hidden" name="payment_id" id="payment_id">
                    <input type="hidden" name="razorpay_signature" id="signature">
                    <input type="hidden" name="razorpay_order_id" id="order_id">

                </form>

            </div>

        </div>

    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        console.log("Blade Amount =", {{ $amount }});

        fetch("{{ route('payment.create') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({
                amount: {{ $amount }}
            })
        })
            .then(res => {
                console.log("Status:", res.status);
                return res.json();
            })
            .then(data => {
                console.log("Full Response:", data);
                console.log("Order Object:", data.order);

                let options = {
                    key: "{{ config('razorpay.key') }}",
                    amount: data.order.amount,
                    currency: data.order.currency,
                    name: "Swimming Pool",
                    description: "Swimming Pool Booking",
                    order_id: data.order.id,
                    prefill: {
                        name: "{{ $booking['customer_name'] }}",
                        contact: "{{ $booking['phone'] }}",
                        email: "{{ $booking['email'] }}"
                    },
                    notes: {
                        booking: "Swimming Pool"
                    },
                    handler: function (response) {
                        console.log("SUCCESS");
                        console.log(response);

                        alert("Payment Success");

                        document.getElementById("payment_id").value = response.razorpay_payment_id;
                        document.getElementById("order_id").value = response.razorpay_order_id;
                        document.getElementById("signature").value = response.razorpay_signature;

                        document.getElementById("successForm").submit();
                    },
                    modal: {
                        ondismiss: function () {
                            console.log("Popup Closed");
                        }
                    },
                    theme: {
                        color: "#0072ff" /* Matched with your brand/theme color */
                    }
                };

                console.log("Options:", options);

                // Binding the click trigger specifically to your customized button
                document.getElementById('rzp-button').onclick = function (e) {
                    new Razorpay(options).open();
                    e.preventDefault();
                }
            })
            .catch(err => {
                console.error(err);
            });
    </script>

@endsection