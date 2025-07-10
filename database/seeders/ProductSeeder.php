<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 3) as $product) {
            Product::create([
                'name' => "product $product",
                'category' => "category $product",
                'price' => 50000 * $product,
            ]);
        }
    }
}
