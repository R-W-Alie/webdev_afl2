<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;

Route::get('/product', [ProductController::class, 'index'])->name('products.index');


Route::get('/', function () {
    return view('home');
});

Route::get('/store', [StoreController::class, 'index'])->name('store.index');
