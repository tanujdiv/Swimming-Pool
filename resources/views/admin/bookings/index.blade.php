@extends('layouts.admin')

@section('content')

    <div class="admin-booking-list-wrapper">

        <div class="container-fluid">

            <div class="admin-booking-list-card">

                <div class="admin-booking-list-header">
                    <h2 class="admin-booking-list-title">📋 All Bookings Management</h2>
                    <p class="admin-booking-list-subtitle">Monitor pool schedules, handle customer check-ins/check-outs, and
                        manage duration extensions.</p>
                </div>

                <!-- Scrollbar aur drag handling ke liye wrapper structure -->
                <div class="table-responsive admin-booking-scroll-top" id="drag-scroll-container">
                    <table class="table table-bordered align-middle admin-booking-list-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Time Slot</th>
                                <th>People</th>
                                <th>Adult</th>
                                <th>Children</th>
                                <th>Status</th>
                                <th>Total Price</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td class="admin-booking-list-emp-text">{{ $booking->customer_name }}</td>
                                    <td>{{ $booking->phone }}</td>
                                    <td class="admin-booking-list-email-text">{{ $booking->email }}</td>
                                    <td>{{ $booking->booking_date }}</td>
                                    <td class="admin-booking-list-time-badge">{{ $booking->start_time }} -
                                        {{ $booking->end_time }}</td>
                                    <td><span class="admin-booking-list-count-badge">{{ $booking->total_people }}</span></td>
                                    <td>{{ $booking->adults }}</td>
                                    <td>{{ $booking->children }}</td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <span class="admin-booking-list-status status-pending">Pending</span>
                                        @elseif($booking->status == 'checked_in')
                                            <span class="admin-booking-list-status status-checkin">Checked-In</span>
                                        @elseif($booking->status == 'checked_out')
                                            <span class="admin-booking-list-status status-checkout">Checked-Out</span>
                                        @else
                                            <span class="admin-booking-list-status status-default">{{ $booking->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="admin-booking-list-price">₹{{ number_format($booking->total_price, 2) }}
                                        </div>
                                        @if ($booking->due != null)
                                            <span class="admin-booking-list-due-tag">Due:
                                                ₹{{ number_format($booking->due, 2) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-uppercase">{{ $booking->payment_method }}</td>
                                    <td>
                                        @if($booking->payment_status == 'paid')
                                            <span class="admin-booking-list-status status-checkin">Paid</span>
                                        @else
                                            <span
                                                class="admin-booking-list-status status-pending">{{ $booking->payment_status }}</span>
                                        @endif
                                    </td>
                                    <td class="admin-booking-list-actions">
                                        @if ($booking->status == "pending" || $booking->due != null)
                                            <form method="POST" action="{{ route('admin.booking.checkin', $booking->id) }}"
                                                class="mb-2">
                                                @csrf
                                                <button class="admin-booking-list-btn btn-success-action">
                                                    @if ($booking->due != null)
                                                        💰 Pay Due & Clear
                                                    @else
                                                        🔑 Check-In
                                                    @endif
                                                </button>
                                            </form>
                                        @endif

                                        @if ($booking->status == "checked_in" && $booking->payment_status == "paid")
                                            <form method="POST" action="{{ route('admin.booking.checkout', $booking->id) }}"
                                                class="mb-2">
                                                @csrf
                                                <button class="admin-booking-list-btn btn-danger-action">🚪 Check-Out</button>
                                            </form>
                                        @endif

                                        @if ($booking->status == "checked_in")
                                            <div class="admin-booking-list-extend-box">
                                                <form method="POST" action="{{ route('admin.booking.extend', $booking->id) }}">
                                                    @csrf
                                                    <select name="extra_hours" class="form-select admin-booking-list-select mb-1">
                                                        <option value="0.5">+30 Min</option>
                                                        <option value="1">+1 Hour</option>
                                                    </select>
                                                    <button class="admin-booking-list-btn btn-primary-action">⏳ Extend</button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Wrapper styled for dark ecosystem -->
                <div class="admin-booking-list-pagination mt-4">
                    {{ $bookings->links() }}
                </div>

            </div>

        </div>

    </div>

    <!-- JavaScript to enable Hold & Drag Left/Right Scrolling feature -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slider = document.getElementById('drag-scroll-container');
            let isDown = false;
            let startX;
            let scrollLeft;

            slider.addEventListener('mousedown', (e) => {
                // Dropdowns ya buttons par drag select override na ho uske liye check
                if (e.target.tagName === 'BUTTON' || e.target.tagName === 'SELECT' || e.target.tagName === 'OPTION') return;

                isDown = true;
                slider.classList.add('active-dragging');
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });

            slider.addEventListener('mouseleave', () => {
                isDown = false;
                slider.classList.remove('active-dragging');
            });

            slider.addEventListener('mouseup', () => {
                isDown = false;
                slider.classList.remove('active-dragging');
            });

            slider.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - slider.offsetLeft;
                const walk = (x - startX) * 1.5; // Scroll speed modifier
                slider.scrollLeft = scrollLeft - walk;
            });
        });
    </script>

@endsection