<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function showForm(Product $product)
    {
        return view('review-form', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $user = Auth::user();

        // Check if user purchased this product
        $hasPurchased = Order::where('user_id', $user->id)
            ->whereHas('items', fn($q) => $q->where('product_id', $product->id))
            ->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'You can only review products you have purchased.');
        }

        // Check if user already reviewed this product
        $existingReview = Review::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        Review::create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => false, // Pending admin approval
        ]);

        return redirect()->route('products.show', $product->slug)
            ->with('success', 'Review submitted successfully! It will appear after admin approval.');
    }

    public function adminIndex(Request $request)
    {
        $status = $request->input('status', 'pending'); // pending, approved, rejected
        $q = $request->input('q');

        $reviews = Review::with(['product', 'user'])
            ->when($status === 'pending', fn($query) => $query->where('is_approved', false)->whereNull('rejected_at'))
            ->when($status === 'approved', fn($query) => $query->where('is_approved', true))
            ->when($status === 'rejected', fn($query) => $query->whereNotNull('rejected_at'))
            ->when($q, function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner->where('comment', 'like', "%{$q}%")
                        ->orWhereHas('product', fn($pq) => $pq->where('name', 'like', "%{$q}%"))
                        ->orWhereHas('user', fn($uq) => $uq->where('name', 'like', "%{$q}%"));
                });
            })
            ->latest()
            ->paginate(10)
            ->appends(['status' => $status, 'q' => $q]);

        return view('admin.reviews.index', compact('reviews', 'status', 'q'));
    }

    public function approve(Review $review)
    {
        $review->update([
            'is_approved' => true,
            'rejected_at' => null,
        ]);

        return back()->with('success', 'Review approved successfully!');
    }

    public function reject(Review $review)
    {
        $review->update([
            'is_approved' => false,
            'rejected_at' => now(),
        ]);

        return back()->with('success', 'Review rejected.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted successfully!');
    }
}
