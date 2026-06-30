@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Notifications</h2>

        @foreach($notifications as $notification)
            <div class="alert alert-warning">
                <strong>{{ $notification->title }}</strong><br>
                {{ $notification->message }}
            </div>
        @endforeach
    </div>
@endsection