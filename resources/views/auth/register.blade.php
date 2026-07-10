@extends('layouts.app')

@section('content')

    <div class="register-page-wrapper">

        <div class="register-page-card">

            <div class="register-page-icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>

            <h2 class="register-page-title">
                Create Account
            </h2>

            <p class="register-page-subtitle">
                Join Aqua Pool and start booking your swimming sessions.
            </p>

            <form method="POST" action="/register">

                @csrf

                <div class="mb-3">

                    <label class="register-page-label">
                        Full Name
                    </label>

                    <input type="text" name="name" class="form-control register-page-input"
                        placeholder="Enter your full name">

                </div>

                <div class="mb-3">

                    <label class="register-page-label">
                        Email Address
                    </label>

                    <input type="email" name="email" class="form-control register-page-input"
                        placeholder="Enter your email">

                </div>

                <div class="mb-3">

                    <label class="register-page-label">
                        Password
                    </label>

                    <input type="password" name="password" class="form-control register-page-input"
                        placeholder="Create password">

                </div>

                <div class="mb-4">

                    <label class="register-page-label">
                        Confirm Password
                    </label>

                    <input type="password" name="password_confirmation" class="form-control register-page-input"
                        placeholder="Confirm password">

                </div>

                <button class="register-page-btn">

                    Create Account

                </button>

            </form>

            <div class="register-page-footer">

                Already have an account?

                <a href="/login">

                    Login

                </a>

            </div>

        </div>

    </div>

@endsection