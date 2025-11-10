<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('layout.nav')
    <div class="container my-5 py-4">
        <div class="text-center mb-5">
            <h1 class="fw-light" style="letter-spacing: 0.03em;">Our Products</h1>
            <div class="mx-auto" style="width: 60px; height: 2px; background-color: #000;"></div>
        </div>

        <!-- SEARCH BAR -->
        <div class="row mb-4">
            <div class="col-lg-6 mx-auto">
                <form action="{{ url()->current() }}" method="GET">
                    <div class="input-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
                        <input type="text" class="form-control border-0 py-3" name="search"
                            placeholder="Search products..." value="{{ request('search') }}"
                            style="font-size: 0.95rem;">
                        <button class="btn btn-dark px-4" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Search Results Info -->
        @if (request('search'))
            <div class="alert alert-light border-0 shadow-sm mb-4" style="border-radius: 12px;">
                <div class="d-flex justify-content-between align-items-center">
                    <span>
                        Showing results for <strong>"{{ request('search') }}"</strong>
                        <span class="text-muted">({{ $products->total() }}
                            {{ Str::plural('product', $products->total()) }} found)</span>
                    </span>
                    <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-secondary"
                        style="border-radius: 8px;">Clear</a>
                </div>
            </div>
        @endif

        <!-- Products Grid -->
        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden;">
                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}"
                            style="height: 230px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-semibold mb-2">{{ $product->name }}</h5>
                            <p class="card-text text-muted mb-3" style="font-size: 0.9rem;">
                                {{ $product->description }}
                            </p>
                            <div class="mt-auto">
                                <p class="fw-semibold text-dark mb-0" style="font-size: 0.95rem;">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor"
                            class="text-muted mb-3" viewBox="0 0 16 16">
                            <path
                                d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z" />
                        </svg>
                        <h5 class="text-muted">No products found</h5>
                        <p class="text-muted mb-0">Try adjusting your search terms</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- PAGES PARt HRS DIRAPIIN -->
        <div class="mt-5">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @include('layout.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
