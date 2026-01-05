<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Address;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        $defaultAddress = $user->addresses()->where('is_default', true)->first() ?? $user->addresses()->first();

        return view('profile-edit', compact('user', 'defaultAddress'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:8|confirmed',
            'address_line1' => 'nullable|required_with:city,postal_code|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'nullable|required_with:address_line1,postal_code|string|max:120',
            'postal_code' => 'nullable|required_with:address_line1,city|string|max:20',
        ]);

        $addressData = collect($validated)->only([
            'address_line1',
            'address_line2',
            'city',
            'postal_code',
        ])->toArray();

        $hasAddressInput = collect($addressData)->filter(fn($value) => filled($value))->isNotEmpty();

        DB::transaction(function () use ($user, $validated, $addressData, $hasAddressInput) {
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->phone = $validated['phone'] ?? $user->phone;

            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            $user->save();

            if ($hasAddressInput) {
                $address = $user->addresses()->where('is_default', true)->first() ?? $user->addresses()->first();

                if ($address) {
                    $address->update(array_merge($addressData, ['is_default' => true]));
                    $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
                } else {
                    $user->addresses()->create(array_merge($addressData, ['is_default' => true]));
                }
            }
        });

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}