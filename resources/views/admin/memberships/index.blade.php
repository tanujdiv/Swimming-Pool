@extends('layouts.admin')

@section('content')

    <div class="card p-4">
        <h2>Add Membership</h2>

        <form method="POST" action="{{ route('admin.memberships.store') }}">
            @csrf

            <input class="form-control mb-3" name="name" placeholder="Plan Name">

            <input class="form-control mb-3" name="price" placeholder="Price">

            <input class="form-control mb-3" name="days" placeholder="Days">

            <button class="btn btn-primary">Save</button>
        </form>
    </div>

    <hr>

    @foreach($plans as $plan)
        <div class="stat-card mb-3">
            <h4>{{ $plan->name }}</h4>
            <p>₹{{ $plan->price }}</p>
            <p>{{ $plan->days }} Days</p>
        </div>
    @endforeach

@endsection