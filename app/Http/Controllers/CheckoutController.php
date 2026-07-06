<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        $cartItems = [];
        $total = 0;
        foreach ($cart as $id => $item) {
            $product = Product::with('primaryImage')->find($id);
            if ($product) {
                $price = $product->display_price;
                $subtotal = $price * $item['quantity'];
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            }
        }

        $user = auth()->user();
        $shippingMethods = ShippingMethod::where('is_active', true)->get();

        return view('checkout.index', compact('cartItems', 'total', 'user', 'shippingMethods'));
    }
}
