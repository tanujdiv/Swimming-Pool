@extends('layouts.app')

@section('content')

    <nav class="navbar navbar-expand-lg navbar-dark custom-nav">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Aqua Pool</a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('booking') }}">Booking</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('memberships') }}">Membership</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('membership.renew.page') }}">Renew
                            Membership</a></li>


                </ul>

                <form action="/logout" method="POST">
                    @csrf
                    <button class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="overlay">
            <div class="container text-center text-white">
                <h1 class="display-3 fw-bold">Premium Swimming Experience</h1>
                <p class="lead">Book your swimming session instantly</p>
                <a href="#" class="btn btn-lg book-btn">Book Now</a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container text-center">
            <h2>Why Choose Us?</h2>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="feature-card">
                        <h4>Clean Water</h4>
                        <p>Daily filtration and cleaning.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <h4>Certified Trainers</h4>
                        <p>Professional swimming coaches.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <h4>Safe Environment</h4>
                        <p>24/7 safety monitoring.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection