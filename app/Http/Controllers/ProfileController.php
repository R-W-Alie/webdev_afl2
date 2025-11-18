<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        // Hanya user yang login boleh akses profile
        $this->middleware('auth');
    }

    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile-edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'location' => 'nullable|string',
            'password' => 'nullable|min:6'
        ]);

        // Update data dasar
        $user->name = $request->name;
        $user->email = $request->email;
        $user->location = $request->location;

        // Update password jika diisi
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('profile')
            ->with('success', 'Profile updated successfully!');
    }

    public function destroy()
    {
        $user = Auth::user();

        // logout sebelum delete
        Auth::logout();

        $user->delete();

        return redirect('/')
            ->with('success', 'Your account has been deleted.');
    }
}
