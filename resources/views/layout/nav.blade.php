<nav class="navbar navbar-expand-lg kc-navbar py-3"> 
    {{-- Baris ini bikin navbar Bootstrap ukuran besar --}}
    <div class="container">
        {{-- Brand logo, klik → ke halaman utama --}}
        <a class="navbar-brand kc-brand" href="{{ url('/') }}">KEL & CO</a>

        {{-- Tombol hamburger di layar kecil --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Wrapper menu kanan --}}
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">

                {{-- Link normal, tidak terkait login --}}
                <li class="nav-item">
                    <a class="nav-link kc-nav-link px-3" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link kc-nav-link px-3" href="{{ url('/product') }}">Product</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link kc-nav-link px-3" href="{{ url('/store') }}">Store</a>
                </li>

                {{-- ------------------------- --}}
                {{-- BAGIAN CEK LOGIN / LOGOUT --}}
                {{-- ------------------------- --}}

                {{-- @guest = tampil hanya kalau user BELUM login --}}
                @guest
                    <li class="nav-item">
                        {{-- Route('login') otomatis jika pakai auth laravel --}}
                        <a class="nav-link kc-login-btn px-3 btn btn-primary text-white" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                @endguest

                {{-- @auth = tampil hanya jika user SUDAH login --}}
                @auth
                    <li class="nav-item">
                        {{-- Menu Profile (hanya muncul setelah login) --}}
                        <a class="nav-link kc-nav-link px-3" href="{{ url('/profile') }}">
                            Profile
                        </a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

