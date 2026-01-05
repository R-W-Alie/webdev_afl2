<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function history(Request $request)
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->with(['items.product', 'address'])
            ->latest()
            ->paginate(9);

        return view('orders-history', compact('orders'));
    }

    public function details(Order $order)
    {
        $user = Auth::user();

        if ($order->user_id !== $user->id) {
            abort(403, 'Unauthorized access');
        }

        $order->load(['items.product', 'address', 'payment']);

        return view('order-details', compact('order'));
    }

    public function confirmation(Order $order)
    {
        $user = Auth::user();

        if ($order->user_id !== $user->id) {
            abort(403, 'Unauthorized access');
        }

        $order->load('items.product');

        return view('order-confirmation', compact('order'));
    }
}
