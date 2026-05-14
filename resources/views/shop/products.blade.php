@extends('layouts.app')
@section('title', 'All Products — zinlinktech Kenya')

@section('content')

@php
    use Illuminate\Support\Arr;
@endphp

{{-- Breadcrumb --}}
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="text-xs text-gray-400 flex items-center gap-1.5">
            <a href="{{ route('home') }}" class="hover:text-blue-500 transition">
                Home
            </a>

            <span>/</span>

            <span class="text-gray-600 font-medium">
                {{ request('category') ?: 'All Products' }}
            </span>
        </nav>
    </div>
</div>

{{-- MOBILE FILTER OVERLAY --}}
<div id="filter-overlay"
     class="fixed inset-0 bg-black/50 z-50 hidden lg:hidden"
     onclick="closeFilters()"
     aria-hidden="true"></div>

{{-- MOBILE FILTER DRAWER --}}
<aside id="filter-drawer"
       class="fixed top-0 left-0 h-full w-72 bg-white z-50 shadow-2xl overflow-y-auto
              transform -translate-x-full transition-transform duration-300 ease-in-out lg:hidden">

    {{-- Drawer Header --}}
    <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200 sticky top-0 bg-white z-10">

        <h2 class="font-bold text-gray-800 text-base">
            Filters
        </h2>

        <button onclick="closeFilters()"
                class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <div class="p-4 space-y-4">

        {{-- Search --}}
        <div>

            <p class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">
                Search
            </p>

            <form method="GET" action="{{ route('products') }}">

                @if(request('category'))
                    <input type="hidden"
                           name="category"
                           value="{{ request('category') }}">
                @endif

                @if(request('sort'))
                    <input type="hidden"
                           name="sort"
                           value="{{ request('sort') }}">
                @endif

                <div class="relative">

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search products..."
                           class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-orange-400 pr-9">

                    <button type="submit"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2">

                        <svg class="w-4 h-4 text-gray-400"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        {{-- Categories --}}
        <div>

            <p class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">
                Categories
            </p>

            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">

                <a href="{{ route('products') }}"
                   onclick="closeFilters()"
                   class="flex items-center justify-between px-3 py-2.5 text-sm hover:bg-orange-50 hover:text-orange-600 transition border-b border-gray-100
                   {{ !request('category') ? 'text-orange-600 bg-orange-50 font-semibold' : 'text-gray-600' }}">

                    <span>All Products</span>

                    <span class="text-gray-400 text-xs">
                        {{ \App\Models\Product::where('is_active', true)->count() }}
                    </span>
                </a>

                @foreach($categories as $cat)

                    <a href="{{ route('products', array_merge(request()->except('page'), ['category' => $cat])) }}"
                       onclick="closeFilters()"
                       class="flex items-center justify-between px-3 py-2.5 text-sm hover:bg-orange-50 hover:text-orange-600 transition border-b border-gray-100 last:border-0
                       {{ request('category') == $cat ? 'text-orange-600 bg-orange-50 font-semibold' : 'text-gray-600' }}">

                        <span>{{ $cat }}</span>

                        <span class="text-gray-400 text-xs">
                            {{ \App\Models\Product::where('is_active', true)->where('category', $cat)->count() }}
                        </span>
                    </a>

                @endforeach
            </div>
        </div>

        {{-- Sort --}}
        <div>

            <p class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">
                Sort By
            </p>

            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">

                @foreach([
                    '' => 'Latest First',
                    'price_asc' => 'Price: Low to High',
                    'price_desc' => 'Price: High to Low',
                ] as $val => $label)

                    <a href="{{ route('products', array_merge(request()->all(), ['sort' => $val])) }}"
                       onclick="closeFilters()"
                       class="flex items-center gap-2.5 px-3 py-2.5 text-sm hover:bg-orange-50 hover:text-orange-600 transition border-b border-gray-100 last:border-0
                       {{ request('sort', '') == $val ? 'text-orange-600 bg-orange-50 font-semibold' : 'text-gray-600' }}">

                        <span class="w-3.5 h-3.5 rounded-full border-2 flex-shrink-0
                        {{ request('sort', '') == $val ? 'border-orange-500 bg-orange-500' : 'border-gray-300' }}">
                        </span>

                        {{ $label }}
                    </a>

                @endforeach
            </div>
        </div>
    </div>
</aside>

{{-- MAIN LAYOUT --}}
<div class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto px-3 sm:px-4 py-3 sm:py-4">

        <div class="flex gap-3 sm:gap-4">

            {{-- DESKTOP SIDEBAR --}}
            <aside class="w-52 flex-shrink-0 hidden lg:block">

                {{-- Search --}}
                <div class="bg-white rounded border border-gray-200 p-3 mb-3">

                    <p class="text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">
                        Search
                    </p>

                    <form method="GET" action="{{ route('products') }}">

                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif

                        @if(request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif

                        <div class="relative">

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Search products..."
                                   class="w-full border border-gray-300 rounded px-2.5 py-2 text-xs focus:outline-none focus:border-orange-400 pr-7">

                            <button type="submit"
                                    class="absolute right-2 top-1/2 -translate-y-1/2">

                                <svg class="w-3.5 h-3.5 text-gray-400"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Categories --}}
                <div class="bg-white rounded border border-gray-200 mb-3 overflow-hidden">

                    <div class="bg-orange-500 px-3 py-2">

                        <p class="text-xs font-bold text-white uppercase tracking-wide">
                            Categories
                        </p>
                    </div>

                    <div class="divide-y divide-gray-100">

                        <a href="{{ route('products') }}"
                           class="flex items-center justify-between px-3 py-2.5 text-xs hover:bg-orange-50 hover:text-orange-600 transition
                           {{ !request('category') ? 'text-orange-600 bg-orange-50 font-semibold' : 'text-gray-600' }}">

                            <span>All Products</span>

                            <span class="text-gray-400 text-xs">
                                {{ \App\Models\Product::where('is_active', true)->count() }}
                            </span>
                        </a>

                        @foreach($categories as $cat)

                            <a href="{{ route('products', array_merge(request()->except('page'), ['category' => $cat])) }}"
                               class="flex items-center justify-between px-3 py-2.5 text-xs hover:bg-orange-50 hover:text-orange-600 transition
                               {{ request('category') == $cat ? 'text-orange-600 bg-orange-50 font-semibold' : 'text-gray-600' }}">

                                <span>{{ $cat }}</span>

                                <span class="text-gray-400 text-xs">
                                    {{ \App\Models\Product::where('is_active', true)->where('category', $cat)->count() }}
                                </span>
                            </a>

                        @endforeach
                    </div>
                </div>

                {{-- Sort --}}
                <div class="bg-white rounded border border-gray-200 overflow-hidden">

                    <div class="bg-orange-500 px-3 py-2">

                        <p class="text-xs font-bold text-white uppercase tracking-wide">
                            Sort By
                        </p>
                    </div>

                    <div class="divide-y divide-gray-100">

                        @foreach([
                            '' => 'Latest First',
                            'price_asc' => 'Price: Low to High',
                            'price_desc' => 'Price: High to Low',
                        ] as $val => $label)

                            <a href="{{ route('products', array_merge(request()->all(), ['sort' => $val])) }}"
                               class="flex items-center gap-2 px-3 py-2.5 text-xs hover:bg-orange-50 hover:text-orange-600 transition
                               {{ request('sort', '') == $val ? 'text-orange-600 bg-orange-50 font-semibold' : 'text-gray-600' }}">

                                <span class="w-3 h-3 rounded-full border
                                {{ request('sort', '') == $val ? 'border-orange-500 bg-orange-500' : 'border-gray-400' }}">
                                </span>

                                {{ $label }}
                            </a>

                        @endforeach
                    </div>
                </div>
            </aside>

            {{-- MAIN CONTENT --}}
            <div class="flex-1 min-w-0">

                {{-- Toolbar --}}
                <div class="bg-white rounded border border-gray-200 px-3 sm:px-4 py-2.5 mb-3 flex items-center justify-between gap-2 flex-wrap">

                    <div class="flex items-center gap-2 text-xs text-gray-500 flex-wrap">

                        <span class="font-semibold text-gray-800">
                            {{ $products->total() }}
                        </span>

                        <span>products</span>

                        @if(request('category'))

                            <span class="bg-orange-100 text-orange-700 font-semibold px-2 py-0.5 rounded">
                                {{ request('category') }}
                            </span>

                        @endif
                    </div>

                    <button onclick="openFilters()"
                            class="lg:hidden flex items-center gap-1.5 border border-gray-300 text-gray-600 px-3 py-1.5 rounded text-xs font-semibold">

                        Filters
                    </button>
                </div>

                {{-- Active Filter Pills --}}
                @if(request('category') || request('search'))

                    <div class="flex gap-2 mb-3 flex-wrap lg:hidden">

                        @if(request('category'))

                            <span class="inline-flex items-center gap-1 bg-orange-100 text-orange-700 text-xs font-semibold px-2.5 py-1 rounded-full">

                                {{ request('category') }}

                                <a href="{{ route('products', Arr::except(request()->all(), ['category'])) }}"
                                   class="ml-0.5 hover:text-orange-900">

                                    ×
                                </a>
                            </span>

                        @endif

                        @if(request('search'))

                            <span class="inline-flex items-center gap-1 bg-orange-100 text-orange-700 text-xs font-semibold px-2.5 py-1 rounded-full">

                                "{{ request('search') }}"

                                <a href="{{ route('products', Arr::except(request()->all(), ['search'])) }}"
                                   class="ml-0.5 hover:text-orange-900">

                                    ×
                                </a>
                            </span>

                        @endif
                    </div>

                @endif

                {{-- PRODUCTS GRID --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 sm:gap-2.5">

                    @foreach($products as $product)

                        <div class="bg-white rounded border border-gray-200 overflow-hidden flex flex-col">

                            <a href="{{ route('product.show', $product->id) }}"
                               class="block bg-white overflow-hidden"
                               style="height: clamp(120px, 35vw, 160px);">

                                @if($product->image)

                                    <img src="{{ asset('storage/'.$product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-contain p-2">

                                @endif
                            </a>

                            <div class="p-2 flex flex-col flex-1">

                                <a href="{{ route('product.show', $product->id) }}">

                                    <h3 class="text-xs text-gray-800 line-clamp-2 mb-2">
                                        {{ $product->name }}
                                    </h3>
                                </a>

                                <div class="mb-2">

                                    <span class="text-orange-600 font-bold text-sm">
                                        KES {{ number_format($product->price) }}
                                    </span>
                                </div>

                                <div class="flex-1"></div>

                                @if($product->stock > 0)

                                    <form action="{{ route('cart.add') }}" method="POST">

                                        @csrf

                                        <input type="hidden"
                                               name="product_id"
                                               value="{{ $product->id }}">

                                        <button type="submit"
                                                class="w-full bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold py-2 rounded transition">

                                            Add to Cart
                                        </button>
                                    </form>

                                @else

                                    <button disabled
                                            class="w-full bg-gray-200 text-gray-400 text-xs font-bold py-2 rounded">

                                        Unavailable
                                    </button>

                                @endif
                            </div>
                        </div>

                    @endforeach
                </div>

                {{-- PAGINATION --}}
                <div class="mt-4 bg-white rounded border border-gray-200 p-3 overflow-x-auto">

                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FILTER DRAWER JS --}}
<script>
    function openFilters() {
        document.getElementById('filter-drawer').style.transform = 'translateX(0)';
        document.getElementById('filter-overlay').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeFilters() {
        document.getElementById('filter-drawer').style.transform = 'translateX(-100%)';
        document.getElementById('filter-overlay').classList.add('hidden');
        document.body.style.overflow = '';
    }

    window.addEventListener('resize', function () {
        if (window.innerWidth >= 1024) {
            closeFilters();
        }
    });
</script>

@endsection