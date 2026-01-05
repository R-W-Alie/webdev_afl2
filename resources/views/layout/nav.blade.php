<nav class="navbar navbar-expand-lg kc-navbar py-3">
    <div class="container">
        <a class="navbar-brand kc-brand" href="/">KEL & CO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-lg-center gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link kc-nav-link px-3" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link kc-nav-link px-3" href="{{ route('products.index') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link kc-nav-link px-3" href="{{ route('store.index') }}">Stores</a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link kc-nav-link px-3" href="{{ route('login') }}">Login</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <a class="nav-link kc-nav-link px-3" href="{{ route('profile') }}">Profile</a>
                    </li>
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link kc-nav-link px-3" href="{{ route('admin.dashboard') }}">Admin</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link kc-nav-link px-3 position-relative" href="{{ route('wishlist.index') }}">
                            <i class="fa-regular fa-heart"></i>
                            @php $wCount = auth()->user()->wishlists()->count(); @endphp
                            @if($wCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">{{ $wCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link kc-nav-link px-3 position-relative" href="{{ route('cart.index') }}">
                            <i class="fa-solid fa-bag-shopping"></i>
                            @php $cCount = auth()->user()->cartItems()->sum('quantity'); @endphp
                            @if($cCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark">{{ $cCount }}</span>
                            @endif
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

