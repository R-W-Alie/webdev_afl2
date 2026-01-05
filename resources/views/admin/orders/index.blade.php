@extends('layout.main')

@section('title', 'Orders - KEL & CO')

@section('content')
<div class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 text-uppercase fw-light mb-1" style="letter-spacing:0.2em; color:#2C2416;">Orders</h1>
            <div class="text-muted small" style="letter-spacing:0.05em;">Recent orders placed by customers</div>
        </div>
    </div>

    <div class="card shadow-sm mb-3" style="border:1px solid #D4C4B0;">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label text-muted small">Search</label>
                    <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Order number or customer name" style="border-color:#D4C4B0;">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted small">Status</label>
                    <select name="status" class="form-select" style="border-color:#D4C4B0;">
                        <option value="">All</option>
                        @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                            <option value="{{ $s }}" @selected(($status ?? '') === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-dark mt-4" style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">Filter</button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary mt-4" style="border-color:#D4C4B0; color:#5C4D3C;">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color:#f8f7f6;">
                        <tr>
                            <th class="py-3 px-4">#</th>
                            <th class="py-3 px-4">Order Number</th>
                            <th class="py-3 px-4">Customer</th>
                            <th class="py-3 px-4">Address</th>
                            <th class="py-3 px-4">Total</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="py-3 px-4">{{ $order->id }}</td>
                                <td class="py-3 px-4">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}" style="color:#8B7355; text-decoration:none;">
                                        {{ $order->order_number }}
                                    </a>
                                </td>
                                <td class="py-3 px-4">{{ $order->user->name ?? 'N/A' }}</td>
                                <td class="py-3 px-4">{{ $order->address->city ?? '' }}</td>
                                <td class="py-3 px-4">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="py-3 px-4">
                                    <span class="badge 
                                        @if($order->status === 'pending') bg-warning text-dark
                                        @elseif($order->status === 'processing') bg-info text-white
                                        @elseif($order->status === 'shipped') bg-primary text-white
                                        @elseif($order->status === 'delivered') bg-success text-white
                                        @elseif($order->status === 'cancelled') bg-danger text-white
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>

                            <!-- Status Update Modal -->
                            <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="border:1px solid #D4C4B0;">
                                        <div class="modal-header" style="border-bottom:1px solid #D4C4B0;">
                                            <h5 class="modal-title" style="color:#2C2416; letter-spacing:0.05em;">{{ $order->order_number }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-4">
                                                <h6 class="mb-3" style="color:#2C2416;">Update Order Status</h6>
                                                <div class="row g-2 mb-3">
                                                    @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input status-radio" type="radio" name="status_{{ $order->id }}" value="{{ $s }}" id="status_{{ $order->id }}_{{ $s }}" @checked($order->status === $s)>
                                                                <label class="form-check-label" for="status_{{ $order->id }}_{{ $s }}">
                                                                    {{ ucfirst($s) }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" id="statusForm{{ $order->id }}">
                                                    @csrf
                                                    <input type="hidden" name="status" id="statusInput{{ $order->id }}" value="{{ $order->status }}">
                                                </form>
                                            </div>

                                            <div class="mb-3">
                                                <h6 class="mb-2" style="color:#2C2416;">Order Details</h6>
                                                <div class="small text-muted">
                                                    <p class="mb-2"><strong>Customer:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                                                    <p class="mb-2"><strong>Total:</strong> Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                                    <p class="mb-0"><strong>Created:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="border-top:1px solid #D4C4B0;">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-dark" style="background:#2C2416; border-color:#2C2416;" onclick="document.getElementById('statusForm{{ $order->id }}').submit();">
                                                Update Status
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No orders found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($orders->hasPages())
        <div class="mt-3">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
