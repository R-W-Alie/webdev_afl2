@extends('layout.main')

@section('title', 'Edit Profile - Kel & Co')

@section('styles')
<style>
    .edit-section {
        min-height: 75vh;
        display: flex;
        align-items: center;
        padding: 80px 0;
    }

    .edit-card {
        background-color: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        max-width: 550px;
        margin: 0 auto;
        padding: 40px 45px;
    }

    .form-label {
        font-weight: 500;
        color: #5C4D3C;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #C9B8A3;
        padding: 10px 14px;
    }

    .btn-save {
        background-color: #2C2416;
        border: 1px solid #2C2416;
        color: white;
        padding: 12px 32px;
        border-radius: 8px;
        transition: 0.3s ease;
        letter-spacing: 0.1em;
    }

    .btn-save:hover {
        background-color: #8B7355;
        border-color: #8B7355;
    }

    .btn-cancel {
        border: 1px solid #2C2416;
        padding: 12px 32px;
        border-radius: 8px;
        color: #2C2416;
        background: transparent;
        transition: 0.3s ease;
        letter-spacing: 0.1em;
    }

    .btn-cancel:hover {
        background-color: #C9B8A3;
        color: white;
        border-color: #C9B8A3;
    }
</style>
@endsection

@section('content')
<div class="edit-section">
    <div class="container">
        <div class="edit-card">

            <h3 class="text-center mb-4">Edit Profile</h3>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ $user->location }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        New Password <span class="text-muted">(optional)</span>
                    </label>
                    <input type="password" name="password" class="form-control" placeholder="Leave blank if not changing">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('profile') }}" class="btn-cancel">Cancel</a>
                    <button class="btn-save">Save Changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
