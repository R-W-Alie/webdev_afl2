<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
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

        $customer = User::updateOrCreate(
            ['email' => 'customer@test.com'],
            [
                'name' => 'Test Customer',
                'password' => Hash::make('password'),
                'phone' => '0812-3456-7890',
                'role' => 'customer',
            ]
        );

        // if (app()->environment('local')) {
        //     $customer = User::updateOrCreate(
        //         ['email' => 'customer@test.com'],
        //         [
        //             'name' => 'Test Customer',
        //             'password' => Hash::make('password'),
        //             'phone' => '0812-3456-7890',
        //             'role' => 'customer',
        //         ]
        //     );

        //     Store::factory()->count(3)->create();

        //     Product::factory()->count(4)->make()->each(function ($product) use ($categories) {
        //         $product->category_id = $categories->random()->id;
        //         $product->save();

        //         $product->images()->create([
        //             'image_url' => 'https://picsum.photos/seed/' . Str::random(6) . '/800/800',
        //             'is_primary' => true,
        //             'order' => 0,
        //         ]);
        //     });
        // }
    }
}
