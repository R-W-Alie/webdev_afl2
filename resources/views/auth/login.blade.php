@extends('layout.main')

@section('title', 'Login')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 75vh;">
        <div class="card shadow-sm border rounded-3 p-4" style="max-width: 400px; width: 100%; border-color: #D4C4B0;">

            <h3 class="text-center mb-4 text-dark fw-light" style="letter-spacing: 0.05em;">
                Login
            </h3>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-secondary">Email</label>
                    <input type="email" name="email" class="form-control border border-secondary" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-secondary">Password</label>
                    <input type="password" name="password" class="form-control border border-secondary" required>
                </div>

                <button type="submit" class="btn w-100 text-white"
                    style="background-color: #2C2416; border-color: #2C2416;">
                    Login
                </button>

                <div class="mt-3 text-center">
                    <a href="/register" style="font-size: 0.9rem; color: #8B7355;">
                        Don't have an account? Register
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
