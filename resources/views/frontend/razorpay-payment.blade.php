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

        </div>

    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>

        var options = {

            key: "{{ config('razorpay.key') }}",

            amount:{{ $amount * 100 }},

            currency: "INR",

            name: "Swimming Pool",

            description: "Booking Payment",

            handler: function (response) {

                alert("Payment Successful");

            }

        };

        var rzp = new Razorpay(options);

        document
            .getElementById('rzp-button')
            .onclick = function (e) {

                rzp.open();

                e.preventDefault();

            }

    </script>

@endsection