<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        if ($request->category) {
            $query->where('category', $request->category);
        }
        $products   = $query->latest()->paginate(15);
        $categories = Product::distinct()->pluck('category');
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = ['Laptops', 'Accessories', 'Components', 'Monitors', 'Other'];
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'required|string',
            'brand'       => 'nullable|string',
            'specs'       => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data              = $request->except('image');
        $data['featured']  = $request->has('featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = ['Laptops', 'Accessories', 'Components', 'Monitors', 'Other'];
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category'    => 'required|string',
            'brand'       => 'nullable|string',
            'specs'       => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data              = $request->except('image');
        $data['featured']  = $request->has('featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted.');
    }
}