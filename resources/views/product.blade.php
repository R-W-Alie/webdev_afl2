<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> aku lupa namanya apa </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
    </head>
    <style>
        .slide {
            position: absolute;
            width: 100%;
            height: 60%;
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
</html>