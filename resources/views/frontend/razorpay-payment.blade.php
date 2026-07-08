@extends('layouts.app')

@section('content')

    <div class="container py-5">

        <div class="payment-box">

            <h2 class="mb-4">
                Complete Payment
            </h2>

            <table class="table">

                <tr>
                    <th>Name</th>
                    <td>{{ $booking['customer_name'] }}</td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td>{{ $booking['phone'] }}</td>
                </tr>

                <tr>
                    <th>Total Amount</th>
                    <td>
                        ₹{{ number_format($amount, 2) }}
                    </td>
                </tr>

            </table>

            <button id="rzp-button" class="btn btn-success w-100">

                Pay ₹{{ number_format($amount, 2) }}

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

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>

        fetch("{{ route('payment.create') }}", {

            method: "POST",

            headers: {

                'X-CSRF-TOKEN': '{{ csrf_token() }}',

                'Content-Type': 'application/json'

            },

            body: JSON.stringify({

                amount:{{ $amount }}

                    })

        })

            .then(res => res.json())

            .then(data => {

                let options = {

                    key: "{{ config('razorpay.key') }}",

                    amount: data.order.amount,

                    currency: data.order.currency,

                    name: "Swimming Pool",

                    description: "Swimming Pool Booking",

                    order_id: data.order.id,

                    handler: function (response) {

                        document.getElementById("payment_id").value =
                            response.razorpay_payment_id;

                        document.getElementById("order_id").value =
                            response.razorpay_order_id;

                        document.getElementById("signature").value =
                            response.razorpay_signature;

                        document.getElementById("successForm").submit();

                    },

                        theme: {

                        color: "#0d6efd"

                    }

                };

                new Razorpay(options).open();

            });

    </script>

@endsection