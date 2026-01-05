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

        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 col-xl-7">
                <form action="{{ url()->current() }}" method="GET">
                    <div class="input-group shadow-sm rounded mb-3">
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

                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <select name="category" class="form-select" style="border-color: #d4c4b0;">
                                <option value="">All Categories</option>
                                @foreach($categories ?? [] as $cat)
                                    <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="sort" class="form-select" style="border-color: #d4c4b0;">
                                <option value="newest" @selected(request('sort','newest')==='newest')>Newest</option>
                                <option value="price_asc" @selected(request('sort')==='price_asc')>Price: Low to High</option>
                                <option value="price_desc" @selected(request('sort')==='price_desc')>Price: High to Low</option>
                                <option value="name" @selected(request('sort')==='name')>Name A-Z</option>
                            </select>
                        </div>
                        <div class="col-12 d-flex gap-2 justify-content-center">
                            <button class="btn btn-dark px-4" style="background-color:#2C2416; border-color:#2C2416;">Apply</button>
                            <a href="{{ url()->current() }}" class="btn btn-outline-secondary px-4" style="border-color:#d4c4b0; color:#5C4D3C;">Reset</a>
                        </div>
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

        @if(!empty($featuredProducts) && $featuredProducts->count())
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-light text-uppercase mb-0" style="letter-spacing:0.12em; color:#2C2416;">Featured Picks</h5>
                    <span class="small text-muted">Curated highlights</span>
                </div>
                <div class="row g-3">
                    @foreach($featuredProducts as $featured)
                        @php
                            $thumb = $featured->primaryImage->image_url ?? $featured->image ?? null;
                            $thumbUrl = $thumb ? (Str::startsWith($thumb, ['http://', 'https://']) ? $thumb : asset('storage/'.$thumb)) : null;
                        @endphp
                        <div class="col-12 col-md-6 col-lg-4">
                            <a href="{{ route('products.show', $featured->slug) }}" class="text-decoration-none text-dark">
                                <div class="card border-0 shadow-sm h-100">
                                    @if($thumbUrl)
                                        <img src="{{ $thumbUrl }}" class="card-img-top" alt="{{ $featured->name }}" style="height:200px; object-fit:cover;">
                                    @else
                                        <div class="bg-light" style="height:200px;"></div>
                                    @endif
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="badge bg-dark">Featured</span>
                                            @if($featured->stock_quantity <= 3)
                                                <span class="badge bg-warning text-dark">Low stock</span>
                                            @endif
                                        </div>
                                        <div class="small text-muted mb-1">{{ $featured->category->name ?? 'Uncategorized' }}</div>
                                        <h6 class="mb-1">{{ $featured->name }}</h6>
                                        <p class="fw-normal mb-0" style="color:#8b7355;">Rp {{ number_format($featured->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
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
                            <div class="d-flex align-items-center gap-2 mb-2">
                                @if($product->is_featured)
                                    <span class="badge bg-dark">Featured</span>
                                @endif
                                @if($product->stock_quantity <= 3)
                                    <span class="badge bg-warning text-dark">Low stock</span>
                                @endif
                            </div>
                            <h5 class="fw-normal mb-2 text-dark" style="letter-spacing: 0.05em;">
                                <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">{{ $product->name }}</a>
                            </h5>
                            <div class="small text-muted mb-2">{{ $product->category->name ?? 'Uncategorized' }}</div>
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