<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Show checkout page
     */
    public function index()
    {
        $cartItems = Session::get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Sepetinizde ürün bulunmamaktadır.');
        }
        
        $subtotal = $this->calculateSubtotal($cartItems);
        $shipping = $subtotal > 0 ? 29.99 : 0;
        $total = $subtotal + $shipping;
        
        return view('front.checkout.index', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }
    
    /**
     * Process checkout
     */
    public function process(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_surname' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'address' => 'required|string',
        ]);
        
        $cartItems = Session::get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Sepetinizde ürün bulunmamaktadır.');
        }
        
        // Calculate totals
        $total = $this->calculateSubtotal($cartItems);
        
        try {
            // Create order
            $order = new Order();
            $order->user_id = auth()->check() ? auth()->id() : null;
            $order->total_amount = $total;
            $order->status = Order::STATUS_COMPLETED; // Auto-approve for now
            $order->shipping_name = $validated['shipping_name'];
            $order->shipping_surname = $validated['shipping_surname'];
            $order->shipping_email = $validated['shipping_email'];
            $order->shipping_phone = $validated['shipping_phone'];
            $order->city = $validated['city'];
            $order->district = $validated['district'];
            $order->address = $validated['address'];
            $order->save();
            
            // Create order items
            foreach ($cartItems as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item['id'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->price = $item['price'];
                $orderItem->save();
            }
            
            // Clear cart
            Session::forget('cart');
            
            // Store order ID in session for guest users
            Session::put('last_order_id', $order->id);
            
            // Redirect to success page
            return redirect()->route('order.success', $order->id);
            
        } catch (\Exception $e) {
            // Log error
            \Log::error('Order creation failed: ' . $e->getMessage());
            
            // Redirect to failed page
            return redirect()->route('order.failed')->with('error', 'Siparişiniz oluşturulurken bir hata oluştu.');
        }
    }
    
    /**
     * Calculate subtotal from cart items
     */
    private function calculateSubtotal($cartItems)
    {
        $subtotal = 0;
        
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        return $subtotal;
    }
} 