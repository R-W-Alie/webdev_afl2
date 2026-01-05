<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Store;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;


Route::get('/product', [ProductController::class, 'index'])->name('products.index');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // cart & wishlist
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/wishlist/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/wishlist/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');

    // Addresses
    Route::get('/addresses', [\App\Http\Controllers\AddressController::class, 'index'])->name('addresses.index');
    Route::post('/addresses', [\App\Http\Controllers\AddressController::class, 'store'])->name('addresses.store');
    Route::put('/addresses/{address}', [\App\Http\Controllers\AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/{address}', [\App\Http\Controllers\AddressController::class, 'destroy'])->name('addresses.destroy');
    Route::post('/addresses/{address}/default', [\App\Http\Controllers\AddressController::class, 'makeDefault'])->name('addresses.default');

    // Checkout & Orders
    Route::get('/checkout', [\App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'history'])->name('orders.history');
    Route::get('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'details'])->name('order.details');
    Route::get('/orders/{order}/confirmation', [\App\Http\Controllers\OrderController::class, 'confirmation'])->name('order.confirmation');

    // Reviews
    Route::get('/products/{product}/review', [\App\Http\Controllers\ReviewController::class, 'showForm'])->name('review-form');
    Route::post('/products/{product}/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        $stats = [
            'products' => Product::count(),
            'orders' => Order::count(),
            'customers' => User::where('role', 'customer')->count(),
            'stores' => Store::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    })->name('admin.dashboard');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/products', [ProductController::class, 'adminIndex'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/stores', [StoreController::class, 'adminIndex'])->name('stores.index');
    Route::get('/stores/create', [StoreController::class, 'create'])->name('stores.create');
    Route::post('/stores', [StoreController::class, 'store'])->name('stores.store');
    Route::get('/stores/{store}/edit', [StoreController::class, 'edit'])->name('stores.edit');
    Route::put('/stores/{store}', [StoreController::class, 'update'])->name('stores.update');
    Route::delete('/stores/{store}', [StoreController::class, 'destroy'])->name('stores.destroy');

    Route::get('/orders', function (\Illuminate\Http\Request $request) {
        $status = $request->input('status');
        $q = $request->input('q');
        $orders = \App\Models\Order::with(['user', 'address'])
            ->when($status, fn($q2) => $q2->where('status', $status))
            ->when($q, function ($q2) use ($q) {
                $q2->where(function ($inner) use ($q) {
                    $inner->where('order_number', 'like', "%{$q}%")
                        ->orWhereHas('user', fn($uq) => $uq->where('name', 'like', "%{$q}%"));
                });
            })
            ->latest()
            ->paginate(12)
            ->appends(['status' => $status, 'q' => $q]);
        return view('admin.orders.index', compact('orders', 'status', 'q'));
    })->name('orders.index');

    Route::post('/orders/{order}/status', [\App\Http\Controllers\OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::get('/customers', function (\Illuminate\Http\Request $request) {
        $q = $request->input('q');
        $customers = \App\Models\User::where('role', 'customer')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('phone', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->appends(['q' => $q]);
        return view('admin.customers.index', compact('customers', 'q'));
    })->name('customers.index');

    Route::get('/reviews', [\App\Http\Controllers\ReviewController::class, 'adminIndex'])->name('reviews.index');
    Route::post('/reviews/{review}/approve', [\App\Http\Controllers\ReviewController::class, 'approve'])->name('reviews.approve');
    Route::post('/reviews/{review}/reject', [\App\Http\Controllers\ReviewController::class, 'reject'])->name('reviews.reject');
    Route::delete('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// ==========================
// PUBLIC PAGES
// ==========================
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/store', [StoreController::class, 'index'])->name('store.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');
