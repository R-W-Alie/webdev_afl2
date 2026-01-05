<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $addresses = $user->addresses()
            ->orderByDesc('is_default')
            ->latest()
            ->get();

        return view('addresses.index', compact('addresses'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:120',
            'postal_code' => 'required|string|max:20',
            'is_default' => 'sometimes|boolean',
        ]);

        $makeDefault = $request->boolean('is_default');

        DB::transaction(function () use ($user, $data, $makeDefault) {
            $defaultFlag = $makeDefault;

            if ($defaultFlag) {
                $user->addresses()->update(['is_default' => false]);
            } elseif (!$user->addresses()->where('is_default', true)->exists()) {
                // If no default exists yet, make the new one default
                $defaultFlag = true;
            }

            $user->addresses()->create(array_merge($data, [
                'is_default' => $defaultFlag,
            ]));
        });

        return redirect()->route('addresses.index')->with('success', 'Address added successfully.');
    }

    public function update(Request $request, Address $address)
    {
        $user = Auth::user();
        if ($address->user_id !== $user->id) {
            abort(403);
        }

        $data = $request->validate([
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:120',
            'postal_code' => 'required|string|max:20',
            'is_default' => 'sometimes|boolean',
        ]);

        $makeDefault = $request->boolean('is_default');

        DB::transaction(function () use ($user, $address, $data, $makeDefault) {
            if ($makeDefault) {
                $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
            }

            $address->update(array_merge($data, [
                'is_default' => $makeDefault ? true : $address->is_default,
            ]));
        });

        return redirect()->route('addresses.index')->with('success', 'Address updated successfully.');
    }

    public function destroy(Address $address)
    {
        $user = Auth::user();
        if ($address->user_id !== $user->id) {
            abort(403);
        }

        $wasDefault = $address->is_default;
        $address->delete();

        if ($wasDefault) {
            $next = $user->addresses()->first();
            if ($next) {
                $next->update(['is_default' => true]);
            }
        }

        return redirect()->route('addresses.index')->with('success', 'Address removed.');
    }

    public function makeDefault(Address $address)
    {
        $user = Auth::user();
        if ($address->user_id !== $user->id) {
            abort(403);
        }

        DB::transaction(function () use ($user, $address) {
            $user->addresses()->update(['is_default' => false]);
            $address->update(['is_default' => true]);
        });

        return redirect()->route('addresses.index')->with('success', 'Default address updated.');
    }
}
