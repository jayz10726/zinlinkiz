@extends('layouts.app')
@section('title', 'All Products — zinlinktech Kenya')

@section('content')

{{-- Page Header --}}
<section class="bg-slate-900 text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <nav class="text-xs text-slate-500 mb-3 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-slate-300 transition">Home</a>
            <span>›</span>
            <span class="text-slate-300">
                {{ request('category') ? request('category') : 'All Products' }}
            </span>
        </nav>
        <h1 class="font-display font-bold text-3xl md:text-4xl">
            {{ request('category') ? request('category') : 'All Products' }}
        </h1>
        <p class="text-slate-400 mt-2 text-sm">{{ $products->total() }} products found</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- ── SIDEBAR FILTERS ── --}}
        <aside class="w-full lg:w-64 flex-shrink-0">
            <form method="GET" action="{{ route('products') }}" id="filter-form">

                {{-- Search --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-4">
                    <h3 class="font-display font-bold text-slate-800 text-sm uppercase tracking-widest mb-3">Search</h3>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search products..."
                               class="w-full border border-slate-300 rounded-xl pl-9 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>

                {{-- Categories --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-4">
                    <h3 class="font-display font-bold text-slate-800 text-sm uppercase tracking-widest mb-3">Category</h3>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2.5 cursor-pointer group">
                            <input type="radio" name="category" value=""
                                   {{ !request('category') ? 'checked' : '' }}
                                   onchange="document.getElementById('filter-form').submit()"
                                   class="w-4 h-4 text-blue-600 border-slate-300">
                            <span class="text-sm text-slate-600 group-hover:text-slate-900 transition font-medium">All Products</span>
                        </label>
                        @foreach($categories as $cat)
                            <label class="flex items-center gap-2.5 cursor-pointer group">
                                <input type="radio" name="category" value="{{ $cat }}"
                                       {{ request('category') == $cat ? 'checked' : '' }}
                                       onchange="document.getElementById('filter-form').submit()"
                                       class="w-4 h-4 text-blue-600 border-slate-300">
                                <span class="text-sm text-slate-600 group-hover:text-slate-900 transition font-medium">{{ $cat }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Sort --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-4">
                    <h3 class="font-display font-bold text-slate-800 text-sm uppercase tracking-widest mb-3">Sort By</h3>
                    <div class="space-y-2">
                        @foreach([
                            '' => 'Latest First',
                            'price_asc' => 'Price: Low to High',
                            'price_desc' => 'Price: High to Low',
                        ] as $val => $label)
                            <label class="flex items-center gap-2.5 cursor-pointer group">
                                <input type="radio" name="sort" value="{{ $val }}"
                                       {{ request('sort', '') == $val ? 'checked' : '' }}
                                       onchange="document.getElementById('filter-form').submit()"
                                       class="w-4 h-4 text-blue-600 border-slate-300">
                                <span class="text-sm text-slate-600 group-hover:text-slate-900 transition">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Apply / Reset --}}
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-xl text-sm font-bold transition mb-2">
                    Apply Filters
                </button>
                <a href="{{ route('products') }}"
                   class="block w-full text-center border border-slate-300 hover:bg-slate-50 text-slate-600 py-2.5 rounded-xl text-sm font-semibold transition">
                    Reset All
                </a>
            </form>
        </aside>

        {{-- ── PRODUCTS GRID ── --}}
        <div class="flex-1 min-w-0">

            {{-- Active filters bar --}}
            @if(request('search') || request('category') || request('sort'))
                <div class="flex flex-wrap items-center gap-2 mb-5 bg-blue-50 border border-blue-100 rounded-xl px-4 py-2.5">
                    <span class="text-xs font-bold text-blue-700">Active filters:</span>
                    @if(request('category'))
                        <span class="inline-flex items-center gap-1 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                            {{ request('category') }}
                            <a href="{{ route('products', array_merge(request()->except('category'))) }}" class="hover:text-blue-200">✕</a>
                        </span>
                    @endif
                    @if(request('search'))
                        <span class="inline-flex items-center gap-1 bg-blue-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                            "{{ request('search') }}"
                            <a href="{{ route('products', array_merge(request()->except('search'))) }}" class="hover:text-blue-200">✕</a>
                        </span>
                    @endif
                    @if(request('sort'))
                        <span class="inline-flex items-center gap-1 bg-slate-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                            {{ request('sort') == 'price_asc' ? '↑ Price' : '↓ Price' }}
                            <a href="{{ route('products', array_merge(request()->except('sort'))) }}" class="hover:text-slate-200">✕</a>
                        </span>
                    @endif
                </div>
            @endif

            @if($products->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                    @foreach($products as $product)
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden group flex flex-col">

                            {{-- Image --}}
                            <a href="{{ route('product.show', $product->id) }}" class="relative block">
                                <div class="bg-slate-50 h-48 flex items-center justify-center overflow-hidden">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             alt="{{ $product->name }}"
                                             class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="text-slate-200 flex flex-col items-center gap-2">
                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                      d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-xs text-slate-300">No image</span>
                                        </div>
                                    @endif
                                </div>
                                {{-- Badges --}}
                                <div class="absolute top-3 left-3 flex flex-col gap-1">
                                    @if($product->featured)
                                        <span class="bg-amber-400 text-slate-900 text-xs font-bold px-2 py-0.5 rounded-full">⭐ Featured</span>
                                    @endif
                                </div>
                                @if($product->stock === 0)
                                    <div class="absolute inset-0 bg-white/60 flex items-center justify-center">
                                        <span class="bg-red-500 text-white text-sm font-bold px-4 py-1.5 rounded-full">Out of Stock</span>
                                    </div>
                                @elseif($product->stock <= 5)
                                    <span class="absolute top-3 right-3 bg-orange-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">Low Stock</span>
                                @endif
                            </a>

                            {{-- Info --}}
                            <div class="p-4 flex flex-col flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-xs text-blue-600 font-bold uppercase tracking-wide">{{ $product->category }}</span>
                                    @if($product->brand)
                                        <span class="text-xs text-slate-400">{{ $product->brand }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('product.show', $product->id) }}">
                                    <h3 class="font-semibold text-slate-900 text-sm leading-snug mb-1 hover:text-blue-600 transition line-clamp-2">{{ $product->name }}</h3>
                                </a>
                                @if($product->specs)
                                    <p class="text-xs text-slate-400 mb-3 line-clamp-1">{{ $product->specs }}</p>
                                @endif

                                {{-- Stars --}}
                                <div class="flex items-center gap-0.5 mb-3">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-3 h-3 text-amber-400 fill-amber-400" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                    <span class="text-xs text-slate-400 ml-1">({{ rand(5,99) }})</span>
                                </div>

                                <div class="mt-auto flex items-center justify-between pt-3 border-t border-slate-100">
                                    <span class="font-display font-bold text-slate-900 text-base">KES {{ number_format($product->price) }}</span>
                                    @if($product->stock > 0)
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit"
                                                    class="flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-3.5 py-2 rounded-xl transition shadow-sm shadow-blue-500/20">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                                Add
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-red-500 font-semibold">Sold Out</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-10">
                    {{ $products->withQueryString()->links() }}
                </div>

            @else
                {{-- Empty State --}}
                <div class="flex flex-col items-center justify-center py-24 bg-white rounded-2xl border border-slate-100 shadow-sm">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-5 text-4xl">🔍</div>
                    <h3 class="font-display font-bold text-xl text-slate-800 mb-2">No products found</h3>
                    <p class="text-slate-500 text-sm text-center max-w-sm mb-6">
                        We couldn't find any products matching your search. Try different keywords or browse all products.
                    </p>
                    <a href="{{ route('products') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition">
                        Clear Filters
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection