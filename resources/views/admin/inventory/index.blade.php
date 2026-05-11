@extends('layouts.admin')
@section('title', 'Inventory — zinlinktech Admin')
@section('page-title', 'Inventory Management')
@section('page-subtitle', 'Track and update product stock levels')

@section('content')

{{-- Stats row --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-7">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center text-lg">📦</div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Total Units</p>
        </div>
        <p class="font-display font-bold text-2xl text-slate-900">{{ number_format($totalUnits) }}</p>
        <p class="text-xs text-slate-400 mt-0.5">Across all products</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center text-lg">💰</div>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Stock Value</p>
        </div>
        <p class="font-display font-bold text-2xl text-slate-900">KES {{ number_format($totalValue) }}</p>
        <p class="text-xs text-slate-400 mt-0.5">Total inventory value</p>
    </div>

    <div class="bg-orange-50 rounded-2xl border border-orange-100 shadow-sm p-5">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-9 h-9 bg-orange-100 rounded-xl flex items-center justify-center text-lg">⚠️</div>
            <p class="text-xs font-bold text-orange-500 uppercase tracking-wide">Low Stock</p>
        </div>
        <p class="font-display font-bold text-2xl text-orange-700">{{ $lowStock }}</p>
        <p class="text-xs text-orange-500 mt-0.5">≤ 5 units remaining</p>
    </div>

    <div class="bg-red-50 rounded-2xl border border-red-100 shadow-sm p-5">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-9 h-9 bg-red-100 rounded-xl flex items-center justify-center text-lg">🚫</div>
            <p class="text-xs font-bold text-red-500 uppercase tracking-wide">Out of Stock</p>
        </div>
        <p class="font-display font-bold text-2xl text-red-700">{{ $outOfStock }}</p>
        <p class="text-xs text-red-500 mt-0.5">Needs restocking now</p>
    </div>
</div>

{{-- Filters --}}
<div class="flex flex-wrap items-center gap-3 mb-5">
    <div class="flex gap-2 flex-wrap">
        @foreach(['' => 'All Products', 'out' => '🔴 Out of Stock', 'low' => '🟠 Low Stock', 'good' => '🟢 In Stock'] as $val => $label)
            <a href="{{ route('admin.inventory') }}{{ $val ? '?filter='.$val : '' }}"
               class="px-3 py-2 rounded-xl text-xs font-bold transition
                      {{ request('filter','') == $val
                         ? 'bg-blue-600 text-white shadow-sm'
                         : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <form method="GET" class="flex gap-2 ml-auto flex-wrap">
        @if(request('filter'))<input type="hidden" name="filter" value="{{ request('filter') }}">@endif
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Search products..."
               class="border border-slate-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-44">
        <select name="category" class="border border-slate-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-slate-900 hover:bg-slate-700 text-white px-4 py-2 rounded-xl text-sm font-bold transition">Search</button>
        <a href="{{ route('admin.inventory') }}" class="border border-slate-300 text-slate-600 hover:bg-slate-50 px-4 py-2 rounded-xl text-sm font-semibold transition">Reset</a>
    </form>
</div>

{{-- Bulk update table --}}
<form action="{{ route('admin.inventory.bulk') }}" method="POST" id="bulk-form">
    @csrf

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100 bg-slate-50 flex-wrap gap-3">
            <div>
                <p class="text-sm font-bold text-slate-700">Edit quantities inline — click Save All when done</p>
                <p class="text-xs text-slate-400 mt-0.5">Or use the quick buttons (+10, +50) for fast restocking</p>
            </div>
            <button type="submit"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition shadow-sm shadow-emerald-500/20 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save All Changes
            </button>
        </div>

        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Product</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider hidden md:table-cell">Category</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider hidden lg:table-cell">Price</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Stock</th>
                    <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider hidden sm:table-cell">Status</th>
                    <th class="px-5 py-3.5 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Quick Update</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($products as $product)
                    @php
                        $isOut  = $product->stock === 0;
                        $isLow  = !$isOut && $product->stock <= 5;
                        $rowBg  = $isOut ? 'bg-red-50/40' : ($isLow ? 'bg-orange-50/40' : '');
                        $inputCls = $isOut
                            ? 'border-red-300 bg-red-50 text-red-700'
                            : ($isLow ? 'border-orange-300 bg-orange-50 text-orange-700' : '');
                        $statusLabel = $isOut ? 'Out of Stock' : ($isLow ? 'Low Stock' : 'In Stock');
                        $statusCls   = $isOut
                            ? 'bg-red-100 text-red-700'
                            : ($isLow ? 'bg-orange-100 text-orange-700' : 'bg-emerald-100 text-emerald-700');
                        $barColor    = $isOut ? 'bg-red-500' : ($isLow ? 'bg-orange-500' : 'bg-emerald-500');
                        $barWidth    = min(100, ($product->stock / max(1, $product->stock + 10)) * 100);
                    @endphp
                    <tr class="hover:bg-slate-50 transition {{ $rowBg }}">
                        {{-- Product --}}
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-xl overflow-hidden flex-shrink-0">
                                    @if($product->image)
                                        <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-cover" alt="">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300 text-xs">💻</div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-900 text-sm truncate max-w-[180px]">{{ $product->name }}</p>
                                    @if($product->brand)<p class="text-slate-400 text-xs">{{ $product->brand }}</p>@endif
                                </div>
                            </div>
                        </td>

                        {{-- Category --}}
                        <td class="px-5 py-4 hidden md:table-cell">
                            <span class="bg-blue-50 text-blue-700 text-xs font-bold px-2.5 py-1 rounded-full">{{ $product->category }}</span>
                        </td>

                        {{-- Price --}}
                        <td class="px-5 py-4 hidden lg:table-cell font-bold text-slate-700 text-sm">
                            KES {{ number_format($product->price) }}
                        </td>

                        {{-- Stock + bar + editable input --}}
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-16 hidden sm:block">
                                    <div class="w-full bg-slate-200 rounded-full h-1.5">
                                        <div class="h-1.5 rounded-full {{ $barColor }}" style="width:{{ $barWidth }}%"></div>
                                    </div>
                                </div>
                                <input type="number"
                                       name="stocks[{{ $product->id }}]"
                                       value="{{ $product->stock }}"
                                       min="0"
                                       class="w-20 border rounded-xl px-3 py-1.5 text-sm font-bold text-center focus:outline-none focus:ring-2 focus:ring-blue-500 {{ $inputCls ?: 'border-slate-300' }}">
                            </div>
                        </td>

                        {{-- Status --}}
                        <td class="px-5 py-4 hidden sm:table-cell">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $statusCls }}">{{ $statusLabel }}</span>
                        </td>

                        {{-- Quick update buttons --}}
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-1">
                                <form action="{{ route('admin.inventory.stock', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="stock" value="10">
                                    <input type="hidden" name="operation" value="add">
                                    <button type="submit"
                                            class="bg-emerald-100 hover:bg-emerald-200 text-emerald-700 font-bold text-xs px-2.5 py-1.5 rounded-lg transition"
                                            title="Add 10 units">
                                        +10
                                    </button>
                                </form>

                                <form action="{{ route('admin.inventory.stock', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="stock" value="50">
                                    <input type="hidden" name="operation" value="add">
                                    <button type="submit"
                                            class="bg-blue-100 hover:bg-blue-200 text-blue-700 font-bold text-xs px-2.5 py-1.5 rounded-lg transition"
                                            title="Add 50 units">
                                        +50
                                    </button>
                                </form>

                                @if($product->stock > 0)
                                    <form action="{{ route('admin.inventory.stock', $product->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Set stock to 0 for {{ addslashes($product->name) }}?')">
                                        @csrf
                                        <input type="hidden" name="stock" value="0">
                                        <input type="hidden" name="operation" value="set">
                                        <button type="submit"
                                                class="bg-red-100 hover:bg-red-200 text-red-600 font-bold text-xs px-2.5 py-1.5 rounded-lg transition"
                                                title="Set to 0">
                                            ×0
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                   class="bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold px-2.5 py-1.5 rounded-lg transition"
                                   title="Edit product">
                                    ✏️
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-16 text-center">
                            <div class="text-4xl mb-3">📦</div>
                            <p class="font-semibold text-slate-600">No products found</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($products->count())
            <div class="px-5 py-4 border-t border-slate-100 bg-slate-50 flex flex-wrap items-center justify-between gap-3">
                <p class="text-xs text-slate-500">Edit the quantity boxes above then click "Save All Changes"</p>
                <button type="submit"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition">
                    💾 Save All Changes
                </button>
            </div>
        @endif
    </div>
</form>

<div class="mt-4">{{ $products->withQueryString()->links() }}</div>

@endsection