<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $addresses = Address::where('user_id', $user->id)->get();
        $defaultAddress = $addresses->firstWhere('is_default', true) ?? $addresses->first();

        return view('checkout', compact('cartItems', 'total', 'addresses', 'defaultAddress', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $validated = $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'notes' => 'nullable|string|max:500',
        ]);

        // Verify address belongs to user
        $address = Address::findOrFail($validated['address_id']);
        if ($address->user_id !== $user->id) {
            return back()->with('error', 'Invalid address selected');
        }

        // Calculate total
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'address_id' => $validated['address_id'],
            'total_amount' => $total,
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        // Create order items from cart
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'subtotal' => $item->product->price * $item->quantity,
            ]);
        }

        // Clear cart
        CartItem::where('user_id', $user->id)->delete();

        // Create Stripe Checkout Session (hosted payment page)
        $stripeKey = config('services.stripe.secret') ?: env('STRIPE_SECRET');
        if (empty($stripeKey)) {
            return back()->with('error', 'Stripe secret key missing. Set STRIPE_SECRET in .env');
        }
        Stripe::setApiKey($stripeKey);

        $lineItems = $cartItems->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'idr',
                    'unit_amount' => (int) ($item->product->price * 100), // Stripe expects amount in cents
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                ],
                'quantity' => $item->quantity,
            ];
        })->values()->all();

        $session = StripeSession::create([
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'customer_email' => $user->email,
            'line_items' => $lineItems,
            'success_url' => route('order.confirmation', $order->id) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cart.index'),
            'metadata' => [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
            ],
        ]);

        $order->update([
            'payment_session_id' => $session->id,
            'payment_status' => 'pending',
        ]);

        return redirect($session->url);
    }
}
