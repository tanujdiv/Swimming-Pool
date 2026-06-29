@extends('layouts.app')

@section('content')
    <div class="auth-page">
        <div class="auth-box">
            <h2>Login</h2>

            <form method="POST" action="/login">
                @csrf

                <input type="email" name="email" class="form-control mb-3" placeholder="Email">

                <input type="password" name="password" class="form-control mb-3" placeholder="Password">

                <button class="btn btn-primary w-100">Login</button>
            </form>

            <p class="mt-3 text-center">
                New user? <a href="/register">Register</a>
            </p>
        </div>
    </div>
@endsection