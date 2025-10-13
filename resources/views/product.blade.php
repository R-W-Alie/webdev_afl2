<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> aku lupa namanya apa </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
</head>
<style>
    body {
        background-color: #f9f9f8;
        font-family: "Inter", "Helvetica Neue", Arial, sans-serif;
    }

    h2 {
        letter-spacing: 0.5px;
    }

    .card {
        border: none;
        border-radius: 14px;
        transition: all 0.3s ease;
        background-color: #fff;
    }

    .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .card-img-top {
        height: 340px;
        object-fit: cover;
        border-top-left-radius: 14px;
        border-top-right-radius: 14px;
    }

    .card-title {
        font-size: 1.1rem;
        margin-top: 10px;
    }

    .card-text {
        font-size: 0.95rem;
    }

    .btn-dark {
        background-color: #111;
        border: none;
        border-radius: 50px;
        padding: 10px 24px;
        transition: all 0.3s ease;
    }

    .btn-dark:hover {
        background-color: #444;
    }
</style>

<body>
    @include('layout.nav')
    <section class="container my-5">
        <h2 class="text-center mb-5 fw-light">Our Collection</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <!-- Card 1 -->
            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('images/shirt1.jpg') }}" class="card-img-top" alt="Linen Oversized Shirt">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-semibold">Linen Oversized Shirt</h5>
                        <p class="card-text text-muted mb-2">Rp499.000</p>
                        <a href="#" class="btn btn-dark rounded-pill px-4">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('images/blazer1.jpg') }}" class="card-img-top" alt="Wool Blazer">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-semibold">Wool Blazer Classic Fit</h5>
                        <p class="card-text text-muted mb-2">Rp899.000</p>
                        <a href="#" class="btn btn-dark rounded-pill px-4">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('images/pants1.jpg') }}" class="card-img-top" alt="Cotton Pants">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-semibold">Cotton Relax Pants</h5>
                        <p class="card-text text-muted mb-2">Rp599.000</p>
                        <a href="#" class="btn btn-dark rounded-pill px-4">View Details</a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
