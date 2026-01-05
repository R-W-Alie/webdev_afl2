<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        // Eager load products for each store
        $stores = Store::with('products')->paginate(6);

        return view('store', compact('stores'));
    }

    public function adminIndex(Request $request)
    {
        $search = $request->input('search');

        // Eager load products and allow search in store or product names
        $stores = Store::with('products')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        return view('admin.stores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('stores', 'public');
        }

        Store::create($validated);

        return redirect()->route('admin.stores.index')
            ->with('success', 'Store created successfully!');
    }

    public function edit(Store $store)
    {
        return view('admin.stores.edit', compact('store'));
    }

    public function update(Request $request, Store $store)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096'
        ]);

        if ($request->hasFile('image')) {
            if ($store->image && Storage::disk('public')->exists($store->image)) {
                Storage::disk('public')->delete($store->image);
            }
            $validated['image'] = $request->file('image')->store('stores', 'public');
        }

        $store->update($validated);

        return redirect()->route('admin.stores.index')
            ->with('success', 'Store updated successfully!');
    }

    public function destroy(Store $store)
    {
        if ($store->image && Storage::disk('public')->exists($store->image)) {
            Storage::disk('public')->delete($store->image);
        }

        $store->delete();

        return redirect()->route('admin.stores.index')
            ->with('success', 'Store deleted successfully!');
    }
    
}
