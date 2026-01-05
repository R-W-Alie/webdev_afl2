@extends('layout.main')

@section('title', 'Order Confirmation - KEL & CO')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="text-center mb-4">
                <div style="font-size:3rem; color:#8B7355; margin-bottom:1rem;">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <h1 class="h3 text-uppercase fw-light mb-2" style="letter-spacing:0.2em; color:#2C2416;">
                    Order Confirmed
                </h1>
                <div class="text-muted small" style="letter-spacing:0.05em;">Thank you for your purchase</div>
            </div>

            <div class="card shadow-sm mb-4" style="border:1px solid #D4C4B0;">
                <div class="card-body p-4">
                    <h6 class="text-uppercase fw-light mb-3" style="letter-spacing:0.12em; color:#2C2416;">
                        Order Details
                    </h6>

                    <div class="mb-3 pb-3" style="border-bottom:1px solid #E8DCC8;">
                        <div class="small text-muted mb-1">Order Number</div>
                        <div class="fw-normal" style="color:#2C2416; font-size:1.1rem;">
                            {{ $order->order_number }}
                        </div>
                    </div>

                    <div class="mb-3 pb-3" style="border-bottom:1px solid #E8DCC8;">
                        <div class="small text-muted mb-1">Order Date</div>
                        <div class="fw-normal" style="color:#2C2416;">
                            {{ $order->created_at->format('M d, Y H:i') }}
                        </div>
                    </div>

                    <div class="mb-3 pb-3" style="border-bottom:1px solid #E8DCC8;">
                        <div class="small text-muted mb-1">Status</div>
                        <div>
                            <span class="badge" style="background:#FFC107; color:#000;">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-3 pb-3" style="border-bottom:1px solid #E8DCC8;">
                        <div class="small text-muted mb-1">Shipping Address</div>
                        <div style="color:#2C2416;">
                            {{ $order->address->address_line1 }}
                            @if($order->address->address_line2)
                                <br>{{ $order->address->address_line2 }}
                            @endif
                            <br>{{ $order->address->city }}, {{ $order->address->postal_code }}
                        </div>
                    </div>

                    <div>
                        <div class="small text-muted mb-1">Total Amount</div>
                        <div class="fw-normal" style="color:#2C2416; font-size:1.2rem;">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Summary -->
            <div class="card shadow-sm mb-4" style="border:1px solid #D4C4B0;">
                <div class="card-body p-4">
                    <h6 class="text-uppercase fw-light mb-3" style="letter-spacing:0.12em; color:#2C2416;">
                        Items Ordered
                    </h6>

                    @foreach($order->items as $item)
                        <div class="d-flex justify-content-between align-items-start mb-2 pb-2" style="border-bottom:1px solid #E8DCC8;">
                            <div>
                                <div class="fw-normal" style="color:#2C2416;">{{ $item->product->name }}</div>
                                <div class="small text-muted">Qty: {{ $item->quantity }}</div>
                            </div>
                            <div class="text-end fw-normal" style="color:#8B7355;">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Next Steps -->
            <div class="p-4 rounded mb-4" style="background:#E8DCC8; border:1px solid #D4C4B0;">
                <h6 class="text-uppercase fw-light mb-2" style="letter-spacing:0.12em; color:#2C2416;">
                    What's Next?
                </h6>
                <ul class="small text-muted ps-3 mb-0">
                    <li>We're processing your payment</li>
                    <li>You'll receive an order confirmation email shortly</li>
                    <li>Track your order status in your <a href="{{ route('orders.history') }}" class="text-decoration-none" style="color:#8B7355;">order history</a></li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex gap-2">
                <a href="{{ route('orders.history') }}" class="btn btn-dark flex-grow-1" 
                    style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">
                    <i class="fa-solid fa-package me-2"></i>View Orders
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary flex-grow-1" 
                    style="border-color:#D4C4B0; color:#5C4D3C;">
                    <i class="fa-solid fa-shopping-bag me-2"></i>Continue Shopping
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
