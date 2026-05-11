<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart  = session('cart', []);
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart    = session('cart', []);
        $id      = $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity ?? 1;
        } else {
            $cart[$id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->image,
                'quantity' => $request->quantity ?? 1,
            ];
        }

        session(['cart' => $cart]);
        return redirect()->back()->with('success', $product->name . ' added to cart!');
    }

    public function update(Request $request)
    {
        $cart = session('cart', []);
        $id   = $request->product_id;

        if ($request->quantity < 1) {
            unset($cart[$id]);
        } else {
            $cart[$id]['quantity'] = $request->quantity;
        }

        session(['cart' => $cart]);
        return redirect()->route('cart')->with('success', 'Cart updated.');
    }

    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return redirect()->route('cart')->with('success', 'Item removed.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart')->with('success', 'Cart cleared.');
    }
}