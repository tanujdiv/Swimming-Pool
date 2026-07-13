@extends('layouts.app')

@section('content')

    <div class="membership-history-wrapper">

        <div class="container">

            <div class="membership-history-card">

                <div class="membership-history-header">

                    <div class="membership-history-icon">
                        📜
                    </div>

                    <h2 class="membership-history-title">
                        Membership History
                    </h2>

                    <p class="membership-history-subtitle">
                        Track your active, expiring, and previous subscription details below.
                    </p>

                </div>

                <div class="table-responsive">

                    <table class="table table-bordered align-middle membership-history-table">

                        <thead>
                            <tr>
                                <th>Plan</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($purchases as $purchase)
                                <tr>
                                    <td class="plan-name-cell">{{ $purchase->membership->name ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($purchase->start_date)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($purchase->end_date)->format('d M Y') }}</td>
                                    <td>
                                        @php
                                            $daysLeft = now()->diffInDays($purchase->end_date, false);
                                        @endphp

                                        @if($purchase->status == 'expired')
                                            <span class="membership-history-status status-expired">Expired</span>
                                        @elseif($daysLeft <= 3)
                                            <span class="membership-history-status status-warning">Expiring Soon</span>
                                        @else
                                            <span class="membership-history-status status-active">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($purchase->status == 'expired')
                                            <form method="POST" action="{{ route('membership.renew', $purchase->id) }}"
                                                class="d-inline">
                                                @csrf
                                                <button class="membership-history-renew-btn">
                                                    🔄 Renew
                                                </button>
                                            </form>
                                        @else
                                            <span class="no-action-dash">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 empty-history-text">
                                        😔 No Membership History Found.

                                        <br><br>

                                        <a href="{{ route('memberships') }}" class="btn btn-primary">
                                            Purchase / Renew Plan
                                        </a>
                                                </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection