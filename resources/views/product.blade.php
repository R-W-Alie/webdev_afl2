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

        /* SEARCH PART */
        .search-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .search-input {
            border: 1px solid #d4c4b0;
            background-color: white;
            color: #2C2416;
            font-size: 14px;
            font-weight: 300;
        }

        .search-input::placeholder {
            color: #c9b8a3;
        }

        .search-btn {
            background-color: #2C2416;
            border: 1px solid #2C2416;
            color: white;
        }

        .search-btn:hover {
            background-color: #8B7355;
            border-color: #8B7355;
        }

        /* CLEAR SEARCH ITU */

        .search-results-info {
            background-color: white;
            border: 1px solid #D4C4B0;
            border-radius: 8px;
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
            color: #5C4D3C;
        }

        .clear-search-btn {
            border: 1px solid #D4C4B0;
            background-color: white;
            color: #5C4D3C;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            font-weight: 300;
            padding: 0.4rem 1rem;
            border-radius: 6px;
        }

        .clear-search-btn:hover {
            background-color: #2C2416;
            border-color: #2C2416;
            color: white;
        }

        /* PAGINATION */
        .pagination {
            gap: 0.5rem;
        }

        .page-link {
            border: 1px solid #d4c4b0;
            color: #2C2416;
            background-color: white;
            font-size: 0.9rem;
            font-weight: 300;
            border-radius: 6px;
        }

        .page-link:hover {
            background-color: #E8DCC8;
            border-color: #8B7355;
            color: #2C2416;
        }

        .page-item.active .page-link {
            background-color: #2C2416;
            border-color: #2C2416;
            color: white;
        }

        .page-item.disabled .page-link {
            background-color: white;
            border-color: #D4C4B0;
            color: #C9B8A3;
        }

        /* KALO GAADA PRODUCTNYA HOW THE STATE BLM */

        .empty-state-icon {
            font-size: 4rem;
            color: #C9B8A3;
            margin-bottom: 1rem;
        }

        .empty-state-title {
            font-size: 1.5rem;
            font-weight: 300;
            letter-spacing: 0.05em;
            color: #5C4D3C;
        }

        .empty-state-text {
            font-size: 0.95rem;
            color: #8B7355;
        }
    </style>
@endsection

@section('content')
    <div class="container my-5 py-5">
        <div class="text-center mb-5">
            <h1 class="product-title mb-4">Our Products</h1>
            <div class="product-divider"></div>
        </div>

        <div class="search-container mb-5">
            <form action="{{ url()->current() }}" method="GET">
                <div class="input-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                    <input type="text" class="form-control search-input py-3 border-end-0" name="search"
                        placeholder="Search our products" value="{{ request('search') }}">
                    <button class="btn search-btn px-4" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        @if (request('search'))
            <div class="search-results-info mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        <!-- user search apa -->
                        Showing results for <strong>"{{ request('search') }}"</strong>
                        <!-- number of results found -->
                        <span class="ms-2" style="color: #8B7355;">
                            ({{ $products->total() }} {{ Str::plural('product', $products->total()) }} found)
                        </span>
                    </span>
                    <!-- BUTTON BUAT NGECLEAR SEARCH -->
                    <a href="{{ url()->current() }}" class="clear-search-btn">
                        Clear
                    </a>
                </div>
            </div>
        @endif



        <div class="row g-4">
            @forelse ($products as $product)
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
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fa-solid fa-bag-shopping empty-state-icon"></i>
                        <h5 class="empty-state-title">No products found</h5>
                        <p class="empty-state-text mb-0">Try adjusting your search terms</p>
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
