@extends('layout.main')

@php use Illuminate\Support\Str; @endphp

@section('title', $product->name . ' - KEL & CO')

@section('content')
<div class="container py-5">
    <!-- prdct details -->
    <div class="row g-5 mb-5">
        <!-- img -->
        <div class="col-lg-6">
            @php
                $primary = $product->primaryImage->image_url ?? $product->image ?? null;
                $primaryUrl = $primary ? (Str::startsWith($primary, ['http://','https://']) ? $primary : asset('storage/'.$primary)) : null;
            @endphp
            @if($primaryUrl)
                <img src="{{ $primaryUrl }}" class="img-fluid rounded" alt="{{ $product->name }}" style="object-fit: cover; height: 500px; width: 100%;">
            @endif

            <!-- + img -->
            @if($product->images->count() > 1)
                <div class="row g-2 mt-3">
                    @foreach($product->images as $image)
                        @php
                            $url = Str::startsWith($image->image_url, ['http://','https://']) ? $image->image_url : asset('storage/'.$image->image_url);
                        @endphp
                        <div class="col-4">
                            <img src="{{ $url }}" class="img-fluid rounded" alt="{{ $product->name }}" style="height: 120px; width: 100%; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- details -->
        <div class="col-lg-6">
            <h1 class="h3 text-uppercase fw-light mb-2" style="letter-spacing:0.2em; color:#2C2416;">{{ $product->name }}</h1>
            
            <div class="mb-3">
                <span class="badge" style="background:#F5F1E8; color:#8B7355;">{{ $product->category->name ?? 'Uncategorized' }}</span>
            </div>

            <!-- Price & Stock -->
            <div class="mb-4 pb-4" style="border-bottom:1px solid #D4C4B0;">
                <div class="h4 mb-2" style="color:#2C2416;">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                <div class="small text-muted">
                    <i class="fa-solid fa-box me-1" style="color:#8B7355;"></i>
                    {{ $product->stock_quantity }} unit(s) available
                </div>
            </div>

            <!-- Rating -->
            <div class="mb-4 pb-4" style="border-bottom:1px solid #D4C4B0;">
                <div class="d-flex align-items-center gap-2">
                    <span class="text-warning">
                        @for($i = 0; $i < floor($product->averageRating()); $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                        @if(fmod($product->averageRating(), 1) >= 0.5)
                            <i class="fa-solid fa-star-half-stroke"></i>
                        @endif
                    </span>
                    <span class="small text-muted">{{ number_format($product->averageRating(), 1) }}/5 ({{ $product->reviews->count() }} reviews)</span>
                </div>
            </div>

            <!-- desc -->
            <div class="mb-4 pb-4" style="border-bottom:1px solid #D4C4B0;">
                <p class="text-muted" style="line-height: 1.8;">{{ $product->description }}</p>
            </div>

            <!-- sizes -->
            @if($product->sizes->count())
                <div class="mb-4 pb-4" style="border-bottom:1px solid #D4C4B0;">
                    <h6 class="text-uppercase fw-light mb-3" style="letter-spacing:0.12em; color:#2C2416;">Available Sizes</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($product->sizes as $size)
                            <span class="badge" style="background:#F5F1E8; color:#5C4D3C; padding:0.5rem 1rem;">
                                {{ $size->size }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- actions -->
            @auth
                <div class="d-flex gap-2 mb-4">
                    <form method="POST" action="{{ route('cart.add', $product) }}" class="flex-grow-1">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button class="btn btn-dark w-100" style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">
                            <i class="fa-solid fa-shopping-cart me-2"></i>Add to Cart
                        </button>
                    </form>
                    <form method="POST" action="{{ route('wishlist.add', $product) }}">
                        @csrf
                        <button class="btn btn-outline-secondary" style="border-color:#D4C4B0; color:#5C4D3C;">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                    </form>
                </div>
            @else
                <div class="mb-4">
                    <a href="{{ route('login') }}" class="btn btn-dark w-100" style="background:#2C2416; border-color:#2C2416; letter-spacing:0.05em;">
                        <i class="fa-solid fa-lock me-2"></i>Login to Purchase
                    </a>
                </div>
            @endauth

            <!-- info -->
            <div class="p-3 rounded" style="background:#F5F1E8; border:1px solid #D4C4B0;">
                <div class="small text-muted">
                    <i class="fa-solid fa-truck me-2" style="color:#8B7355;"></i>
                    Free shipping on orders over Rp 500.000
                </div>
            </div>
        </div>
    </div>

    <!-- reviews -->
    <div class="row">
        <div class="col-lg-8">
            <h4 class="text-uppercase fw-light mb-4" style="letter-spacing:0.15em; color:#2C2416;">
                Customer Reviews ({{ $product->reviews->where('is_approved', true)->count() }})
            </h4>

            @auth
                <div class="card shadow-sm mb-4" style="border:1px solid #D4C4B0;">
                    <div class="card-body p-4">
                        <h6 class="text-uppercase fw-light mb-3" style="letter-spacing:0.12em; color:#2C2416;">
                            Leave a Review
                        </h6>
                        <p class="small text-muted mb-3">Share your feedback if you've purchased this product</p>
                        <a href="{{ route('review-form', $product) }}" class="btn btn-dark btn-sm" style="background:#2C2416; border-color:#2C2416;">
                            <i class="fa-solid fa-pen me-2"></i>Write Review
                        </a>
                    </div>
                </div>
            @else
                <div class="alert alert-info mb-4">
                    <i class="fa-solid fa-info-circle me-2"></i>
                    <a href="{{ route('login') }}" class="alert-link">Login</a> to write a review
                </div>
            @endauth

            <!-- review list -->
            @forelse($product->reviews->where('is_approved', true) as $review)
                <div class="card shadow-sm mb-3" style="border:1px solid #D4C4B0;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="fw-normal mb-1" style="color:#2C2416;">{{ $review->user->name ?? 'Anonymous' }}</h6>
                                <div class="small text-muted">{{ $review->created_at->format('M d, Y') }}</div>
                            </div>
                            <div class="text-warning">
                                @for($i = 0; $i < $review->rating; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="text-muted mb-0">{{ $review->comment }}</p>
                    </div>
                </div>
            @empty
                <div class="alert alert-light text-center py-4" style="border:1px solid #D4C4B0;">
                    <p class="text-muted mb-0">No approved reviews yet. Be the first to review!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
