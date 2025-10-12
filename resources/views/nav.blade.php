<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-GZFJavbz.css') }}"> --}}

</head>
<body>
    <header>
        <nav>
            <a href="/">Home</a> |
            <a href="/product">Product</a> |
            <a href="/profile">Profile</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>© 2025 Your Brand Name</p>
    </footer>
</body>
</html>