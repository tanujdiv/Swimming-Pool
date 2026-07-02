@extends('layouts.app')

@section('content')

    <section class="hero">
        <div class="overlay">
            <div class="container text-center text-white">
                <h1 class="display-3 fw-bold">Premium Swimming Experience</h1>
                <p class="lead">Book your swimming session instantly</p>
                <a href="{{ route('booking') }}" class="btn btn-lg book-btn">Book Now</a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container text-center">
            <h2>Why Choose Us?</h2>

            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="feature-card">
                        <h4>Clean Water</h4>
                        <p>Daily filtration and cleaning.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="feature-card">
                        <h4>Certified Trainers</h4>
                        <p>Professional swimming coaches.</p>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="feature-card">
                        <h4>Safe Environment</h4>
                        <p>24/7 safety monitoring.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection