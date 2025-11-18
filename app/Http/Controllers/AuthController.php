<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin() {
        return view('auth.login');
    }

    // Proses login untuk user atau admin
    public function login(Request $request) {

        // Validasi input: email dan password wajib diisi
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Ambil hanya data email dan password dari form
        $credentials = $request->only('email', 'password');

        // Coba login menggunakan data tersebut
        if (Auth::attempt($credentials)) {

            // Regenerasi session agar lebih aman
            $request->session()->regenerate();

            // Ambil data user yang sedang login
            $user = Auth::user();

            // Jika role user adalah admin, langsung redirect ke halaman admin
            if ($user->role === 'admin') {
                return redirect('/admin')->with('success', 'Welcome Admin');
            }

            // Jika user biasa, redirect ke homepage
            return redirect('/')->with('success', 'Login successful');
        }

        // Jika gagal login, kembalikan error
        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ]);
    }

    // Menampilkan halaman register
    public function showRegister() {
        return view('auth.register');
    }

    // Proses pembuatan akun baru
    public function register(Request $request) {

        // Validasi input user saat membuat akun
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6'
        ]);

        // Simpan data user baru ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // enkripsi password
            'role' => 'user' // Set default role user (bukan admin)
        ]);

        // Login otomatis setelah berhasil register
        Auth::login($user);

        // Redirect ke homepage
        return redirect('/');
    }

    // Proses logout
    public function logout(Request $request) {

        // Hapus session user dan logout
        Auth::logout();

        // Invalidate session lama supaya tidak bisa dipakai lagi
        $request->session()->invalidate();

        // Regenerate token baru untuk keamanan
        $request->session()->regenerateToken();

        // Kembali ke halaman login
        return redirect('/login');
    }
}
