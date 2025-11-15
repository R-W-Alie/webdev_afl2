@extends('layout.main')

@section('title', 'Our Stores - Kel & Co')

@section('styles')
<style>
    .store-title {
        font-size: 2.5rem;
        font-weight: 300;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: #2C2416;
    }

    .store-divider {
        width: 80px;
        height: 1px;
        background-color: #8B7355;
        margin: 0 auto;
    }

    .store-card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: white;
    }

    .store-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12) !important;
    }

    .store-card img {
        height: 280px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .store-card:hover img {
        transform: scale(1.05);
    }

    .store-name {
        font-weight: 400;
        letter-spacing: 0.05em;
        color: #2C2416;
    }

    .store-description {
        font-size: 0.9rem;
        color: #5C4D3C;
        line-height: 1.6;
    }

    .store-location {
        font-size: 0.85rem;
        color: #8B7355;
        letter-spacing: 0.03em;
    }

    .store-location i {
        color: #8B7355;
    }
</style>
@endsection

@section('content')
<div class="container my-5 py-5">
    <div class="text-center mb-5">
        <h1 class="store-title mb-4">Our Stores</h1>
        <div class="store-divider"></div>
    </div>

    <div class="row g-4">
        @foreach ($stores as $store)
        <div class="col-md-6 col-lg-4">
            <div class="card store-card border-0 shadow-sm h-100">
                <div style="overflow: hidden;">
                    <img src="{{ $store->image }}" class="card-img-top" alt="{{ $store->name }}">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="store-name mb-2">{{ $store->name }}</h5>
                    <p class="store-description mb-3">
                        {{ $store->description }}
                    </p>
                    <div class="mt-auto">
                        <p class="store-location mb-0">
                            <i class="fa-solid fa-location-dot me-2"></i>{{ $store->location }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection