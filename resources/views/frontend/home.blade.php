@extends('layouts.app')

@section('content')

    <section class="home-page-hero">

        <div class="home-page-overlay">

            <div class="container">

                <div class="home-page-content">

                    <span class="home-page-badge">

                        Welcome to Aqua Pool

                    </span>

                    <h1 class="home-page-title">

                        Premium Swimming <br>

                        Experience For Everyone

                    </h1>

                    <p class="home-page-description">

                        Enjoy crystal clear water, professional trainers,
                        modern facilities and hassle-free online booking.

                    </p>

                    <div class="home-page-buttons">

                        <a href="{{ route('booking') }}" class="home-page-book-btn">

                            Book Now

                        </a>

                        <a href="{{ route('memberships') }}" class="home-page-membership-btn">

                            View Membership

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="home-page-feature-section">

        <div class="container">

            <div class="text-center">

                <h2 class="home-page-feature-title">

                    Why Choose Aqua Pool?

                </h2>

                <p class="home-page-feature-subtitle">

                    Everything you need for a premium swimming experience.

                </p>

            </div>

            <div class="row mt-5">

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="home-page-feature-card">

                        <div class="home-page-feature-icon">

                            💧

                        </div>

                        <h4>

                            Crystal Clear Water

                        </h4>

                        <p>

                            Daily filtration system keeps the pool clean,
                            fresh and hygienic.

                        </p>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="home-page-feature-card">

                        <div class="home-page-feature-icon">

                            🏊

                        </div>

                        <h4>

                            Professional Trainers

                        </h4>

                        <p>

                            Learn swimming from experienced and certified coaches.

                        </p>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6 mb-4">

                    <div class="home-page-feature-card">

                        <div class="home-page-feature-icon">

                            🛟

                        </div>

                        <h4>

                            Complete Safety

                        </h4>

                        <p>

                            Lifeguards and modern safety equipment available all day.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection