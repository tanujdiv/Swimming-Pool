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

            <a href="#">Dashboard</a>
            <a href="#">Bookings</a>
            <a href="#">Customers</a>
            <a href="{{ route('setting') }}">Settings</a>

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