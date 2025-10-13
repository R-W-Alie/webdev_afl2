<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> aku lupa namanya apa </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">

    <style>
        .hero-slideshow {
            position: relative;
            width: 100%;
            height: 85vh;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
            background-size: cover;
            background-position: center;
        }

        .slide.active {
            opacity: 1;
        }

        .slide-content {
            position: absolute;
            bottom: 10%;
            left: 5%;
            color: #ffffff;
            z-index: 10;
            max-width: 600px;
        }

        .slide-content h1 {
            font-size: 3.5rem;
            font-weight: 300;
            letter-spacing: 0.02em;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .slide-content p {
            font-size: 1.1rem;
            font-weight: 300;
            letter-spacing: 0.05em;
            text-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        .slide-indicators {
            position: absolute;
            bottom: 30px;
            right: 30px;
            display: flex;
            gap: 10px;
            z-index: 20;
        }

        .indicator {
            width: 40px;
            height: 2px;
            background-color: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .indicator.active {
            background-color: rgba(255,255,255,1);
        }

        .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.3));
            z-index: 5;
        }

        @media (max-width: 768px) {
            .slide-content h1 {
                font-size: 2rem;
            }
            
            .slide-content p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
        </style>
  </head>
  <body>
    @include("layout.nav")
    <div class="hero-slideshow">
        <div class="overlay"></div>
        
        <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1600&h=900&fit=crop');">
            <div class="slide-content">
                <h1>Timeless Elegance</h1>
                <p>Discover our new collection</p>
            </div>
        </div>

        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1600&h=900&fit=crop');">
            <div class="slide-content">
                <h1>Refined Luxury</h1>
                <p>Crafted with precision and care</p>
            </div>
        </div>

        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?w=1600&h=900&fit=crop');">
            <div class="slide-content">
                <h1>Modern Sophistication</h1>
                <p>Where style meets comfort</p>
            </div>
        </div>

        <div class="slide-indicators">
            <div class="indicator active" data-slide="0"></div>
            <div class="indicator" data-slide="1"></div>
            <div class="indicator" data-slide="2"></div>
        </div>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const indicators = document.querySelectorAll('.indicator');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            indicators.forEach(indicator => indicator.classList.remove('active'));
            
            slides[index].classList.add('active');
            indicators[index].classList.add('active');
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        // Auto advance every 5 seconds
        setInterval(nextSlide, 5000);

        // Click indicators to jump to specific slide
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>