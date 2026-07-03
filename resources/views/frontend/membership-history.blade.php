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
                    </tr>
                </thead>

                <tbody>
                    @forelse($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->membership->name ?? 'N/A' }}</td>
                            <td>{{ $purchase->start_date }}</td>
                            <td>{{ $purchase->end_date }}</td>
                            <td>
                                @if($purchase->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Expired</span>
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