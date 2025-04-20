<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create orders for regular users
        $users = User::where('role', 'user')->get();
        $products = Product::all();

        foreach ($users as $user) {
            // Create 1-3 orders for each user
            $orderCount = rand(1, 3);

            for ($i = 0; $i < $orderCount; $i++) {
                // Get shipping info from user
                $shippingInfo = $user->getDefaultShippingInfo();

                $order = new Order();
                $order->user_id = $user->id;
                $order->total_amount = 0;
                $order->status = collect(['pending', 'processing', 'completed'])->random();
                $order->fill($shippingInfo);
                $order->save();

                // Add 1-5 random products to order (or less if fewer products exist)
                $maxProducts = min(5, $products->count());
                $orderProducts = $products->random(rand(1, $maxProducts));

                foreach ($orderProducts as $product) {
                    $quantity = rand(1, 3);
                    $order->addItem($product, $quantity);
                }

                // Update order total
                $order->updateTotal();
            }
        }
        
        // Create orders for admin user (for testing purposes)
        $adminUser = User::where('role', 'admin')->first();
        if ($adminUser) {
            // Admin shipping info
            $adminShippingInfo = [
                'shipping_name' => 'Admin',
                'shipping_surname' => 'User',
                'shipping_phone' => '5555555555',
                'shipping_email' => $adminUser->email,
                'city' => 'İstanbul',
                'district' => 'Beşiktaş',
                'address' => 'Levent Mahallesi, Büyükdere Caddesi No:123'
            ];
            
            // Shipping companies and their tracking code formats
            $shippingCompanies = [
                'Aras Kargo' => 'AK' . rand(100000, 999999),
                'MNG Kargo' => 'MNG' . rand(10000000, 99999999),
                'PTT Kargo' => 'PTT' . rand(1000000, 9999999),
                'Yurtiçi Kargo' => 'YK' . rand(100000000, 999999999),
                'UPS' => '1Z' . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3)) . rand(10000000, 99999999)
            ];
            
            // Create 5 orders with different statuses
            $statuses = ['pending', 'processing', 'processing', 'completed', 'cancelled'];
            
            foreach ($statuses as $index => $status) {
                $order = new Order();
                $order->user_id = $adminUser->id;
                $order->total_amount = 0;
                $order->status = $status;
                $order->fill($adminShippingInfo);
                
                // Add shipping company and code for processing and completed orders
                if (in_array($status, ['processing', 'completed'])) {
                    $company = array_rand($shippingCompanies);
                    $order->shipping_company = $company;
                    $order->shipping_code = $shippingCompanies[$company];
                }
                
                // Random shipping cost
                $order->shipping_cost = rand(10, 50);
                
                $order->save();
                
                // Add random products
                $maxProducts = min(5, $products->count());
                $orderProducts = $products->random(rand(1, $maxProducts));
                
                foreach ($orderProducts as $product) {
                    $quantity = rand(1, 5);
                    $order->addItem($product, $quantity);
                }
                
                // Update order total
                $order->updateTotal();
            }
        }
    }
}
