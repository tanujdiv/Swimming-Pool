<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Booking Invoice</title>

</head>

<body style="font-family:Arial">

    <h2>

        Booking Confirmed

    </h2>

    <p>

        Hello {{ $booking->customer_name }},

    </p>

    <p>

        Your booking has been confirmed.

    </p>

    <hr>

    <p>

        <b>Name :</b>

        {{ $booking->customer_name }}

    </p>

    <p>

        <b>Phone :</b>

        {{ $booking->phone }}

    </p>

    <p>

        <b>Email :</b>

        {{ $booking->email }}

    </p>

    <p>

        <b>Date :</b>

        {{ $booking->booking_date }}

    </p>

    <p>

        <b>Time :</b>

        {{ $booking->start_time }}

    </p>

    <p>

        <b>Duration :</b>

        {{ $booking->duration_hours }} Hour

    </p>

    <p>

        <b>Total Amount :</b>

        ₹{{ number_format($booking->total_price, 2) }}

    </p>

    <p>

        <b>Payment Status :</b>

        {{ ucfirst($booking->payment_status) }}

    </p>

    <hr>

    <h3>

        Thank You ❤️

    </h3>

    <p>

        Swimming Pool Management System

    </p>

</body>

</html>