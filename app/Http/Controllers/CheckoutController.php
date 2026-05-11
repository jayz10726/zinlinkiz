<?php
namespace App\Http\Controllers;
 
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTracking;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }
 
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
 
        // Pre-fill form if user is logged in
        $user = Auth::user();
 
        return view('checkout.index', compact('cart', 'total', 'user'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email',
            'customer_phone'   => 'required|string|max:20',
            'customer_address' => 'required|string',
            'city'             => 'required|string',
            'payment_method'   => 'required|in:mpesa,bank_transfer,cash_on_delivery',
        ]);
 
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }
 
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        $shipping = $subtotal > 50000 ? 0 : 500;
        $total    = $subtotal + $shipping;
 
        $order = Order::create([
            'user_id'          => Auth::id(), // link to logged-in user (null if guest)
            'order_number'     => 'TS-' . strtoupper(uniqid()),
            'customer_name'    => $request->customer_name,
            'customer_email'   => $request->customer_email,
            'customer_phone'   => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'city'             => $request->city,
            'subtotal'         => $subtotal,
            'shipping'         => $shipping,
            'total'            => $total,
            'payment_method'   => $request->payment_method,
            'notes'            => $request->notes,
            'status'           => 'pending',
        ]);
 
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'      => $order->id,
                'product_id'    => $item['id'],
                'product_name'  => $item['name'],
                'product_price' => $item['price'],
                'quantity'      => $item['quantity'],
                'subtotal'      => $item['price'] * $item['quantity'],
            ]);
            Product::where('id', $item['id'])->decrement('stock', $item['quantity']);
        }
 
        // Create first tracking entry
        OrderTracking::create([
            'order_id'   => $order->id,
            'status'     => 'pending',
            'note'       => 'Order placed successfully. Awaiting confirmation.',
            'updated_by' => 'System',
        ]);
 
        session()->forget('cart');
 
        return redirect()->route('checkout.success', $order->order_number);
    }
 
    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
                      ->with('items')
                      ->firstOrFail();
 
        return view('checkout.success', compact('order'));
    }
}