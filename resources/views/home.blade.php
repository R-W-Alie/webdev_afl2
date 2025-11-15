@extends('layout.main')

@section('title', 'kelnco')

@section('styles')
    <style>
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
            font-size: 3.5rem;
            font-weight: 300;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            font-weight: 300;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .carousel-indicators button {
            width: 40px;
            height: 2px;
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
        }

        .carousel-indicators button.active {
            background-color: white;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: brightness(0) invert(1);
        }

        .about-section {
            /* background-color: #E8DCC8; */
            padding: 100px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 300;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #2C2416;
            margin-bottom: 2rem;
        }

        .divider {
            width: 80px;
            height: 1px;
            background-color: #8B7355;
            margin: 0 auto 3rem;
        }

        .about-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #2C2416;
            font-weight: 300;
        }

        .brand-name {
            color: #8B7355;
            font-weight: 400;
        }

        /* .cta-section {
            background-color: #F5F1E8;
            padding: 80px 0;
        } */

        .cta-button {
            background-color: #2C2416;
            color: white;
            border: 1px solid #2C2416;
            padding: 14px 50px;
            font-size: 0.9rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            transition: all 0.3s ease;
            font-weight: 300;
            text-decoration: none;
            display: inline-block;
        }

        .cta-button:hover {
            background-color: transparent;
            color: #2C2416;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-content {
                left: 5%;
                bottom: 5%;
            }

            .section-title {
                font-size: 1.8rem;
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
                        <h1 class="hero-title">Timeless Elegance</h1>
                        <p class="hero-subtitle">Discover our new collection</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="hero-section">
                    <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1600&h=900&fit=crop"
                        class="hero-image" alt="Refined Luxury">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h1 class="hero-title">Refined Luxury</h1>
                        <p class="hero-subtitle">Crafted with precision and care</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="hero-section">
                    <img src="https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=1600&h=900&fit=crop"
                        class="hero-image" alt="Modern Sophistication">
                    <div class="hero-overlay"></div>
                    <div class="hero-content">
                        <h1 class="hero-title">Modern Sophistication</h1>
                        <p class="hero-subtitle">Where style meets comfort</p>
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

    <div class="about-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">About Us</h2>
                <div class="divider"></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="about-text text-center mb-4">
                        At <span class="brand-name">Kel & Co</span>, we believe elegance is not just a look — it's an
                        experience.
                        Our passion lies in curating collections that blend classic sophistication with modern design,
                        allowing you to express your individuality with confidence and grace.
                    </p>

                    <p class="about-text text-center">
                        Each piece is crafted with meticulous attention to detail, merging artistry and precision.
                        From design to craftsmanship, we strive to ensure that every creation reflects quality,
                        comfort, and timeless beauty.
                    </p>
                </div>

                <div>
                    <div class="container text-center mt-5">
                        <a href="/product" class="cta-button">Explore Collection</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
