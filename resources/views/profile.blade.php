<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('layout.nav')


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4" style="background-color: #faf7f2;">
                    <div class="card-body text-center py-5 px-4">
                        
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-4"
                            style="width: 90px; height: 90px; background-color: #e5d5b5; color: #fff; font-size: 2rem; font-weight: 500;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <h3 class="fw-light text-secondary mb-1">{{ $user->name }}</h3>
                        <p class="text-muted mb-3">{{ $user->email }}</p>

                        <div class="mx-auto mb-3" style="width: 60px; height: 2px; background-color: #bfa97a;"></div>

                        <p class="text-secondary mb-1">
                            <i class="bi bi-geo-alt me-2"></i>{{ $user->location ?? 'Unknown Location' }}
                        </p>
                        <p class="text-muted small">
                            Member since {{ $user->created_at->format('F Y') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
