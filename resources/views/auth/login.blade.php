@extends('layouts.app')

@section('content')

<div class="login-page-wrapper">

    <div class="login-page-card">

        <div class="login-page-icon">

            <i class="bi bi-person-circle"></i>

        </div>

        <h2 class="login-page-title">
            Welcome Back
        </h2>

        <p class="login-page-subtitle">
            Login to continue your swimming pool account.
        </p>

        <form method="POST" action="/login">

            @csrf

            <div class="mb-3">

                <label class="login-page-label">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control login-page-input"
                    placeholder="Enter your email">

            </div>

            <div class="mb-4">

                <label class="login-page-label">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control login-page-input"
                    placeholder="Enter your password">

            </div>

            <button class="login-page-btn">

                Login

            </button>

        </form>

        <div class="login-page-footer">

            Don't have an account?

            <a href="/register">

                Register

            </a>

        </div>

    </div>

</div>

@endsection