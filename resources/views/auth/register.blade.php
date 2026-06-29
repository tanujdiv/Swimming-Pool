@extends('layouts.app')

@section('content')
    <div class="auth-page">
        <div class="auth-box">
            <h2>Create Account</h2>

            <form method="POST" action="/register">
                @csrf

                <input type="text" name="name" class="form-control mb-3" placeholder="Name">

                <input type="email" name="email" class="form-control mb-3" placeholder="Email">

                <input type="password" name="password" class="form-control mb-3" placeholder="Password">

                <input type="password" name="password_confirmation" class="form-control mb-3"
                    placeholder="Confirm Password">

                <button class="btn btn-primary w-100">Register</button>
            </form>

            <p class="mt-3 text-center">
                Already registered? <a href="/login">Login</a>
            </p>
        </div>
    </div>
@endsection