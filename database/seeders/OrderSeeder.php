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

                // Add 1-5 random products to order
                $orderProducts = $products->random(rand(1, 5));
                
                foreach ($orderProducts as $product) {
                    $quantity = rand(1, 3);
                    $order->addItem($product, $quantity);
                }

                // Update order total
                $order->updateTotal();
            }
        }
    }
}
