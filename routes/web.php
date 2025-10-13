<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;

Route::get('/', function () {
    return view('home');
});

Route::get('/product', function () {
    return view('product');
});

Route::get(' /store', [StoreController::class, 'index'])->name('stores');

// Route::get('/Store', function () {
//     return view('store');
// });