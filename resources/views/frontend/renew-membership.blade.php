@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="renew-box text-center">
            <h2 class="mb-3">Renew Membership</h2>

            <p class="mb-4">
                Your membership has expired or is expiring soon.
            </p>

            <a href="{{ route('memberships') }}" class="btn btn-primary">
                Purchase / Renew Plan
            </a>
        </div>
    </div>
@endsection