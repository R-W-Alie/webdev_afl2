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

<body>
    @include('layout.nav')

    {{-- Hero Carousel --}}
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active"
                style="background-image: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1600&h=900&fit=crop'); background-size: cover; background-position: center; height: 85vh;">
                <div class="carousel-caption text-start d-none d-md-block">
                    <h1 class="display-4 fw-light text-black">Timeless Elegance</h1>
                    <p class=" text-black">Discover our new collection</p>
                </div>
            </div>

            <div class="carousel-item"
                style="background-image: url('https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1600&h=900&fit=crop'); background-size: cover; background-position: center; height: 85vh;">
                <div class="carousel-caption text-start d-none d-md-block">
                    <h1 class="display-4 fw-light text-white">Refined Luxury</h1>
                    <p>Crafted with precision and care</p>
                </div>
            </div>

            <div class="carousel-item"
                style="background-image: url('https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=1600&h=900&fit=crop'); background-size: cover; background-position: center; height: 85vh;">
                <div class="carousel-caption text-start d-none d-md-block">
                    <h1 class="display-4 fw-light text-white">Modern Sophistication</h1>
                    <p>Where style meets comfort</p>
                </div>
            </div>
        </div>

        {{-- Indicators --}}
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
                aria-current="true"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>

        {{-- Controls --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="container my-5 py-5">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-light text-uppercase letter-spacing-2">About Us</h2>
            <div class="mx-auto" style="width: 60px; height: 2px; background-color: #000;"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="lead text-muted text-center">
                    At <strong>Kel & Co</strong>, we believe elegance is not just a look — it's an experience.
                    Our passion lies in curating collections that blend classic sophistication with modern design,
                    allowing you to express your individuality with confidence and grace.
                </p>

                <p class="text-muted text-center">
                    Each piece is crafted with meticulous attention to detail, merging artistry and precision.
                    From design to craftsmanship, we strive to ensure that every creation reflects quality,
                    comfort, and timeless beauty.
                </p>
            </div>
        </div>
    </div>
    @include('layout.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
