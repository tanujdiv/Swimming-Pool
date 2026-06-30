<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

    <div class="admin-wrapper">

        <div class="sidebar">
            <h3>Pool Admin</h3>

            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>

                <li>
                    <a href="{{ route('admin.bookings') }}">Bookings</a>
                </li>

                <li>
                    <a href="{{ route('admin.availability') }}">Availability</a>
                </li>

                <li>
                    <a href="{{ route('setting') }}">Settings</a>
                </li>
            </ul>

            <form action="/logout" method="POST">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>
        </div>

        <div class="main-content">
            @yield('content')
        </div>

    </div>

</body>

</html>