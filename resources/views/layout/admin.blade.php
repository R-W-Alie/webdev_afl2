<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Kel & Co</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-dark: #2C2416;
            --primary-brown: #8B7355;
            --light-brown: #C9B8A3;
            --border-brown: #D4C4B0;
            --text-dark: #5C4D3C;
        }

        body {
            background-color: #fafaf9;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .admin-sidebar {
            background-color: var(--primary-dark);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 1rem;
        }

        .admin-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            padding: 0.75rem 1.5rem;
            border-left: 3px solid transparent;
            transition: all 0.3s;
        }

        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: var(--primary-brown);
        }

        .admin-content {
            margin-left: 250px;
            padding: 2rem;
        }

        .btn-primary-custom {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
        }

        .btn-primary-custom:hover {
            background-color: #3d3120;
            border-color: #3d3120;
        }

        .btn-outline-custom {
            border-color: var(--border-brown);
            color: var(--text-dark);
        }

        .btn-outline-custom:hover {
            background-color: var(--light-brown);
            border-color: var(--light-brown);
            color: white;
        }

        .card {
            border: none;
            border-radius: 0.5rem;
        }

        .table-custom {
            background-color: white;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .table-custom thead {
            background-color: #f8f7f6;
            color: var(--text-dark);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <div class="text-center mb-4 px-3">
            <h4 class="text-white fw-light" style="letter-spacing: 0.15em;">KEL & CO</h4>
            <p class="small text-white-50 mb-0">Admin Panel</p>
        </div>

        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                href="{{ route('admin.products.index') }}">
                <i class="fa-solid fa-box me-2"></i> Products
            </a>
            <a class="nav-link {{ request()->routeIs('admin.stores.*') ? 'active' : '' }}"
                href="{{ route('admin.stores.index') }}">
                <i class="fa-solid fa-store me-2"></i> Stores
            </a>
            <a class="nav-link" href="{{ route('products.index') }}" target="_blank">
                <i class="fa-solid fa-external-link me-2"></i> View Site
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>

</html>
