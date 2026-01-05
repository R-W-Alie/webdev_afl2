<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@kelco.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'phone' => '000-0000',
                'role' => 'admin',
            ]
        );

        $categoryNames = ["Women's tops", 'Jackets', 'Pants', 'Accessories'];
        $categories = collect($categoryNames)->map(function ($name) {
            return Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => $name.' collection']
            );
        });

        $product1 = Product::updateOrCreate(
            ['name' => 'Orielle Form'],
            [
                'category_id' => $categories->first()->id,
                'slug' => 'orielle-form',
                'description' => 'Soft, flexible fabric that stretches with you for all-day comfort and easy movement.',
                'price' => 159000,
                'stock_quantity' => 5,
                'is_featured' => true,
            ]
        );

        // MAIN IMG
        $product1->images()->updateOrCreate(
            ['is_primary' => true, 'product_id' => $product1->id],
            [
                'image_url' => 'products/orielleform-white1.jpeg',
                'order' => 0,
            ]
        );

        // more img
        $product1->images()->updateOrCreate(
            ['product_id' => $product1->id, 'order' => 1],
            [
                'image_url' => 'products/orielleform-black.jpeg',
                'is_primary' => false,
                'order' => 1,
            ]
        );

        $product1->images()->updateOrCreate(
            ['product_id' => $product1->id, 'order' => 2],
            [
                'image_url' => 'products/orielleform-white2.jpeg',
                'is_primary' => false,
                'order' => 2,
            ]
        );

        $product2 = Product::updateOrCreate(
            ['name' => 'Iris Sculpt'],
            [
                'category_id' => $categories->first()->id,
                'slug' => 'iris-sculpt',
                'description' => 'Contoured fit with breathable stretch fabric for all-day comfort.',
                'price' => 189000,
                'stock_quantity' => 8,
                'is_featured' => false,
            ]
        );

        $product2->images()->updateOrCreate(
            ['is_primary' => true, 'product_id' => $product2->id],
            [
                'image_url' => 'products/irissculpt.png',
                'order' => 0,
            ]
        );

        $customer = User::updateOrCreate(
            ['email' => 'customer@test.com'],
            [
                'name' => 'Test Customer',
                'password' => Hash::make('password'),
                'phone' => '0812-3456-7890',
                'role' => 'customer',
            ]
        );

        // DUMMY DATA FOR PAGES
        $productNames = [
            'Luxe Wool Coat', 'Classic Denim Jacket', 'Silk Blouse', 'Cotton Tee', 
            'Leather Jacket', 'Cashmere Sweater', 'Linen Shirt', 'Satin Dress',
            'Cargo Pants', 'Pleated Skirt', 'Wide Leg Trousers', 'Skinny Jeans',
            'Ankle Boots', 'Canvas Sneakers', 'Leather Loafers', 'Suede Pumps',
            'Gold Necklace', 'Silver Bracelet', 'Pearl Earrings', 'Diamond Ring',
            'Leather Bag', 'Crossbody Purse', 'Tote Bag', 'Clutch Wallet',
        ];

        foreach ($productNames as $index => $name) {
            $product = Product::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'category_id' => $categories->random()->id,
                    'description' => 'Premium quality ' . strtolower($name) . ' crafted with attention to detail. Perfect for any occasion.',
                    'price' => rand(99, 599) * 1000,
                    'stock_quantity' => rand(0, 20),
                    'is_featured' => $index < 3,
                ]
            );

            $product->images()->updateOrCreate(
                ['is_primary' => true, 'product_id' => $product->id],
                [
                    'image_url' => 'https://picsum.photos/seed/' . Str::slug($name) . '/800/800',
                    'order' => 0,
                ]
            );
        }

        // Generate dummy stores
        $storeData = [
            ['name' => 'Plaza Indonesia', 'city' => 'Jakarta', 'address' => 'Jl. MH Thamrin No.28-30'],
            ['name' => 'Grand Indonesia', 'city' => 'Jakarta', 'address' => 'Jl. MH Thamrin No.1'],
            ['name' => 'Pacific Place', 'city' => 'Jakarta', 'address' => 'Jl. Jend. Sudirman Kav 52-53'],
            ['name' => 'Senayan City', 'city' => 'Jakarta', 'address' => 'Jl. Asia Afrika No.19'],
            ['name' => 'Pondok Indah Mall', 'city' => 'Jakarta', 'address' => 'Jl. Metro Pondok Indah'],
            ['name' => 'Tunjungan Plaza', 'city' => 'Surabaya', 'address' => 'Jl. Basuki Rahmat No.8-12'],
            ['name' => 'Galaxy Mall', 'city' => 'Surabaya', 'address' => 'Jl. Dharmahusada Indah Timur'],
            ['name' => 'Beachwalk Shopping Center', 'city' => 'Bali', 'address' => 'Jl. Pantai Kuta'],
        ];

        foreach ($storeData as $data) {
            \App\Models\Store::updateOrCreate(
                ['name' => $data['name']],
                [
                    'address' => $data['address'],
                    'city' => $data['city'],
                    'phone' => '021-' . rand(1000000, 9999999),
                ]
            );
        }
    }
}
