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

    <div class="bg-light d-flex justify-content-center align-items-center vh-100">

        <div class="card shadow-lg border-0" style="width: 22rem; border-radius: 1.5rem;">
            <div class="card-body text-center p-4">
                <h4 class="card-title mb-1">{{ $user['name'] }}</h4>
                <p class="text-muted">{{ $user['email'] }}</p>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
