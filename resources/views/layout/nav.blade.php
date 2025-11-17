<nav class="navbar navbar-expand-lg kc-navbar py-3">
    {{-- Navbar Bootstrap ukuran besar --}}
    <div class="container">

        {{-- Brand logo, klik → kembali ke home --}}
        <a class="navbar-brand kc-brand" href="{{ url('/') }}">KEL & CO</a>

        {{-- Tombol hamburger ketika layar kecil --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Wrapper semua menu di sisi kanan --}}
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">

                {{-- LINK NORMAL --}}
                <li class="nav-item">
                    <a class="nav-link kc-nav-link px-3" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link kc-nav-link px-3" href="{{ url('/product') }}">Product</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link kc-nav-link px-3" href="{{ url('/store') }}">Store</a>
                </li>

                {{-- ========================
                BAGIAN LOGIN/LOGOUT
                ======================== --}}

                @guest
                    <li class="nav-item">
                        <a class="btn kc-login-btn px-4 py-2" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <a class="nav-link kc-nav-link px-3" href="/profile">
                            Profile
                        </a>
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn kc-login-btn px-4 py-2">
                                Logout
                            </button>
                        </form>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
