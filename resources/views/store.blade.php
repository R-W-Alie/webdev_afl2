<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Stores</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (for location icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Navigation CSS -->
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
  </head>

  <body>
    @include('layout.nav')

    <div class="container my-5 py-4">
      <div class="text-center mb-5">
        <h1 class="fw-light" style="letter-spacing: 0.03em;">Our Stores</h1>
        <div class="mx-auto" style="width: 60px; height: 2px; background-color: #000;"></div>
      </div>

      <div class="row g-4">
        @foreach ($stores as $store)
          <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden;">
              <img src="{{ $store->image }}" class="card-img-top" alt="{{ $store->name }}" style="height: 230px; object-fit: cover;">
              
              <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-semibold mb-2">{{ $store->name }}</h5>
                <p class="card-text text-muted mb-3" style="font-size: 0.9rem;">
                  {{ $store->description }}
                </p>
                <div class="mt-auto">
                  <p class="text-secondary mb-0" style="font-size: 0.85rem;">
                    <i class="fa-solid fa-location-dot me-1"></i> {{ $store->location }}
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
