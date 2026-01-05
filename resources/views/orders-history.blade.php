@extends('layout.main')

@section('title', 'My Orders - KEL & CO')

@section('content')
<div class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 text-uppercase fw-light mb-1" style="letter-spacing:0.2em; color:#2C2416;">My Orders</h1>
            <div class="text-muted small" style="letter-spacing:0.05em;">View your order history and status</div>
        </div>
    </div>

    @if($orders->isEmpty())
        <div class="card shadow-sm" style="border:1px solid #D4C4B0;">
            <div class="card-body text-center py-5">
                <i class="fa-solid fa-box-open display-4 mb-3" style="color: #C9B8A3;"></i>
                <p class="text-muted mb-0">You haven't placed any orders yet.</p>
                <p class="text-muted small mb-3">Start shopping to create your first order!</p>
                <a href="{{ route('products.index') }}" class="btn btn-dark" style="background:#2C2416; border-color:#2C2416;">
                    <i class="fa-solid fa-shopping-bag me-2"></i>Shop Now
                </a>
            </div>
        </div>
    @else
        <div class="row g-3">
            @foreach($orders as $order)
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100" style="border:1px solid #D4C4B0;">
                        <div class="card-body p-4">
                            <!-- Header -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h6 class="fw-normal mb-1" style="color:#2C2416;">{{ $order->order_number }}</h6>
                                    <div class="small text-muted">{{ $order->created_at->format('M d, Y') }}</div>
                                </div>
                                <span class="badge" style="
                                    background: {{ $order->status === 'delivered' ? '#28a745' : ($order->status === 'cancelled' ? '#dc3545' : '#ffc107') }};
                                    color: {{ $order->status === 'delivered' || $order->status === 'cancelled' ? 'white' : '#000' }};
                                ">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>

                            <!-- Divider -->
                            <div style="border-bottom:1px solid #E8DCC8; margin: 1rem 0;"></div>

                            <!-- Items Preview -->
                            <div class="mb-3">
                                <div class="small text-muted mb-2">Items ({{ $order->items->count() }})</div>
                                @foreach($order->items->take(2) as $item)
                                    <div class="small mb-1" style="color:#2C2416;">
                                        • {{ $item->product->name }} ({{ $item->quantity }}x)
                                    </div>
                                @endforeach
                                @if($order->items->count() > 2)
                                    <div class="small text-muted">+ {{ $order->items->count() - 2 }} more item(s)</div>
                                @endif
                            </div>

                            <!-- Divider -->
                            <div style="border-bottom:1px solid #E8DCC8; margin: 1rem 0;"></div>

                            <!-- Address & Total -->
                            <div class="mb-3">
                                <div class="small text-muted mb-1">Shipping To</div>
                                <div class="small" style="color:#2C2416;">
                                    {{ $order->address->address_line1 }}
                                    <br>{{ $order->address->city }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="small text-muted mb-1">Total Amount</div>
                                <div class="fw-normal" style="color:#2C2416; font-size:1.1rem;">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('order.details', $order->id) }}" class="btn btn-sm btn-dark flex-grow-1" 
                                    style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">
                                    <i class="fa-solid fa-eye me-1"></i>View Details
                                </a>
                                @if($order->status === 'delivered')
                                    <a href="{{ route('product.review', $order->id) }}" class="btn btn-sm btn-outline-secondary flex-grow-1" 
                                        style="border-color:#D4C4B0; color:#5C4D3C;">
                                        <i class="fa-solid fa-star me-1"></i>Review
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        @endif
    @endif
</div>
@endsection
