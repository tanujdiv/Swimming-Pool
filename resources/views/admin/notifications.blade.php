@extends('layouts.admin')

@section('content')

    <div class="container">

        <h2 class="mb-4">
            Notifications
        </h2>

        @forelse($notifications as $notification)

            <div class="card mb-3">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h5>
                                {{ $notification->title }}
                            </h5>

                            <p>
                                {{ $notification->message }}
                            </p>

                            <small class="text-muted">
                                {{ $notification->created_at->diffForHumans() }}
                            </small>

                        </div>

                        <div>

                            @if(!$notification->is_read)

                                <span class="badge bg-danger mb-2">
                                    Unread
                                </span>

                                <form method="POST" action="{{ route('admin.notifications.read', $notification->id) }}">

                                    @csrf

                                    <button class="btn btn-success btn-sm">

                                        Mark as Read

                                    </button>

                                </form>

                            @else

                                <span class="badge bg-success">
                                    Read
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="alert alert-info">

                No notifications found.

            </div>

        @endforelse

    </div>

@endsection