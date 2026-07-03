@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="renew-box">
        <h2 class="mb-3">Renew Membership</h2>
        <p class="text-muted mb-4">
            Your membership has expired or is about to expire.
            Contact admin or purchase a new membership plan.
        </p>

        <a href="{{ route('memberships') }}" class="btn btn-primary">
            Buy Membership
        </a>
    </div>
</div>
@endsection