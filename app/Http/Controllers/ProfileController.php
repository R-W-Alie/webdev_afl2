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
    public function edit()
{
    $user = auth()->user();

    return view('profile-edit', compact('user'));
}

public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'location' => 'nullable',
        'password' => 'nullable|min:6'
    ]);

    // Update basic fields
    $user->name = $request->name;
    $user->email = $request->email;
    $user->location = $request->location;

    // Update password only if filled
    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('profile')->with('success', 'Profile updated successfully!');
}

}
