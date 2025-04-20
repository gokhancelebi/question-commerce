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
        $products = [
            [
                'title' => 'UltraBook Pro X15',
                'description' => '15.6" 4K ekran, Intel Core i7 işlemci, 16GB RAM ve 1TB SSD depolama özelliklerine sahip premium laptop.',
                'price' => 12999.99,
                'quantity' => 5,
                'featured_image' => 'uploads/products/default.jpg',
                'is_active' => true,
                'external_url' => 'https://example.com/ultrabook-pro-x15'
            ],
            [
                'title' => 'GamerPro X17',
                'description' => '17.3" 240Hz ekran, RTX 4070, 32GB RAM ve 1TB SSD özelliklerine sahip gaming laptop.',
                'price' => 18499.99,
                'quantity' => 3,
                'featured_image' => 'uploads/products/default.jpg',
                'is_active' => true,
                'external_url' => null
            ],
            [
                'title' => 'FlexBook Pro',
                'description' => '14" Dokunmatik ekran, Intel Core i7, 16GB RAM ve 512GB SSD özelliklerine sahip dönüştürülebilir laptop.',
                'price' => 13999.99,
                'quantity' => 8,
                'featured_image' => 'uploads/products/default.jpg',
                'is_active' => true,
                'external_url' => 'https://example.com/flexbook-pro'
            ]
        ];

        foreach ($products as $product) {
            $product = Product::create($product);

            $product->images()->create([
                'image_path' => 'uploads/products/gallery/gallery_1744044765_67f402ddb5790_0.jpg',
            ]);
            $product->images()->create([
                'image_path' => 'uploads/products/gallery/gallery_1744044769_67f402e1995ac_0.jpg',
            ]);
            $product->images()->create([
                'image_path' => 'uploads/products/gallery/gallery_1744044784_67f402f009aa0_0.jpg',
            ]);
        }
    }
}
