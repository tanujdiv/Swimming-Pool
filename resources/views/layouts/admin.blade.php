<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Pool Admin Dashboard</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>

<body>

    <div class="admin-wrapper">

        <!-- Sidebar -->

        <aside class="sidebar">

            <div>

                <div class="logo">

                    <i class="bi bi-water"></i>

                    <span>Pool Admin</span>

                </div>

                <ul class="sidebar-menu">

                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-grid-fill"></i>
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.bookings') }}">
                            <i class="bi bi-calendar-check"></i>
                            Bookings
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.memberships') }}">
                            <i class="bi bi-award-fill"></i>
                            Memberships
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.membership.purchases') }}">
                            <i class="bi bi-credit-card"></i>
                            Membership Purchases
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.availability') }}">
                            <i class="bi bi-people-fill"></i>
                            Availability
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.coupons') }}">
                            <i class="bi bi-ticket-perforated-fill"></i>
                            Coupons
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.notifications') }}">
                            <i class="bi bi-bell-fill"></i>
                            Notifications

                            @if($unreadNotifications > 0)

                                <span class="menu-badge">

                                    {{ $unreadNotifications }}

                                </span>

                            @endif

                        </a>
                    </li>

                    <li>
                        <a href="{{ route('setting') }}">
                            <i class="bi bi-gear-fill"></i>
                            Settings
                        </a>
                    </li>

                </ul>

            </div>

            <form action="/logout" method="POST">

                @csrf

                <button class="logout-btn">

                    <i class="bi bi-box-arrow-right"></i>

                    Logout

                </button>

            </form>

        </aside>

        <!-- Main -->

        <main class="main-content">

            <div class="topbar">

                <div>

                    <h3>Swimming Pool Management</h3>

                    <small>Welcome Admin 👋</small>

                </div>

                <a href="{{ route('admin.notifications') }}" class="notification">

                    <i class="bi bi-bell-fill"></i>

                    @if($unreadNotifications > 0)

                        <span>

                            {{ $unreadNotifications }}

                        </span>

                    @endif

                </a>

            </div>

            <div class="content-card">

                @yield('content')

            </div>

        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>