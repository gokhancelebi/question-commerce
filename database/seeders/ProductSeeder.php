<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'title' => 'Ürün ' . ($i + 1),
                'description' => 'Bu bir ürün açıklamasıdır.',
                'price' => 100.00,
                'quantity' => 10,
                'featured_image' => 'default.jpg',
                'is_active' => true,
            ]);
        }
    }
}
