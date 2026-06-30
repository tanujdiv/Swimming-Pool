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
                    <th>Actions</th>
                </tr>

                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->customer_name }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                        <td>{{ $booking->total_people }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.booking.checkin', $booking->id) }}" class="mb-1">
                                @csrf
                                <button class="btn btn-success btn-sm">Check-In</button>
                            </form>

                            <form method="POST" action="{{ route('admin.booking.checkout', $booking->id) }}" class="mb-1">
                                @csrf
                                <button class="btn btn-danger btn-sm">Check-Out</button>
                            </form>

                            <form method="POST" action="{{ route('admin.booking.extend', $booking->id) }}">
                                @csrf
                                <select name="extra_hours" class="form-select mb-1">
                                    <option value="0.5">+30 Min</option>
                                    <option value="1">+1 Hour</option>
                                </select>
                                <button class="btn btn-primary btn-sm">Extend</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        {{ $bookings->links() }}
    </div>

@endsection