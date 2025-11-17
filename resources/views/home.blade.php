@extends('layout.main')

@section('title', 'kelnco')

@section('styles')
    <style>
        /* gbs klo pake bootstrap aja */
        .hero-section {
            position: relative;
            height: 90vh;
            overflow: hidden;
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.95);
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.3));
        }

        .hero-content {
            position: absolute;
            bottom: 10%;
            left: 8%;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .hero-title {
            letter-spacing: 0.05em;
        }

        .hero-subtitle {
            letter-spacing: 0.1em;
        }

        .section-title {
            letter-spacing: 0.15em;
        }

        /* Carousel indicators - custom styling */
        .carousel-indicators button {
            width: 40px;
            height: 2px;
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
        }

        .carousel-indicators button.active {
            background-color: white;
        }

        /* Custom divider color */
        .divider {
            background-color: #8B7355;
        }

        /* Custom brand colors */
        .brand-name {
            color: #8B7355;
        }

        .cta-button {
            background-color: #2C2416;
            color: white;
            border: 1px solid #2C2416;
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            background-color: transparent;
            color: #2C2416;
        }

        @media (max-width: 768px) {
            .hero-content {
                left: 5%;
                bottom: 5%;
            }
        }
    </style>
@endsection

@section('content')
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="hero-section">
                    <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1600&h=900&fit=crop"
                        class="hero-image" alt="Timeless Elegance">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h1 class="hero-title display-3 fw-light mb-2">Timeless Elegance</h1>
                        <p class="hero-subtitle text-uppercase fw-light fs-6">Discover our new collection</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="hero-section">
                    <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1600&h=900&fit=crop"
                        class="hero-image" alt="Refined Luxury">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h1 class="hero-title display-3 fw-light mb-2">Refined Luxury</h1>
                        <p class="hero-subtitle text-uppercase fw-light fs-6">Crafted with precision and care</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="hero-section">
                    <img src="https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=1600&h=900&fit=crop"
                        class="hero-image" alt="Modern Sophistication">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h1 class="hero-title display-3 fw-light mb-2">Modern Sophistication</h1>
                        <p class="hero-subtitle text-uppercase fw-light fs-6">Where style meets comfort</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- ABOUT -->
    <div class="py-5" style="padding-top: 100px !important; padding-bottom: 100px !important;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title display-5 fw-light text-uppercase text-dark mb-4">About Us</h2>
                <hr class="divider mx-auto mb-5 opacity-75" style="width: 80px; height: 1px;">
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="text-center mb-4 fs-5 lh-lg text-dark fw-light">
                        At <span class="brand-name fw-normal">Kel & Co</span>, we believe elegance is not just a look — it's an
                        experience.
                        Our passion lies in curating collections that blend classic sophistication with modern design,
                        allowing you to express your individuality with confidence and grace.
                    </p>

                    <p class="text-center fs-5 lh-lg text-dark fw-light">
                        Each piece is crafted with meticulous attention to detail, merging artistry and precision.
                        From design to craftsmanship, we strive to ensure that every creation reflects quality,
                        comfort, and timeless beauty.
                    </p>
                </div>

                <div class="col-12">
                    <div class="text-center mt-5">
                        <a href="/product" class="cta-button btn text-uppercase fw-light px-5 py-3 text-decoration-none" 
                           style="font-size: 0.9rem;">
                            Explore Collection
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection