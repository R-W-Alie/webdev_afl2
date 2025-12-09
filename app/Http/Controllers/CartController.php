<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $items = CartItem::with('product.primaryImage')->where('user_id', $user->id)->get();
        $total = $items->sum(fn($item) => $item->quantity * ($item->product->price ?? 0));
        return view('cart', compact('items', 'total'));
    }

    public function add(Product $product, Request $request)
    {
        $user = Auth::user();
        $request->validate(['quantity' => 'nullable|integer|min:1']);
        $qty = max(1, (int) $request->input('quantity', 1));

        $item = CartItem::firstOrNew(['user_id' => $user->id, 'product_id' => $product->id]);
        $item->quantity = ($item->quantity ?? 0) + $qty;
        $item->save();

        return back()->with('success', 'Added to cart');
    }

    public function remove(Product $product)
    {
        $user = Auth::user();
        CartItem::where('user_id', $user->id)->where('product_id', $product->id)->delete();
        return back()->with('success', 'Removed from cart');
    }
}
