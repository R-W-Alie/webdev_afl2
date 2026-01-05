@extends('layout.main')

@section('title', 'Manage Addresses - Kel & Co')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h4 text-uppercase fw-light mb-1" style="letter-spacing:0.2em; color:#2C2416;">Manage Addresses</h1>
                    <div class="text-muted" style="letter-spacing:0.05em;">Addresses used for checkout</div>
                </div>
                <a href="{{ route('checkout.show') }}" class="btn btn-outline-secondary" style="border-color:#D4C4B0; color:#5C4D3C;">
                    Back to Checkout
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-left: 4px solid #8B7355;">
                    <i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm mb-4" style="border:1px solid #D4C4B0;">
                <div class="card-body">
                    <h6 class="fw-normal mb-3" style="color:#5C4D3C; letter-spacing:0.05em;">Add New Address</h6>
                    <form method="POST" action="{{ route('addresses.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                            <input type="text" name="address_line1" value="{{ old('address_line1') }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address Line 2</label>
                            <input type="text" name="address_line2" value="{{ old('address_line2') }}" class="form-control">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" name="city" value="{{ old('city') }}" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Postal Code <span class="text-danger">*</span></label>
                                <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="is_default" value="1" id="newDefault" {{ old('is_default') ? 'checked' : '' }}>
                            <label class="form-check-label" for="newDefault">Set as default</label>
                        </div>
                        <div class="mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark" style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">Save Address</button>
                        </div>
                    </form>
                </div>
            </div>

            @forelse($addresses as $address)
                <div class="card shadow-sm mb-3" style="border:1px solid #D4C4B0;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="badge {{ $address->is_default ? 'bg-dark' : 'bg-secondary' }}">{{ $address->is_default ? 'Default' : 'Address' }}</span>
                                <div class="fw-semibold" style="color:#2C2416;">{{ $address->address_line1 }}</div>
                                @if($address->address_line2)
                                    <div class="text-muted small">{{ $address->address_line2 }}</div>
                                @endif
                                <div class="text-muted small">{{ $address->city }} {{ $address->postal_code }}</div>
                            </div>
                            <div class="d-flex gap-2">
                                @if(!$address->is_default)
                                <form method="POST" action="{{ route('addresses.default', $address) }}">
                                    @csrf
                                    <button class="btn btn-outline-secondary btn-sm" style="border-color:#D4C4B0; color:#5C4D3C;">Make Default</button>
                                </form>
                                @endif
                                <form method="POST" action="{{ route('addresses.destroy', $address) }}" onsubmit="return confirm('Delete this address?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('addresses.update', $address) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                                <input type="text" name="address_line1" value="{{ old('address_line1', $address->address_line1) }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address Line 2</label>
                                <input type="text" name="address_line2" value="{{ old('address_line2', $address->address_line2) }}" class="form-control">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" name="city" value="{{ old('city', $address->city) }}" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Postal Code <span class="text-danger">*</span></label>
                                    <input type="text" name="postal_code" value="{{ old('postal_code', $address->postal_code) }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="is_default" value="1" id="default-{{ $address->id }}" {{ $address->is_default ? 'checked' : '' }}>
                                <label class="form-check-label" for="default-{{ $address->id }}">Set as default</label>
                            </div>
                            <div class="mt-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-dark" style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">Update Address</button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">No addresses yet. Add one above to use at checkout.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
