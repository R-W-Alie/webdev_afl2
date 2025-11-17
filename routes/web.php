<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;



Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

Route::get('/product', [ProductController::class, 'index'])->name('products.index');

Route::get('/', function () {
    return view('home');
});

Route::get('/store', [StoreController::class, 'index'])->name('store.index');

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        dd(get_class(Auth::user()));
        return 'ADMIN PAGE';
    });
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Illuminate\Http\Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/admin/dashboard');
    }

    return back()->withErrors([
        'email' => 'Wrong email or password',
    ]);
});
