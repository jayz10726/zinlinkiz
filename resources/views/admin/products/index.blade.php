@extends('layouts.admin')
@section('title', 'Products — zinlinktech Admin')
@section('page-title', 'Products')
@section('page-subtitle', 'Manage your product catalogue')

@section('content')

{{-- Top bar --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div class="flex items-center gap-3">
        <span class="text-sm text-slate-500">{{ $products->total() }} products</span>
    </div>
    <a href="{{ route('admin.products.create') }}"
       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition shadow-lg shadow-blue-500/20">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add New Product
    </a>
</div>

{{-- Filters --}}
<form method="GET" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 mb-5 flex flex-wrap gap-3">
    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="Search by name or brand..."
           class="flex-1 min-w-48 border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    <select name="category" class="border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">All Categories</option>
        @foreach($categories as $cat)
            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
        @endforeach
    </select>
    <select name="stock_filter" class="border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">All Stock</option>
        <option value="low" {{ request('stock_filter') == 'low' ? 'selected' : '' }}>Low Stock (≤5)</option>
        <option value="out" {{ request('stock_filter') == 'out' ? 'selected' : '' }}>Out of Stock</option>
    </select>
    <button type="submit" class="bg-slate-900 hover:bg-slate-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition">
        Search
    </button>
    <a href="{{ route('admin.products') }}" class="border border-slate-300 text-slate-600 hover:bg-slate-50 px-4 py-2.5 rounded-xl text-sm font-semibold transition">
        Reset
    </a>
</form>

{{-- Products table --}}
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Product</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider hidden md:table-cell">Category</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Price</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Stock</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider hidden lg:table-cell">Status</th>
                <th class="px-5 py-3.5 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($products as $product)
                <tr class="hover:bg-slate-50 transition">
                    {{-- Product --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-slate-100 rounded-xl overflow-hidden flex-shrink-0">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="font-semibold text-slate-900 text-sm truncate max-w-xs">{{ $product->name }}</p>
                                @if($product->brand)
                                    <p class="text-slate-400 text-xs">{{ $product->brand }}</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    {{-- Category --}}
                    <td class="px-5 py-4 hidden md:table-cell">
                        <span class="bg-blue-50 text-blue-700 text-xs font-bold px-2.5 py-1 rounded-full">{{ $product->category }}</span>
                    </td>
                    {{-- Price --}}
                    <td class="px-5 py-4 font-bold text-slate-900 text-sm">KES {{ number_format($product->price) }}</td>
                    {{-- Stock --}}
                    <td class="px-5 py-4">
                        <span class="font-bold text-sm
                            {{ $product->stock === 0 ? 'text-red-600' : ($product->stock <= 5 ? 'text-orange-600' : 'text-emerald-600') }}">
                            {{ $product->stock }}
                        </span>
                        <span class="text-slate-400 text-xs ml-1">units</span>
                    </td>
                    {{-- Status --}}
                    <td class="px-5 py-4 hidden lg:table-cell">
                        <div class="flex items-center gap-1.5">
                            <span class="{{ $product->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }} text-xs font-bold px-2 py-0.5 rounded-full">
                                {{ $product->is_active ? 'Active' : 'Hidden' }}
                            </span>
                            @if($product->featured)
                                <span class="bg-amber-100 text-amber-700 text-xs font-bold px-2 py-0.5 rounded-full">⭐</span>
                            @endif
                        </div>
                    </td>
                    {{-- Actions --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('product.show', $product->id) }}" target="_blank"
                               class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition" title="Preview">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                  onsubmit="return confirm('Delete {{ addslashes($product->name) }}? This cannot be undone.')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-5 py-16 text-center">
                        <div class="text-4xl mb-3">📦</div>
                        <p class="font-semibold text-slate-600 mb-1">No products found</p>
                        <a href="{{ route('admin.products.create') }}" class="text-blue-600 text-sm hover:underline">Add your first product →</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="px-5 py-4 border-t border-slate-100">
        {{ $products->withQueryString()->links() }}
    </div>
</div>

@endsection