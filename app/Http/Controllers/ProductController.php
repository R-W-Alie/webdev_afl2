<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
public function index(Request $request)
    {
        $search = $request->input('search');
        
        $products = Product::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate(9)
            ->appends(['search' => $search]);
        
        return view('product', compact('products'));
    }

}
