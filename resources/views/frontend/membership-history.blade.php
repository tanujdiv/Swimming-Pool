@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="history-box">
            <h2 class="mb-4">Membership History</h2>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Plan</th>
                        <th>Start</th>
                        <th>Expiry</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->membership->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($purchase->start_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($purchase->end_date)->format('d M Y') }}</td>
                            <td>
                                @php
                                    $daysLeft = now()->diffInDays($purchase->end_date, false);
                                @endphp

                                @if($purchase->status == 'expired')
                                    <span class="badge bg-danger">Expired</span>
                                @elseif($daysLeft <= 3)
                                    <span class="badge bg-warning">Expiring Soon</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td>
                                @if($purchase->status == 'expired')
                                    <form method="POST" action="{{ route('membership.renew', $purchase->id) }}">
                                        @csrf
                                        <button class="btn btn-warning btn-sm">
                                            Renew
                                        </button>
                                    </form>
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Membership History</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection