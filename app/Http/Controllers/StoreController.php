<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;  

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $stores = Store::paginate(6);
        return view('store', compact('stores'));
    }

     public function adminIndex(Request $request)
    {
        $search = $request->input('search');
        $stores = Store::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
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
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle image upload
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
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
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
