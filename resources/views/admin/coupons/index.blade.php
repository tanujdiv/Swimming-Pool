@extends('layouts.admin')

@section('content')

    <div class="coupon-box">

        <h2 class="mb-4">Coupon Management</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.coupons.store') }}">
            @csrf

            <label class="form-label">Coupon Code</label>
            <input name="code" class="form-control mb-3">

            <label class="form-label">Discount Type</label>
            <select name="discount_type" class="form-control mb-3">
                <option value="fixed">Fixed</option>
                <option value="percent">Percent</option>
            </select>

            <label class="form-label">Discount Value</label>
            <input name="discount_value" class="form-control mb-3">

            <label class="form-label">Expiry Date</label>
            <input type="date" name="expires_at" class="form-control mb-3">

            <button class="btn btn-primary">Add Coupon</button>
        </form>

        <hr>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Expiry</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->discount_type }}</td>
                        <td>{{ $coupon->discount_value }}</td>
                        <td>{{ $coupon->expires_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection