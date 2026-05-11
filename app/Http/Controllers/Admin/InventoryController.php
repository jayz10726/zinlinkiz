<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filter === 'out')  $query->where('stock', 0);
        if ($request->filter === 'low')  $query->where('stock', '>', 0)->where('stock', '<=', 5);
        if ($request->filter === 'good') $query->where('stock', '>', 5);
        if ($request->search)            $query->where('name', 'like', '%'.$request->search.'%');
        if ($request->category)          $query->where('category', $request->category);

        $products   = $query->orderBy('stock', 'asc')->paginate(25);
        $categories = Product::distinct()->pluck('category');
        $totalValue = Product::selectRaw('SUM(stock * price) as val')->value('val') ?? 0;
        $lowStock   = Product::where('stock', '>', 0)->where('stock', '<=', 5)->count();
        $outOfStock = Product::where('stock', 0)->count();
        $totalUnits = Product::sum('stock');

        return view('admin.inventory.index', compact(
            'products','categories','totalValue','lowStock','outOfStock','totalUnits'
        ));
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'stock'     => 'required|integer|min:0',
            'operation' => 'required|in:set,add,subtract',
        ]);

        $product = Product::findOrFail($id);

        match($request->operation) {
            'set'      => $product->update(['stock' => $request->stock]),
            'add'      => $product->increment('stock', $request->stock),
            'subtract' => $product->update(['stock' => max(0, $product->stock - $request->stock)]),
        };

        $new = $product->fresh()->stock;
        return back()->with('success', "\"{$product->name}\" stock updated to {$new} units.");
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate(['stocks' => 'required|array', 'stocks.*' => 'integer|min:0']);

        $count = 0;
        foreach ($request->stocks as $id => $qty) {
            if (is_numeric($id) && is_numeric($qty) && $qty >= 0) {
                Product::where('id', $id)->update(['stock' => (int)$qty]);
                $count++;
            }
        }
        return back()->with('success', "Inventory updated for {$count} product(s).");
    }
}