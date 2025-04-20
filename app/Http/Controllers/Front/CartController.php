<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the cart page
     */
    public function index()
    {
        $cartItems = Session::get('cart', []);
        $subtotal = $this->calculateSubtotal($cartItems);
        $shipping = $subtotal > 0 ? 29.99 : 0;
        $total = $subtotal + $shipping;

        return view('front.cart.index', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        if (!$productId) {
            return response()->json(['success' => false, 'message' => 'Ürün ID\'si gereklidir.'], 400);
        }

        // Get the product data from the request
        $product = [
            'id' => $productId,
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => $request->input('image'),
            'specs' => $request->input('specs', ''),
            'quantity' => $quantity
        ];

        // Get the current cart
        $cart = Session::get('cart', []);

        // Check if product already exists in cart
        $found = false;
        foreach ($cart as $key => $item) {
            if ($item['id'] == $productId) {
                $cart[$key]['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        // If product not in cart, add it
        if (!$found) {
            $cart[] = $product;
        }

        // Update session
        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Ürün sepete eklendi!',
            'cartCount' => $this->getCartCount(),
            'cart' => $cart
        ]);
    }

    /**
     * Update product quantity in cart
     */
    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (!$productId || !$quantity) {
            return response()->json(['success' => false, 'message' => 'Ürün ID ve miktar gereklidir.'], 400);
        }

        $cart = Session::get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] == $productId) {
                if ($quantity <= 0) {
                    // Remove item if quantity is 0 or negative
                    unset($cart[$key]);
                } else {
                    $cart[$key]['quantity'] = $quantity;
                }
                break;
            }
        }

        // Reindex the array after possible removal
        $cart = array_values($cart);

        Session::put('cart', $cart);

        $subtotal = $this->calculateSubtotal($cart);
        $shipping = $subtotal > 0 ? 29.99 : 0;
        $total = $subtotal + $shipping;

        return response()->json([
            'success' => true,
            'message' => 'Sepet güncellendi!',
            'cartCount' => $this->getCartCount(),
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total
        ]);
    }

    /**
     * Remove product from cart
     */
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');

        if (!$productId) {
            return response()->json(['success' => false, 'message' => 'Ürün ID\'si gereklidir.'], 400);
        }

        $cart = Session::get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] == $productId) {
                unset($cart[$key]);
                break;
            }
        }

        // Reindex the array
        $cart = array_values($cart);

        Session::put('cart', $cart);

        $subtotal = $this->calculateSubtotal($cart);
        $shipping = $subtotal > 0 ? 29.99 : 0;
        $total = $subtotal + $shipping;

        return response()->json([
            'success' => true,
            'message' => 'Ürün sepetten kaldırıldı!',
            'cartCount' => $this->getCartCount(),
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total
        ]);
    }

    /**
     * Clear the entire cart
     */
    public function clear()
    {
        Session::forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Sepet temizlendi!',
            'cartCount' => 0
        ]);
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

    /**
     * Get total number of items in cart
     */
    private function getCartCount()
    {
        $cart = Session::get('cart', []);
        $count = 0;

        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return $count;
    }

    public function getCartData()
    {
        $cartItems = session()->get('cart', []);
        $subtotal = $this->calculateSubtotal($cartItems);
        $shipping = $subtotal > 0 ? 29.99 : 0;
        $total = $subtotal + $shipping;

        $cartCount = array_sum(array_column($cartItems, 'quantity'));

        return response()->json([
            'cartItems' => array_values($cartItems),
            'cartCount' => $cartCount,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total
        ]);
    }

    /**
     * Get cart data for AJAX requests
     */
    public function get()
    {
        $cart = Session::get('cart', []);

        return response()->json([
            'success' => true,
            'items' => $cart,
            'count' => $this->getCartCount()
        ]);
    }

    /**
     * Update item quantity via AJAX
     */
    public function updateQuantity(Request $request)
    {
        $id = $request->input('id');
        $quantity = (int) $request->input('quantity');

        if (!$id || $quantity <= 0) {
            return response()->json(['success' => false, 'message' => 'Geçersiz ürün ID\'si veya miktar.']);
        }

        $cart = Session::get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] == $id) {
                $cart[$key]['quantity'] = $quantity;
                break;
            }
        }

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Miktar güncellendi.'
        ]);
    }

    /**
     * Remove item via AJAX
     */
    public function removeItem(Request $request)
    {
        $id = $request->input('id');

        if (!$id) {
            return response()->json(['success' => false, 'message' => 'Geçersiz ürün ID\'si.']);
        }

        $cart = Session::get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['id'] == $id) {
                unset($cart[$key]);
                break;
            }
        }

        // Reindex the array
        $cart = array_values($cart);

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Ürün sepetten kaldırıldı.'
        ]);
    }
}
