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

        <!-- Sidebar -->
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
                    <a href="{{ route('admin.memberships') }}">Memberships</a>
                </li>

                <li>
                    <a href="{{ route('admin.availability') }}">Availability</a>
                </li>

                <li>
                    <a href="{{ route('admin.coupons') }}">Coupons</a>
                </li>

                <li>
                    <a href="{{ route('admin.notifications') }}">Notifications</a>
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

        <!-- Main Content -->
        <div class="main-content">

            <!-- Top Header -->
            <div class="admin-topbar">
                <h4>Admin Dashboard</h4>

                <a href="{{ route('admin.notifications') }}" class="notification-bell">
                    🔔
                    <span class="notification-count">0</span>
                </a>
            </div>

            @yield('content')
        </div>

    </div>

</body>

</html>