<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Kel & Co')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> --}}

    <style>
        .kc-login-btn:hover {
            background-color: #8B7355;
            border-color: #8B7355;
            color: #F5F1E8 !important;
        }

        .kc-login-btn {
            color: #8B7355 !important;
            font-size: 0.85rem;
            font-weight: 300;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #2C2416 !important;
            position: relative;
            border: 1px solid #C9B8A3;
            /* OUTLINE COKLAT BEIGE */
            border-radius: 40px;
        }

        .kc-login-btn:focus,
        .kc-login-btn:active {
            outline: none !important;
            box-shadow: none !important;
            /* hilangin glow biru bootstrap */
            background-color: #8B7355 !important;
            border-color: #8B7355 !important;
            color: #F5F1E8 !important;
        }

        .kc-navbar {
            background-color: #F5F1E8;
            border-bottom: 1px solid #D4C4B0;
        }

        .kc-brand {
            font-size: 1.4rem;
            font-weight: 300;
            letter-spacing: 0.25em;
            color: #2C2416 !important;
            text-transform: uppercase;
        }

        .kc-brand:hover {
            opacity: 0.7;
        }

        .kc-nav-link {
            font-size: 0.85rem;
            font-weight: 300;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #2C2416 !important;
            position: relative;
        }

        .kc-nav-link:hover {
            color: #8B7355 !important;
        }

        .kc-nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 1px;
            background-color: #8B7355;
            transition: width 0.3s ease;
        }

        .kc-nav-link:hover::after {
            width: 60%;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%232C2416' stroke-linecap='round' stroke-miterlimit='10' stroke-width='1.5' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .kc-footer {
            background-color: #eae1d2;
            /* border-top: 1px solid #D4C4B0; */
        }

        .kc-footer-brand {
            font-size: 1.2rem;
            font-weight: 300;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #2C2416;
        }

        .kc-footer-tagline {
            font-size: 0.95rem;
            font-weight: 300;
            color: #5C4D3C;
            line-height: 1.6;
        }

        .kc-footer-link {
            font-size: 0.85rem;
            font-weight: 300;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #5C4D3C !important;
            text-decoration: none;
        }

        .kc-footer-link:hover {
            color: #8B7355 !important;
        }

        .kc-social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border: 1px solid #C9B8A3;
            border-radius: 50%;
            color: #5C4D3C;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .kc-social-link:hover {
            background-color: #2C2416;
            border-color: #2C2416;
            color: #F5F1E8 !important;
        }

        .kc-copyright {
            font-size: 0.75rem;
            font-weight: 300;
            letter-spacing: 0.05em;
            color: #8B7355;
        }

        .kc-footer-divider {
            width: 60px;
            height: 1px;
            background-color: #C9B8A3;
            margin: 2rem auto;
        }

        body {
            background-color: #F5F1E8;
        }
    </style>

    @yield('styles')
</head>

<body>
    @include('layout.nav')

    @yield('content')

    @include('layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    @yield('scripts')
</body>

</html>
