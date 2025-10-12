{{-- @extends('nav')

@section('title', 'product')

@section('content')
    <h1>Our Products</h1>
    <p>Explore our latest collections and style inspirations.</p>
@endsection --}}

@php
    use App\Models\Product;

    $products = Product::all();
    $product = $products[0]; // tampilkan produk pertama
    $recommended = collect($products)->where('id', '!=', $product['id'])->take(3);
@endphp
@extends('nav')
@section('title', $product['name'] . ' — Votre')
@section('content')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
<div class="max-w-7xl mx-auto px-6 py-16">

    {{-- Product Section --}}
    <div class="grid md:grid-cols-2 gap-14">
        {{-- Left: Product Images --}}
        <div class="space-y-4">
            <img src="{{ asset($product['main_image']) }}" alt="{{ $product['name'] }}" 
                class="w-full rounded-2xl shadow-sm object-cover">

            <div class="grid grid-cols-4 gap-3">
                @foreach ($product['gallery'] as $img)
                    <img src="{{ asset($img) }}" 
                        class="rounded-xl hover:opacity-80 cursor-pointer transition duration-200">
                @endforeach
            </div>
        </div>

        {{-- Right: Info --}}
        <div>
            <h1 class="text-3xl font-semibold mb-3 tracking-tight">{{ $product['name'] }}</h1>
            <p class="text-lg text-gray-700 mb-6 font-light">
                Rp {{ number_format($product['price'], 0, ',', '.') }}
            </p>

            <p class="text-gray-600 leading-relaxed mb-8">
                {{ $product['description'] }}
            </p>

            {{-- Size Selector --}}
            <div class="mb-8">
                <label class="block text-gray-700 mb-2 font-medium">Select Size</label>
                <div class="flex gap-3">
                    @foreach(['S','M','L','XL'] as $size)
                        <button class="border border-gray-300 rounded-full px-4 py-2 text-sm hover:bg-gray-900 hover:text-white transition">
                            {{ $size }}
                        </button>
                    @endforeach
                </div>
            </div>

            {{-- Add to Cart (non-functional) --}}
            <button class="w-full bg-gray-900 text-white py-3 rounded-full text-sm uppercase tracking-wide hover:bg-gray-700 transition">
                Add to Cart
            </button>
        </div>
    </div>

    {{-- Recommended --}}
    <div class="mt-20">
        <h2 class="text-xl font-semibold mb-8">You may also like</h2>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($recommended as $item)
                <div class="group">
                    <div class="overflow-hidden rounded-2xl bg-gray-50">
                        <img src="{{ asset($item['main_image']) }}" 
                            class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <h3 class="mt-3 text-sm font-medium text-gray-800 group-hover:text-gray-600">
                        {{ $item['name'] }}
                    </h3>
                    <p class="text-gray-500 text-sm">
                        Rp {{ number_format($item['price'], 0, ',', '.') }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
