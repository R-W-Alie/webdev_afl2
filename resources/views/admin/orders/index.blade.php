@extends('layout.admin')

@section('title', 'Orders')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h4 text-uppercase fw-light mb-1" style="letter-spacing:0.15em; color:#2C2416;">Orders</h1>
            <p class="text-muted mb-0">Recent orders placed by customers</p>
        </div>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.orders.index') }}" class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label text-muted small">Search</label>
                    <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Order number or customer name">
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted small">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All</option>
                        @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                            <option value="{{ $s }}" @selected(($status ?? '') === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-dark mt-4" style="background:#2C2416; border-color:#2C2416;">Filter</button>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary mt-4">Clear</a>
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
                                <td class="py-3 px-4">{{ $order->order_number }}</td>
                                <td class="py-3 px-4">{{ $order->user->name ?? 'N/A' }}</td>
                                <td class="py-3 px-4">{{ $order->address->city ?? '' }}</td>
                                <td class="py-3 px-4">${{ number_format($order->total_amount, 2) }}</td>
                                <td class="py-3 px-4 text-capitalize">{{ $order->status }}</td>
                                <td class="py-3 px-4">{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
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
