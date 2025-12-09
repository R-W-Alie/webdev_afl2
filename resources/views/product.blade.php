@extends('layout.main')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Our Products - Kel & Co')

@section('content')
    <div class="container my-5 py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-light text-uppercase mb-4 text-dark" style="letter-spacing: 0.15em;">
                Our Products
            </h1>
            <hr class="mx-auto opacity-75" style="width: 80px; height: 1px; background-color: #8B7355;">
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-lg-6">
                <form action="{{ url()->current() }}" method="GET">
                    <div class="input-group shadow-sm rounded">
                        <input type="text" class="form-control py-3 border-end-0 bg-white" name="search"
                            placeholder="Search our products" value="{{ request('search') }}"
                            style="border-color: #d4c4b0;">
                        <button class="btn text-white px-4" type="submit"
                            style="background-color: #2C2416; border-color: #2C2416;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if (request('search'))
            <div class="row justify-content-center mb-4">
                <div class="col-12">
                    <div class="bg-white border rounded p-3 shadow-sm" style="border-color: #D4C4B0 !important;">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <span class="small">
                                Showing results for <strong>"{{ request('search') }}"</strong>
                                <span class="ms-2" style="color: #8B7355;">
                                    ({{ $products->total() }} {{ Str::plural('product', $products->total()) }} found)
                                </span>
                            </span>
                            <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-secondary"
                                style="border-color: #D4C4B0; color: #5C4D3C;">
                                Clear
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="overflow-hidden">
                            @php
                                $thumb = $product->primaryImage->image_url ?? $product->image ?? null;
                                $thumbUrl = $thumb ? (Str::startsWith($thumb, ['http://', 'https://']) ? $thumb : asset('storage/'.$thumb)) : null;
                            @endphp
                            @if($thumbUrl)
                            <img src="{{ $thumbUrl }}" class="card-img-top" alt="{{ $product->name }}"
                                style="height: 280px; object-fit: cover;">
                            @else
                            <div class="bg-light" style="height: 280px;"></div>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-normal mb-2 text-dark" style="letter-spacing: 0.05em;">
                                <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">{{ $product->name }}</a>
                            </h5>
                            <p class="small mb-3 lh-base" style="color: #5C4D3C;">
                                {{ $product->description }}
                            </p>
                            <div class="mt-auto">
                                <p class="fw-normal mb-0" style="color: #8b7355; letter-spacing: 0.05em;">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fa-solid fa-bag-shopping display-1 mb-3" style="color: #C9B8A3;"></i>
                        <h5 class="fw-light mb-2" style="color: #5C4D3C; letter-spacing: 0.05em;">
                            No products found
                        </h5>
                        <p class="small mb-0" style="color: #8B7355;">
                            Try adjusting your search terms
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="mt-5">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection