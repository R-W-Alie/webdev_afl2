@extends('layout.main')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-md-6">
            @php
                $primary = $product->primaryImage->image_url ?? $product->image ?? null;
                $primaryUrl = $primary ? (Str::startsWith($primary, ['http://','https://']) ? $primary : asset('storage/'.$primary)) : null;
            @endphp
            @if($primaryUrl)
                <img src="{{ $primaryUrl }}" class="img-fluid rounded" alt="{{ $product->name }}">
            @endif
        </div>
        <div class="col-md-6">
            <h1 class="mb-3">{{ $product->name }}</h1>
            <p class="text-muted">{{ $product->category->name ?? '' }}</p>
            <p class="lead">${{ number_format($product->price, 2) }}</p>
            <p>{{ $product->description }}</p>
            <p class="mb-1">Average rating: {{ number_format($product->averageRating(), 1) }}/5</p>
            <p class="mb-4">Stock: {{ $product->stock_quantity }}</p>
            @auth
            <form method="POST" action="{{ route('cart.add', $product) }}" class="d-inline">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <button class="btn btn-dark" type="submit">Add to Cart</button>
            </form>
            <form method="POST" action="{{ route('wishlist.add', $product) }}" class="d-inline">
                @csrf
                <button class="btn btn-outline-dark" type="submit">Add to Wishlist</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn btn-dark">Login to purchase</a>
            @endauth
        </div>
    </div>

    @if($product->images->count())
    <div class="row mt-5 g-3">
        @foreach($product->images as $image)
            @php
                $url = Str::startsWith($image->image_url, ['http://','https://']) ? $image->image_url : asset('storage/'.$image->image_url);
            @endphp
            <div class="col-4 col-md-3">
                <img src="{{ $url }}" class="img-fluid rounded" alt="{{ $product->name }}">
            </div>
        @endforeach
    </div>
    @endif

    @if($product->sizes->count())
    <div class="mt-4">
        <h5>Sizes</h5>
        <div class="d-flex gap-2 flex-wrap">
            @foreach($product->sizes as $size)
                <span class="badge bg-light text-dark border">{{ $size->size }} ({{ $size->stock }})</span>
            @endforeach
        </div>
    </div>
    @endif

    @if($product->reviews->count())
    <div class="mt-5">
        <h5>Reviews</h5>
        <div class="list-group">
            @foreach($product->reviews as $review)
                <div class="list-group-item">
                    <strong>{{ $review->user->name ?? 'Anonymous' }}</strong>
                    <span class="ms-2 text-warning">{{ str_repeat('★', $review->rating) }}</span>
                    <p class="mb-0 mt-2">{{ $review->comment }}</p>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
