<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('front.order.index', compact('orders'));
    }
    
    /**
     * Display the specified order details
     */
    public function show(Order $order)
    {
        // Check if order belongs to user
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('user.orders')
                ->with('error', 'Bu siparişe erişim izniniz bulunmamaktadır.');
        }
        
        return view('front.order.show', compact('order'));
    }
    
    /**
     * Display order success page
     */
    public function success(Order $order)
    {
        // Allow viewing order success page only if:
        // 1. Order belongs to the current user or
        // 2. User is not logged in but order was just created (in session)
        $justCreated = session()->has('last_order_id') && session('last_order_id') == $order->id;
        
        if (Auth::check() && $order->user_id !== Auth::id() && !$justCreated) {
            return redirect()->route('home');
        }
        
        return view('front.order.success', compact('order'));
    }
    
    /**
     * Display order failed page
     */
    public function failed()
    {
        return view('front.order.failed');
    }
} 