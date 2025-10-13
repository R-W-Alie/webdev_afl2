<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Products</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Navigation CSS -->
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
</head>

<body>
    @include('layout.nav')

    <div class="container my-5 py-4">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <h1 class="fw-light" style="letter-spacing: 0.03em;">Our Products</h1>
            <div class="mx-auto" style="width: 60px; height: 2px; background-color: #000;"></div>
        </div>

        <!-- Product Grid -->
        <div class="row g-4">
            @foreach ($products as $product)
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
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
