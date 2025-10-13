<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::first();//ambil data user kesatu for sementara

        return view('profile', compact('user'));
    }
}