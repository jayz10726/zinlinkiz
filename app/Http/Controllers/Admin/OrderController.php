<?php


namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTracking;
use Illuminate\Http\Request;
 
class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items');
 
        if ($request->status) {
            $query->where('status', $request->status);
        }
 
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('order_number', 'like', '%'.$request->search.'%')
                  ->orWhere('customer_name', 'like', '%'.$request->search.'%')
                  ->orWhere('customer_email', 'like', '%'.$request->search.'%')
                  ->orWhere('customer_phone', 'like', '%'.$request->search.'%');
            });
        }
 
        $orders = $query->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }
 
    public function show($id)
    {
        // Safely eager-load — trackings only if table exists
        $relations = ['items.product', 'user'];
 
        try {
            // Check if order_trackings table exists before eager loading
            if (\Illuminate\Support\Facades\Schema::hasTable('order_trackings')) {
                $relations[] = 'trackings';
            }
        } catch (\Exception $e) {
            // table check failed, skip trackings
        }
 
        $order = Order::with($relations)->findOrFail($id);
 
        // If trackings aren't loaded, give an empty collection
        if (!$order->relationLoaded('trackings')) {
            $order->setRelation('trackings', collect());
        }
 
        return view('admin.orders.show', compact('order'));
    }
 
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
 
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
            'note'   => 'nullable|string|max:500',
        ]);
 
        $order->update(['status' => $request->status]);
 
        // Create tracking record if table exists
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('order_trackings')) {
                $defaultNotes = [
                    'confirmed'  => 'Order confirmed. Payment verified.',
                    'processing' => 'Order is being prepared for dispatch.',
                    'shipped'    => 'Order has been dispatched for delivery.',
                    'delivered'  => 'Order delivered successfully to customer.',
                    'cancelled'  => 'Order has been cancelled.',
                ];
 
                OrderTracking::create([
                    'order_id'   => $order->id,
                    'status'     => $request->status,
                    'note'       => $request->note ?: ($defaultNotes[$request->status] ?? 'Status updated.'),
                    'updated_by' => auth()->user()->name,
                ]);
            }
        } catch (\Exception $e) {
            // tracking table not yet migrated — skip silently
        }
 
        return redirect()->back()
                         ->with('success', 'Order status updated to '.ucfirst($request->status).'.');
    }
}
 