@extends('layout.main')

@section('title', 'Register')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card p-4 shadow-lg" style="width: 380px; border-radius: 18px;">
        <h3 class="text-center mb-3">Create Account</h3>

        <form method="POST" action="{{ route('register.process') }}">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control rounded-3" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control rounded-3" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control rounded-3" required>
            </div>

            <button class="btn w-100 mt-2"
            style="
                background: #292929;
                color: white;
                border-radius: 10px;
                transition: 0.2s;
            "
            onmouseover="this.style.background='#444'"
            onmouseout="this.style.background='#292929'">
                Register
            </button>
        </form>
    </div>
</div>
@endsection
