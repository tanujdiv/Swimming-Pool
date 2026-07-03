@extends('layouts.app')

@section('content')

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Membership Plans</h2>

            <a href="{{ route('membership.history') }}" class="btn btn-outline-primary">
                View History
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @foreach($plans as $plan)
                <div class="col-md-4 mb-4">
                    <div class="membership-card">
                        <h3>{{ $plan->name }}</h3>
                        <h4>₹{{ $plan->price }}</h4>
                        <p>{{ $plan->days }} Days</p>

                        <form method="POST" action="{{ route('membership.buy') }}">
                            @csrf

                            <input type="hidden" name="membership_id" value="{{ $plan->id }}">

                            <input class="form-control mb-2" name="customer_name" placeholder="Name">

                            <input class="form-control mb-2" name="phone" placeholder="Phone">

                            <input class="form-control mb-2" name="email" placeholder="Email">

                            <button class="btn btn-primary w-100">
                                Buy Now
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection