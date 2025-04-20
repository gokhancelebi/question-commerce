<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
            ->latest()
            ->paginate(10);
            
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $order->load(['user', 'items.product']);
        $products = Product::all();
        
        return view('admin.order.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Validate request
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
            'shipping_code' => 'nullable|string|max:255',
            'shipping_cost' => 'required|numeric|min:0',
            'items' => 'required|array',
            'items.*.id' => 'sometimes|exists:order_items,id',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();
            
            // Update order basic info
            $order->update([
                'status' => $validated['status'],
                'shipping_code' => $validated['shipping_code'],
                'shipping_cost' => $validated['shipping_cost'],
            ]);
            
            // Process items
            $existingItemIds = $order->items->pluck('id')->toArray();
            $updatedItemIds = [];
            
            foreach ($validated['items'] as $itemData) {
                if (isset($itemData['id']) && in_array($itemData['id'], $existingItemIds)) {
                    // Update existing item
                    OrderItem::where('id', $itemData['id'])->update([
                        'product_id' => $itemData['product_id'],
                        'quantity' => $itemData['quantity'],
                        'price' => $itemData['price'],
                    ]);
                    $updatedItemIds[] = $itemData['id'];
                } else {
                    // Create new item
                    $order->items()->create([
                        'product_id' => $itemData['product_id'],
                        'quantity' => $itemData['quantity'],
                        'price' => $itemData['price'],
                    ]);
                }
            }
            
            // Remove items not in the update
            $itemsToDelete = array_diff($existingItemIds, $updatedItemIds);
            if (!empty($itemsToDelete)) {
                OrderItem::whereIn('id', $itemsToDelete)->delete();
            }
            
            // Update order total
            $order->updateTotal();
            
            DB::commit();
            
            // Refresh order to get updated totals
            $order->refresh();
            
            return redirect()->route('admin.orders.show', $order)
                ->with('success', 'Sipariş başarıyla güncellendi.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Sipariş güncellenirken bir hata oluştu: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
