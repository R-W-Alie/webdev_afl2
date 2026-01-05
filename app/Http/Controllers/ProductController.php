<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category');
        $sort = $request->input('sort', 'newest');

        $products = Product::with(['category', 'primaryImage'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('slug', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->when($sort === 'price_asc', fn($q) => $q->orderBy('price', 'asc'))
            ->when($sort === 'price_desc', fn($q) => $q->orderBy('price', 'desc'))
            ->when($sort === 'name', fn($q) => $q->orderBy('name'))
            ->when($sort === 'newest', fn($q) => $q->latest())
            ->paginate(9)
            ->appends([
                'search' => $search,
                'category' => $categoryId,
                'sort' => $sort,
            ]);

        $categories = Category::orderBy('name')->get();
        $featuredProducts = Product::with('primaryImage')->where('is_featured', true)->latest()->take(6)->get();

        return view('product', compact('products', 'categories', 'categoryId', 'sort', 'featuredProducts', 'search'));
    }

    public function adminIndex(Request $request)
    {
        $search = $request->input('search');
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]);
        
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'is_featured' => 'sometimes|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096'
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($validated);

        // Ensure primary image record aligns with uploaded image (used by listings)
        if (!empty($validated['image'])) {
            $product->images()->updateOrCreate(
                ['is_primary' => true],
                [
                    'image_url' => $validated['image'],
                    'order' => 0,
                    'is_primary' => true,
                ]
            );
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        Log::info('Product update attempt', [
            'product_id' => $product->id,
            'payload' => $request->all(),
        ]);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'is_featured' => 'sometimes|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096'
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

    
        if ($request->hasFile('image')) {
        
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');

            // Keep primary image in sync so listings reflect the new upload
            $product->images()->updateOrCreate(
                ['is_primary' => true],
                [
                    'image_url' => $validated['image'],
                    'order' => 0,
                    'is_primary' => true,
                ]
            );
        }

        $product->update($validated);

        // Update size inventory
        if ($request->has('sizes')) {
            foreach ($request->input('sizes', []) as $size => $stock) {
                $product->sizes()->updateOrCreate(
                    ['size' => $size],
                    ['stock' => max(0, intval($stock))]
                );
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Delete image
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'primaryImage', 'images', 'sizes', 'reviews.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('product.show', compact('product'));
    }

    
}
