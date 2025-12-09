@extends('layout.main')

@section('title', 'Admin Dashboard - KEL & CO')

@section('content')
<div class="container py-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 text-uppercase fw-light mb-1" style="letter-spacing:0.2em; color:#2C2416;">Admin Dashboard</h1>
            <div class="text-muted small" style="letter-spacing:0.05em;">Welcome back, {{ auth()->user()->name ?? 'Admin' }}</div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.products.create') }}" class="btn btn-dark" style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">New Product</a>
            <a href="{{ route('admin.stores.create') }}" class="btn btn-outline-dark" style="border-color:#2C2416; color:#2C2416; letter-spacing:0.05em;">New Store</a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        @php
            $cards = [
                ['label' => 'Products', 'value' => $stats['products'] ?? 0],
                ['label' => 'Orders', 'value' => $stats['orders'] ?? 0],
                ['label' => 'Customers', 'value' => $stats['customers'] ?? 0],
                ['label' => 'Stores', 'value' => $stats['stores'] ?? 0],
            ];
        @endphp
        @foreach($cards as $card)
        <div class="col-6 col-md-3">
            <div class="p-3 rounded" style="background:#F5F1E8; border:1px solid #D4C4B0; transition:all 0.3s;">
                <div class="text-uppercase small text-muted mb-1" style="letter-spacing:0.15em;">{{ $card['label'] }}</div>
                <div class="h3 mb-0" style="color:#2C2416;">{{ $card['value'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="p-4 rounded" style="background:#E8DCC8; border:1px solid #D4C4B0;">
        <h5 class="text-uppercase fw-light mb-3" style="letter-spacing:0.12em; color:#2C2416;">Quick Actions</h5>
        <div class="d-flex flex-wrap gap-2">
            <a class="btn btn-sm btn-dark" style="background:#2C2416; border-color:#2C2416;" href="{{ route('admin.products.index') }}">Manage Products</a>
            <a class="btn btn-sm btn-outline-dark" style="border-color:#2C2416; color:#2C2416;" href="{{ route('admin.stores.index') }}">Manage Stores</a>
            <a class="btn btn-sm btn-outline-dark" style="border-color:#2C2416; color:#2C2416;" href="{{ route('admin.orders.index') }}">View Orders</a>
            <a class="btn btn-sm btn-outline-dark" style="border-color:#2C2416; color:#2C2416;" href="{{ route('admin.customers.index') }}">Customers</a>
        </div>
    </div>
</div>
@endsection
