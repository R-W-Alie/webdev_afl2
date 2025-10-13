<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Navigation CSS -->
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
</head>

<body>
    @include('layout.nav')


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0" style="border-radius: 15px; overflow: hidden;">
                    <div class="row g-0 align-items-center">
                        <!-- Profile Picture (Left Side) -->
                        <div class="col-md-4 text-center  p-4">
                            <img src="https://i.pravatar.cc/200?img={{ $user->id }}" alt="Profile Photo"
                                class="rounded-circle mb-3 img-fluid"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        </div>

                        <!-- User Info (Right Side) -->
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h3 class="fw-light mb-1">{{ $user->name }}</h3>
                                <p class="text-muted mb-2">{{ $user->email }}</p>
                                <p class="text-secondary mb-3">
                                    <i class="fa-solid fa-location-dot me-2"></i>{{ $user->location ?? 'Unknown' }}
                                </p>
                                <p class="text-muted small mb-0">Member since {{ $user->created_at->format('F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
