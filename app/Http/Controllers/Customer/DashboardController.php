<?php


namespace App\Http\Controllers\Customer;
 
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
 
class DashboardController extends Controller
{
    // Customer dashboard - all their orders
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
                       ->orWhere('customer_email', auth()->user()->email)
                       ->latest()
                       ->paginate(10);
 
        return view('customer.dashboard', compact('orders'));
    }
 
    // Single order tracking detail
    public function orderDetail($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
                      ->where(function ($q) {
                          $q->where('user_id', auth()->id())
                            ->orWhere('customer_email', auth()->user()->email);
                      })
                      ->with(['items.product', 'trackings'])
                      ->firstOrFail();
 
        return view('customer.order-detail', compact('order'));
    }
 
    // Update profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);
 
        auth()->user()->update([
            'name'  => $request->name,
            'phone' => $request->phone,
        ]);
 
        return back()->with('success', 'Profile updated successfully.');
    }
 
    // Change password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => ['required', 'confirmed', Password::min(8)],
        ]);
 
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
 
        auth()->user()->update(['password' => Hash::make($request->new_password)]);
 
        return back()->with('success', 'Password changed successfully.');
    }
}
 