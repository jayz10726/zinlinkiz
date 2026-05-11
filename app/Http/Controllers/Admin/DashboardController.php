<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders   = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalProducts = Product::count();
        $totalRevenue  = Order::whereIn('status', ['confirmed','processing','shipped','delivered'])->sum('total');
        $recentOrders  = Order::latest()->take(10)->get();
        $lowStock      = Product::where('stock', '<=', 5)->where('is_active', true)->get();

        return view('admin.dashboard', compact(
            'totalOrders', 'pendingOrders', 'totalProducts',
            'totalRevenue', 'recentOrders', 'lowStock'
        ));
    }
}