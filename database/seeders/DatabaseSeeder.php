<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Real data (kept for all environments)
        $admin = User::updateOrCreate(
            ['email' => 'admin@kelco.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'phone' => '000-0000',
                'role' => 'admin',
            ]
        );

        $categoryNames = ["Men's Shirts", "Women's Dresses", 'Jackets', 'Pants', 'Accessories'];
        $categories = collect($categoryNames)->map(function ($name) {
            return Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'description' => $name . ' collection']
            );
        });

        // Dummy data only for local environment
        if (app()->environment('local')) {
            $customer = User::updateOrCreate(
                ['email' => 'customer@test.com'],
                [
                    'name' => 'Test Customer',
                    'password' => Hash::make('password'),
                    'phone' => '0812-3456-7890',
                    'role' => 'customer',
                ]
            );

            Store::factory()->count(3)->create();

            // Create sample products with primary images
            Product::factory()->count(4)->make()->each(function ($product) use ($categories) {
                $product->category_id = $categories->random()->id;
                $product->save();

                $product->images()->create([
                    'image_url' => 'https://picsum.photos/seed/' . Str::random(6) . '/800/800',
                    'is_primary' => true,
                    'order' => 0,
                ]);
            });
        }
    }
}