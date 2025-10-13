<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            StoreSeeder::class,
        ]);
        $this->call([
            ProductSeeder::class,
        ]);

        $this->call([
            UserSeeder::class,
        ]);
    }
}