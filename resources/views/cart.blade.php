@extends('layout.main')

@section('title', 'Your Cart')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="container py-5">
    <h1 class="h4 text-uppercase fw-light mb-4" style="letter-spacing:0.15em; color:#2C2416;">Cart</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($items->isEmpty())
        <div class="text-muted">Your cart is empty.</div>
    @else
    <div class="row g-3">
        @foreach($items as $item)
            @php
                $product = $item->product;
                $thumb = $product->primaryImage->image_url ?? $product->image ?? null;
                $thumbUrl = $thumb ? (Str::startsWith($thumb, ['http://','https://']) ? $thumb : asset('storage/'.$thumb)) : null;
            @endphp
            <div class="col-12">
                <div class="d-flex gap-3 align-items-center border rounded p-3" style="border-color:#D4C4B0; background:#fff;">
                    <div style="width:96px; height:96px;" class="bg-light d-flex align-items-center justify-content-center overflow-hidden rounded">
                        @if($thumbUrl)
                            <img src="{{ $thumbUrl }}" alt="{{ $product->name }}" class="img-fluid" style="object-fit:cover; width:100%; height:100%;">
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-normal" style="color:#2C2416; letter-spacing:0.03em;">{{ $product->name }}</div>
                        <div class="text-muted small">${{ number_format($product->price, 2) }}</div>
                        <div class="text-muted small">Qty: {{ $item->quantity }}</div>
                    </div>
                    <div class="text-end">
                        <div class="fw-normal" style="color:#8B7355;">${{ number_format($item->quantity * $product->price, 2) }}</div>
                        <form method="POST" action="{{ route('cart.remove', $product) }}" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-secondary" type="submit">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4 d-flex justify-content-between align-items-center">
        <div class="fw-normal" style="color:#2C2416;">Total: Rp {{ number_format($total, 0, ',', '.') }}</div>
        <a href="{{ route('checkout.show') }}" class="btn btn-dark" style="background:#2C2416; border-color:#2C2416;">
            <i class="fa-solid fa-credit-card me-2"></i>Checkout
        </a>
    </div>
    @endif
</div>
@endsection
