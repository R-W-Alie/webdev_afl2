@extends('layout.main')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 75vh;">
    <div class="card shadow-sm border rounded-3 p-4" style="max-width: 400px; width: 100%; border-color: #D4C4B0;">
        <h3 class="text-center mb-4 text-dark fw-light" style="letter-spacing: 0.05em;">Login</h3>

        @if ($errors->any())
            <div class="alert alert-danger py-2">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label text-secondary fw-normal">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="form-control border border-secondary rounded-2" 
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary fw-normal">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-control border border-secondary rounded-2" 
                    required
                >
            </div>

            <button type="submit" class="btn w-100 text-white" style="background-color: #2C2416; border-color: #2C2416; letter-spacing: 0.05em;">
                Login
            </button>
        </form>

        <hr class="my-4" style="border-color: #D4C4B0;">

        <p class="text-center text-secondary mb-0">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-decoration-none fw-normal" style="color: #2C2416;">Register here</a>
        </p>
    </div>
</div>
@endsection
