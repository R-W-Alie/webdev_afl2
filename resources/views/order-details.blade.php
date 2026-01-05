@extends('layout.main')

@section('title', 'Order Details - KEL & CO')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('orders.history') }}" style="color: #8B7355;">My Orders</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $order->order_number }}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 text-uppercase fw-light mb-1" style="letter-spacing:0.2em; color:#2C2416;">
                    Order {{ $order->order_number }}
                </h1>
                <div class="text-muted small" style="letter-spacing:0.05em;">Placed on {{ $order->created_at->format('M d, Y') }}</div>
            </div>
            <span class="badge" style="
                background: {{ $order->status === 'delivered' ? '#28a745' : ($order->status === 'cancelled' ? '#dc3545' : '#ffc107') }};
                color: {{ $order->status === 'delivered' || $order->status === 'cancelled' ? 'white' : '#000' }};
                padding: 0.5rem 1rem;
                font-size: 0.95rem;
            ">
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left: Items & Shipping -->
        <div class="col-lg-8">
            <!-- Order Items -->
            <div class="card shadow-sm mb-4" style="border:1px solid #D4C4B0;">
                <div class="card-body p-4">
                    <h6 class="text-uppercase fw-light mb-4" style="letter-spacing:0.12em; color:#2C2416;">
                        <i class="fa-solid fa-shopping-bag me-2"></i>Order Items
                    </h6>

                    @foreach($order->items as $item)
                        <div class="d-flex justify-content-between align-items-start mb-4 pb-4" style="border-bottom:1px solid #E8DCC8;">
                            <div class="flex-grow-1">
                                <a href="{{ route('products.show', $item->product) }}" class="text-decoration-none fw-normal" style="color:#2C2416;">
                                    {{ $item->product->name }}
                                </a>
                                <div class="small text-muted mt-2">
                                    <span class="me-3">SKU: {{ $item->product->id }}</span>
                                    <span>Quantity: {{ $item->quantity }}</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="small text-muted mb-1">Per Unit</div>
                                <div style="color:#8B7355;">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                <div class="mt-2" style="color:#2C2416;">
                                    <strong>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="card shadow-sm" style="border:1px solid #D4C4B0;">
                <div class="card-body p-4">
                    <h6 class="text-uppercase fw-light mb-3" style="letter-spacing:0.12em; color:#2C2416;">
                        <i class="fa-solid fa-location-dot me-2"></i>Shipping Address
                    </h6>

                    <div style="background:#F5F1E8; padding:1.5rem; border-radius:0.5rem; border:1px solid #D4C4B0;">
                        <div style="color:#2C2416; line-height:1.8;">
                            <div class="fw-normal">{{ $order->address->address_line1 }}</div>
                            @if($order->address->address_line2)
                                <div class="text-muted">{{ $order->address->address_line2 }}</div>
                            @endif
                            <div class="text-muted">{{ $order->address->city }}, {{ $order->address->postal_code }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Notes -->
            @if($order->notes)
                <div class="card shadow-sm mt-4" style="border:1px solid #D4C4B0;">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase fw-light mb-3" style="letter-spacing:0.12em; color:#2C2416;">
                            <i class="fa-solid fa-note-sticky me-2"></i>Order Notes
                        </h6>
                        <p class="text-muted mb-0">{{ $order->notes }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Right: Summary & Actions -->
        <div class="col-lg-4">
            <!-- Order Summary -->
            <div class="card shadow-sm mb-4" style="border:1px solid #D4C4B0;">
                <div class="card-body p-4">
                    <h6 class="text-uppercase fw-light mb-4" style="letter-spacing:0.12em; color:#2C2416;">
                        Order Summary
                    </h6>

                    <div class="mb-3 pb-3" style="border-bottom:1px solid #E8DCC8;">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Order Number</span>
                            <span style="color:#2C2416;">{{ $order->order_number }}</span>
                        </div>
                    </div>

                    <div class="mb-3 pb-3" style="border-bottom:1px solid #E8DCC8;">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Order Date</span>
                            <span style="color:#2C2416;">{{ $order->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <div class="mb-3 pb-3" style="border-bottom:1px solid #E8DCC8;">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Items</span>
                            <span style="color:#2C2416;">{{ $order->items->count() }} product(s)</span>
                        </div>
                    </div>

                    <div style="border-top:2px solid #D4C4B0; padding-top:1rem;">
                        <div class="d-flex justify-content-between" style="font-size:1.2rem;">
                            <span class="fw-normal" style="color:#2C2416;">Total Amount</span>
                            <span class="fw-normal" style="color:#2C2416;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Status -->
            @if($order->payment)
                <div class="card shadow-sm mb-4" style="border:1px solid #D4C4B0;">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase fw-light mb-3" style="letter-spacing:0.12em; color:#2C2416;">
                            <i class="fa-solid fa-credit-card me-2"></i>Payment Status
                        </h6>
                        <div>
                            <span class="badge" style="background:{{ $order->payment->status === 'success' ? '#28a745' : '#ffc107' }}; color:white;">
                                {{ ucfirst($order->payment->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Status Timeline (Optional) -->
            <div class="card shadow-sm" style="border:1px solid #D4C4B0;">
                <div class="card-body p-4">
                    <h6 class="text-uppercase fw-light mb-3" style="letter-spacing:0.12em; color:#2C2416;">
                        <i class="fa-solid fa-timeline me-2"></i>Status Timeline
                    </h6>

                    <div class="small">
                        <div class="mb-3">
                            <div style="color:#8B7355;">
                                <i class="fa-solid fa-circle-check me-2" style="color:#28a745;"></i>Order Placed
                            </div>
                            <div class="text-muted ms-4">{{ $order->created_at->format('M d, Y H:i') }}</div>
                        </div>

                        @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                            <div class="mb-3">
                                <div style="color:#8B7355;">
                                    <i class="fa-solid fa-circle-check me-2" style="color:#28a745;"></i>Processing
                                </div>
                                <div class="text-muted ms-4">In progress...</div>
                            </div>
                        @endif

                        @if(in_array($order->status, ['shipped', 'delivered']))
                            <div class="mb-3">
                                <div style="color:#8B7355;">
                                    <i class="fa-solid fa-circle-check me-2" style="color:#28a745;"></i>Shipped
                                </div>
                                <div class="text-muted ms-4">On the way...</div>
                            </div>
                        @endif

                        @if($order->status === 'delivered')
                            <div>
                                <div style="color:#8B7355;">
                                    <i class="fa-solid fa-circle-check me-2" style="color:#28a745;"></i>Delivered
                                </div>
                                <div class="text-muted ms-4">Delivered successfully</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-4 d-flex gap-2">
                <a href="{{ route('orders.history') }}" class="btn btn-outline-secondary flex-grow-1" 
                    style="border-color:#D4C4B0; color:#5C4D3C;">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-dark flex-grow-1" 
                    style="background:#2C2416; border-color:#2C2416;">
                    <i class="fa-solid fa-shopping-bag me-2"></i>Shop
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
