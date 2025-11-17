<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ← WAJIB TAMBAH INI!

class ProfileController extends Controller
{
    public function __construct()
    {
        // Hanya user login boleh akses
        $this->middleware('auth');
    }

    public function index()
    {
        // Ambil user yang lagi login
        $user = Auth::user(); // ← PALING AMAN (tidak error)

        return view('profile', compact('user'));
    }
}
