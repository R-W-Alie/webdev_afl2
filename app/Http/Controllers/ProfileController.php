<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        // For now, just take the first user (dummy profile)
        $user = User::first();

        // send it to the view
        return view('profile', compact('user'));
    }
}