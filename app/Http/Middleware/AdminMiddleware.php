<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You must login first.');
        }

        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}
