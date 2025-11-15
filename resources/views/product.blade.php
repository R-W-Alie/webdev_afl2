@extends('layout.main')

@section('title', 'Our Products - Kel & Co')

@section('styles')
<style>
    .product-title {
        font-size: 2.5rem;
        font-weight: 300;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: #2C2416;
    }

    .product-divider {
        width: 80px;
        height: 1px;
        background-color: #8B7355;
        margin: 0 auto;
    }

    .product-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease;
        background-color: white;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-card img {
        height: 280px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover img {
        transform: scale(1.05);
    }

    .product-name {
        font-weight: 400;
        letter-spacing: 0.05em;
        color: #2C2416;
    }

    .product-description {
        font-size: 0.9rem;
        color: #5C4D3C;
        line-height: 1.6;
    }

    .product-price {
        font-weight: 400;
        color: #8B7355;
        letter-spacing: 0.05em;
    }
</style>
@endsection

@section('content')
<div class="container my-5 py-5">
    <div class="text-center mb-5">
        <h1 class="product-title mb-4">Our Products</h1>
        <div class="product-divider"></div>
    </div>

    <div class="row g-4">
        @foreach ($products as $product)
        <div class="col-md-6 col-lg-4">
            <div class="card product-card border-0 shadow-sm h-100">
                <div style="overflow: hidden;">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="product-name mb-2">{{ $product->name }}</h5>
                    <p class="product-description mb-3">
                        {{ $product->description }}
                    </p>
                    <div class="mt-auto">
                        <p class="product-price mb-0">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($products->hasPages())
    <div class="mt-5">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection