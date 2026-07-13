@extends('layouts.admin')

@section('content')

    <div class="admin-membership-purchase-wrapper">

        <div class="container-fluid">

            <div class="admin-membership-purchase-card">

                <div class="admin-membership-purchase-header">
                    <h2 class="admin-membership-purchase-title">📋 Membership Purchases</h2>
                    <p class="admin-membership-purchase-subtitle">Monitor customer subscriptions, track package pricing, end
                        dates, and manage renewals.</p>
                </div>

                <div class="table-responsive admin-membership-purchase-scroll-top" id="drag-purchase-container">
                    <table class="table table-bordered align-middle admin-membership-purchase-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Plan</th>
                                <th>Price</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td class="admin-membership-purchase-emp-text">{{ $purchase->customer_name }}</td>
                                    <td class="admin-membership-purchase-plan-badge">{{ $purchase->membership->name }}</td>
                                    <td class="admin-membership-purchase-price">₹{{ number_format($purchase->price, 2) }}</td>
                                    <td class="admin-membership-purchase-date">{{ $purchase->end_date }}</td>
                                    <td>
                                        @if($purchase->status == 'active')
                                            <span class="admin-membership-purchase-status status-active">Active</span>
                                        @else
                                            <span class="admin-membership-purchase-status status-expired">Expired</span>
                                        @endif
                                    </td>
                                    <td class="admin-membership-purchase-actions">
                                        @if($purchase->status == 'expired')
                                            <form method="POST" action="{{ route('membership.renew', $purchase) }}">
                                                @csrf
                                                <button class="admin-membership-purchase-btn btn-renew-action">
                                                    🔄 Renew Plan
                                                </button>
                                            </form>
                                        @else
                                            <span class="admin-membership-purchase-dash">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slider = document.getElementById('drag-purchase-container');
            let isDown = false;
            let startX;
            let scrollLeft;

            slider.addEventListener('mousedown', (e) => {
                if (e.target.tagName === 'BUTTON') return;

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