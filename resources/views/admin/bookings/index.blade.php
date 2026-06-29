@extends('layouts.admin')

@section('content')

    <div class="booking-list-box">
        <h2>All Bookings</h2>

        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>People</th>
                    <th>Status</th>
                </tr>

                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->customer_name }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                        <td>{{ $booking->total_people }}</td>
                        <td>{{ $booking->status }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{ $bookings->links() }}
    </div>

@endsection