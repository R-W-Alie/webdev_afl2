@extends('layout.main')

@section('title', 'Register')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 75vh;">
    <div class="card shadow-sm border rounded-3 p-4 my-5" style="max-width: 420px; width: 100%; border-color: #D4C4B0;">
        <h3 class="text-center mb-4 text-dark fw-light" style="letter-spacing: 0.05em;">Create Account</h3>

        @if ($errors->any())
            <div class="alert alert-danger py-2">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label text-secondary fw-normal">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control border border-secondary rounded-2" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary fw-normal">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control border border-secondary rounded-2" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary fw-normal">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control border border-secondary rounded-2">
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary fw-normal">Password</label>
                <input type="password" name="password" class="form-control border border-secondary rounded-2" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-secondary fw-normal">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control border border-secondary rounded-2" required>
            </div>

            <button type="submit" class="btn w-100 text-white" style="background-color: #2C2416; border-color: #2C2416; letter-spacing: 0.05em;">
                Register
            </button>
        </form>
    </div>
</div>
@endsection