<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// ==========================
// PUBLIC PAGES
// ==========================
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/store', [StoreController::class, 'index'])->name('store.index');
Route::get('/product', [ProductController::class, 'index'])->name('products.index');

// ==========================
// AUTH (Login & Register)
// ==========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================
// ONLY LOGGED-IN USERS
// ==========================
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Edit Profile Page
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Update Profile
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // DELETE ACCOUNT
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');
});

// ==========================
// ADMIN AREA (with middleware)
// ==========================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // PRODUCT Admin routes
        Route::get('/products', [ProductController::class, 'adminIndex'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        // STORE Admin routes
        Route::get('/stores', [StoreController::class, 'adminIndex'])->name('stores.index');
        Route::get('/stores/create', [StoreController::class, 'create'])->name('stores.create');
        Route::post('/stores', [StoreController::class, 'store'])->name('stores.store');
        Route::get('/stores/{store}/edit', [StoreController::class, 'edit'])->name('stores.edit');
        Route::put('/stores/{store}', [StoreController::class, 'update'])->name('stores.update');
        Route::delete('/stores/{store}', [StoreController::class, 'destroy'])->name('stores.destroy');
    });
