<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $items = Wishlist::with('product.primaryImage')->where('user_id', $user->id)->get();
        return view('wishlist', compact('items'));
    }

    public function add(Product $product)
    {
        $user = Auth::user();
        Wishlist::firstOrCreate([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Added to wishlist');
    }

    public function remove(Product $product)
    {
        $user = Auth::user();
        Wishlist::where('user_id', $user->id)->where('product_id', $product->id)->delete();
        return back()->with('success', 'Removed from wishlist');
    }
}
