<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

Route::get('/product', [ProductController::class, 'index'])->name('products.index');

Route::get('/', function () {
    return view('home');
});

Route::get('/store', [StoreController::class, 'index'])->name('store.index');
