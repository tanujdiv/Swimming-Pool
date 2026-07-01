@extends('layouts.admin')

@section('content')

    <div class="booking-list-box">
        <h2 class="mb-4">Membership Purchases</h2>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Plan</th>
                        <th>Price</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->customer_name }}</td>
                            <td>{{ $purchase->membership->name }}</td>
                            <td>{{ $purchase->price }}</td>
                            <td>{{ $purchase->end_date }}</td>
                            <td>{{ $purchase->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection