@extends('layout.main')

@section('title', 'Edit Profile - Kel & Co')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('profile') }}" style="color: #8B7355;">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
                <h1 class="h3 text-uppercase fw-light mb-1" style="letter-spacing:0.2em; color:#2C2416;">
                    Edit Profile
                </h1>
                <div class="text-muted small" style="letter-spacing:0.05em;">Update your account information</div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert" style="border-left: 4px solid #8B7355;">
                    <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm" style="border:1px solid #D4C4B0;">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="form-control py-2 @error('name') is-invalid @enderror"
                                placeholder="Enter your name" style="border-color: #D4C4B0;">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="form-control py-2 @error('email') is-invalid @enderror"
                                placeholder="Enter your email" style="border-color: #D4C4B0;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                Phone
                            </label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="form-control py-2 @error('phone') is-invalid @enderror"
                                placeholder="Enter your phone number" style="border-color: #D4C4B0;">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-normal mb-2" style="color: #5C4D3C; letter-spacing: 0.05em;">Default address for checkout</h6>
                            <div class="mb-3">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">Address line 1</label>
                                <input type="text" name="address_line1" value="{{ old('address_line1', $defaultAddress->address_line1 ?? '') }}"
                                    class="form-control py-2 @error('address_line1') is-invalid @enderror"
                                    placeholder="Street, house number" style="border-color: #D4C4B0;">
                                @error('address_line1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">Address line 2</label>
                                <input type="text" name="address_line2" value="{{ old('address_line2', $defaultAddress->address_line2 ?? '') }}"
                                    class="form-control py-2 @error('address_line2') is-invalid @enderror"
                                    placeholder="Apartment, suite, etc." style="border-color: #D4C4B0;">
                                @error('address_line2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">City</label>
                                    <input type="text" name="city" value="{{ old('city', $defaultAddress->city ?? '') }}"
                                        class="form-control py-2 @error('city') is-invalid @enderror"
                                        placeholder="City" style="border-color: #D4C4B0;">
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">Postal code</label>
                                    <input type="text" name="postal_code" value="{{ old('postal_code', $defaultAddress->postal_code ?? '') }}"
                                        class="form-control py-2 @error('postal_code') is-invalid @enderror"
                                        placeholder="Postal code" style="border-color: #D4C4B0;">
                                    @error('postal_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-text mt-2">Saved as your default shipping address for checkout.</div>
                        </div>

                        <hr class="my-4" style="border-color: #D4C4B0;">

                        <h6 class="fw-normal mb-3" style="color: #5C4D3C; letter-spacing: 0.05em;">
                            Change Password (optional)
                        </h6>

                        <div class="mb-4">
                            <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                New Password
                            </label>
                            <input type="password" name="password"
                                class="form-control py-2 @error('password') is-invalid @enderror"
                                placeholder="Leave blank to keep current password" style="border-color: #D4C4B0;">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Minimum 8 characters</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-normal" style="color: #5C4D3C; letter-spacing: 0.05em;">
                                Confirm New Password
                            </label>
                            <input type="password" name="password_confirmation"
                                class="form-control py-2"
                                placeholder="Confirm new password" style="border-color: #D4C4B0;">
                        </div>

                        <div class="d-flex gap-2 pt-3">
                            <button type="submit" class="btn btn-dark px-4" style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">
                                <i class="fa-solid fa-check me-2"></i>Save Changes
                            </button>
                            <a href="{{ route('profile') }}" class="btn btn-outline-secondary px-4" style="border-color:#D4C4B0; color:#5C4D3C;">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
