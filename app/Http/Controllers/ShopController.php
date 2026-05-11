<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CarouselSlide;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function home()
    {
        $featured = Product::where('featured', true)
                           ->where('is_active', true)
                           ->take(8)->get();

        $categories = Product::where('is_active', true)
                             ->distinct()->pluck('category');

        $latest = Product::where('is_active', true)
                         ->latest()->take(4)->get();

        // Load carousel slides from DB — fall back to empty if table doesn't exist yet
        try {
            $slides = CarouselSlide::active()->get();
        } catch (\Exception $e) {
            $slides = collect();
        }

        return view('shop.home', compact('featured', 'categories', 'latest', 'slides'));
    }

    public function products(Request $request)
    {
        $query = Product::where('is_active', true);

        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%')
                  ->orWhere('specs', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products   = $query->paginate(12);
        $categories = Product::where('is_active', true)->distinct()->pluck('category');

        return view('shop.products', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::where('is_active', true)->findOrFail($id);

        $related = Product::where('category', $product->category)
                          ->where('id', '!=', $product->id)
                          ->where('is_active', true)
                          ->take(4)->get();

        return view('shop.product', compact('product', 'related'));
    }
}