@extends('layouts.admin')

@section('content')

    <div class="container">

        <h2 class="mb-4">
            Notifications
        </h2>

        <form method="POST" action="{{ route('admin.notifications.readAll') }}" class="mb-4">

            @csrf

            <button class="btn btn-primary">

                Mark All as Read

            </button>

        </form>

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

                            <form method="POST" action="{{ route('admin.notifications.delete', $notification) }}" class="mt-2">

                                @csrf

                                @method('DELETE')

                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this notification?')">

                                    Delete

                                </button>

                            </form>

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