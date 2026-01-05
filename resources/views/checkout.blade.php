@extends('layout.main')

@section('title', 'Checkout - KEL & CO')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Left: Checkout Form -->
        <div class="col-lg-7">
            <div class="mb-4">
                <h1 class="h3 text-uppercase fw-light mb-1" style="letter-spacing:0.2em; color:#2C2416;">Checkout</h1>
                <div class="text-muted small" style="letter-spacing:0.05em;">Complete your purchase</div>
            </div>

            <form method="POST" action="{{ route('checkout.store') }}">
                @csrf

                <!-- Shipping Address -->
                <div class="card shadow-sm mb-4" style="border:1px solid #D4C4B0;">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase fw-light mb-3" style="letter-spacing:0.12em; color:#2C2416;">
                            <i class="fa-solid fa-location-dot me-2"></i>Shipping Address
                        </h6>

                        @if($addresses->isEmpty())
                            <div class="alert alert-warning mb-3">
                                <i class="fa-solid fa-exclamation-triangle me-2"></i>
                                No addresses saved. <a href="{{ route('profile.edit') }}" class="alert-link">Add an address</a>
                            </div>
                        @else
                            <div class="row g-2">
                                @foreach($addresses as $address)
                                    <div class="col-12">
                                        <div class="form-check p-3 rounded" style="background:#F5F1E8; border:1px solid #D4C4B0;">
                                            <input class="form-check-input" type="radio" name="address_id" 
                                                id="address_{{ $address->id }}" 
                                                value="{{ $address->id }}"
                                                @checked($defaultAddress?->id === $address->id)>
                                            <label class="form-check-label w-100" for="address_{{ $address->id }}">
                                                <div class="fw-normal" style="color:#2C2416;">
                                                    {{ $address->address_line1 }}
                                                    @if($address->address_line2)
                                                        <br><span class="small text-muted">{{ $address->address_line2 }}</span>
                                                    @endif
                                                </div>
                                                <div class="small text-muted mt-1">
                                                    {{ $address->city }} {{ $address->postal_code }}
                                                </div>
                                                @if($address->is_default)
                                                    <div class="mt-2">
                                                        <span class="badge" style="background:#8B7355; color:white;">Default Address</span>
                                                    </div>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @error('address_id')
                                <div class="alert alert-danger mt-3">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>
                </div>

                <!-- Order Notes -->
                <div class="card shadow-sm mb-4" style="border:1px solid #D4C4B0;">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase fw-light mb-3" style="letter-spacing:0.12em; color:#2C2416;">
                            <i class="fa-solid fa-note-sticky me-2"></i>Order Notes (Optional)
                        </h6>
                        <textarea name="notes" rows="3" class="form-control" 
                            placeholder="Add any special requests or notes..." 
                            style="border-color:#D4C4B0;"></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn w-100 btn-dark btn-lg" 
                    style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">
                    <i class="fa-solid fa-credit-card me-2"></i>Proceed to Payment
                </button>
            </form>
        </div>

        <!-- Right: Order Summary -->
        <div class="col-lg-5">
            <div class="card shadow-sm" style="border:1px solid #D4C4B0;">
                <div class="card-body p-4">
                    <h6 class="text-uppercase fw-light mb-4" style="letter-spacing:0.12em; color:#2C2416;">
                        Order Summary
                    </h6>

                    <!-- Items -->
                    <div class="mb-4" style="max-height: 400px; overflow-y: auto;">
                        @foreach($cartItems as $item)
                            <div class="d-flex justify-content-between align-items-start mb-3 pb-3" style="border-bottom:1px solid #E8DCC8;">
                                <div class="flex-grow-1">
                                    <div class="fw-normal" style="color:#2C2416;">
                                        {{ $item->product->name }}
                                    </div>
                                    <div class="small text-muted mt-1">
                                        Qty: {{ $item->quantity }}
                                    </div>
                                </div>
                                <div class="text-end fw-normal" style="color:#8B7355;">
                                    Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Totals -->
                    <div style="border-top:2px solid #D4C4B0; padding-top:1.5rem;">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span style="color:#5C4D3C;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Shipping</span>
                            <span style="color:#5C4D3C;">TBD</span>
                        </div>
                        <div class="d-flex justify-content-between" style="font-size:1.2rem;">
                            <span class="fw-normal" style="color:#2C2416;">Total</span>
                            <span class="fw-normal" style="color:#2C2416;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="mt-4 p-3 rounded" style="background:#F5F1E8; border:1px solid #D4C4B0;">
                        <div class="small text-muted">
                            <i class="fa-solid fa-info-circle me-2" style="color:#8B7355;"></i>
                            You will be redirected to our secure payment gateway after confirming your order.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Cart Link -->
            <div class="mt-3">
                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100" 
                    style="border-color:#D4C4B0; color:#5C4D3C;">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back to Cart
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
