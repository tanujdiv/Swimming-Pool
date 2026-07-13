<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Aqua Pool</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar sticky-top">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="/">
                <i class="bi bi-water me-2"></i>
                <span>Aqua Pool</span>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">

                <i class="bi bi-list text-white fs-2"></i>

            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item">
                        <a class="nav-link active" href="/">
                            <i class="bi bi-house-door me-1"></i>
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('booking') }}">
                            <i class="bi bi-calendar-check me-1"></i>
                            Booking
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('memberships') }}">
                            <i class="bi bi-award me-1"></i>
                            Membership
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('membership.history') }}">
                            <i class="bi bi-arrow-repeat me-1"></i>
                            Renew
                        </a>
                    </li>

                </ul>

                <div class="d-flex align-items-center">

                    @auth

                        <form action="/logout" method="POST">
                            @csrf

                            <button class="logout-btn">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>

                        </form>

                    @else

                        <a href="/login" class="login-btn me-2">
                            Login
                        </a>

                        <a href="/register" class="register-btn">
                            Register
                        </a>

                    @endauth

                </div>

            </div>

        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>