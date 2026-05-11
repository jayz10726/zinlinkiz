@extends('layouts.app')
@section('title', 'My Cart — zinlinktech Kenya')

@section('content')

<div class="bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="text-xs text-slate-500 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
            <span>›</span>
            <span class="text-slate-700 font-medium">My Cart</span>
        </nav>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 py-10">

    <h1 class="font-display font-bold text-3xl text-slate-900 mb-8 flex items-center gap-3">
        🛒 My Cart
        @if(!empty($cart))
            <span class="bg-blue-600 text-white text-sm font-bold px-3 py-1 rounded-full">{{ count($cart) }} item{{ count($cart) != 1 ? 's' : '' }}</span>
        @endif
    </h1>

    @if(empty($cart))
        {{-- Empty cart --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm text-center py-20 px-6">
            <div class="text-6xl mb-5">🛒</div>
            <h2 class="font-display font-bold text-2xl text-slate-800 mb-2">Your cart is empty</h2>
            <p class="text-slate-500 mb-8">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('products') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition shadow-lg shadow-blue-500/25">
                Browse Products
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ── CART ITEMS ── --}}
            <div class="lg:col-span-2 space-y-3">
                @foreach($cart as $id => $item)
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 flex items-center gap-4 hover:shadow-md transition">
                        {{-- Image --}}
                        <div class="w-20 h-20 bg-slate-50 rounded-xl overflow-hidden flex-shrink-0 border border-slate-100">
                            @if($item['image'])
                                <img src="{{ asset('storage/' . $item['image']) }}"
                                     alt="{{ $item['name'] }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Details --}}
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-slate-900 text-sm leading-snug truncate">{{ $item['name'] }}</h3>
                            <p class="text-blue-600 font-bold text-sm mt-0.5">KES {{ number_format($item['price']) }}</p>
                            <p class="text-slate-400 text-xs mt-0.5">Subtotal: KES {{ number_format($item['price'] * $item['quantity']) }}</p>
                        </div>

                        {{-- Qty control --}}
                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center border border-slate-200 rounded-xl overflow-hidden flex-shrink-0">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <button type="button"
                                    onclick="let i=this.nextElementSibling; if(i.value>1){i.value=parseInt(i.value)-1; i.closest('form').submit();}"
                                    class="w-8 h-9 flex items-center justify-center text-slate-500 hover:bg-slate-50 transition font-bold">−</button>
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                   class="w-10 h-9 text-center text-sm font-bold border-x border-slate-200 focus:outline-none bg-white"
                                   onchange="this.closest('form').submit()">
                            <button type="button"
                                    onclick="let i=this.previousElementSibling; i.value=parseInt(i.value)+1; i.closest('form').submit();"
                                    class="w-8 h-9 flex items-center justify-center text-slate-500 hover:bg-slate-50 transition font-bold">+</button>
                        </form>

                        {{-- Remove --}}
                        <a href="{{ route('cart.remove', $id) }}"
                           class="w-8 h-8 flex-shrink-0 flex items-center justify-center rounded-xl text-slate-400 hover:text-red-500 hover:bg-red-50 transition"
                           title="Remove">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    </div>
                @endforeach

                {{-- Cart actions --}}
                <div class="flex items-center justify-between pt-3">
                    <a href="{{ route('products') }}"
                       class="flex items-center gap-2 text-blue-600 hover:text-blue-700 font-semibold text-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Continue Shopping
                    </a>
                    <a href="{{ route('cart.clear') }}"
                       class="text-red-400 hover:text-red-600 font-semibold text-sm transition flex items-center gap-1"
                       onclick="return confirm('Clear all items from cart?')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Clear Cart
                    </a>
                </div>
            </div>

            {{-- ── ORDER SUMMARY ── --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sticky top-24">
                    <h2 class="font-display font-bold text-xl text-slate-900 mb-5 pb-4 border-b border-slate-100">Order Summary</h2>

                    <div class="space-y-3 text-sm mb-5">
                        @foreach($cart as $item)
                            <div class="flex justify-between text-slate-600">
                                <span class="truncate max-w-[180px]">{{ $item['name'] }} <span class="text-slate-400">×{{ $item['quantity'] }}</span></span>
                                <span class="font-medium ml-2 flex-shrink-0">KES {{ number_format($item['price'] * $item['quantity']) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-2 text-sm border-t border-slate-100 pt-4 mb-5">
                        <div class="flex justify-between text-slate-600">
                            <span>Subtotal</span>
                            <span class="font-semibold">KES {{ number_format($total) }}</span>
                        </div>
                        <div class="flex justify-between text-slate-600">
                            <span>Shipping</span>
                            <span class="font-semibold {{ $total > 50000 ? 'text-emerald-600' : '' }}">
                                {{ $total > 50000 ? 'FREE 🎉' : 'KES 500' }}
                            </span>
                        </div>
                        <div class="flex justify-between font-bold text-slate-900 text-base pt-3 border-t border-slate-100">
                            <span>Total</span>
                            <span class="text-blue-600 font-display text-xl">KES {{ number_format($total > 50000 ? $total : $total + 500) }}</span>
                        </div>
                    </div>

                    @if($total < 50000)
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-3 mb-5 text-xs text-blue-700 text-center">
                            Add <strong>KES {{ number_format(50000 - $total) }}</strong> more for free delivery!
                        </div>
                    @else
                        <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-3 mb-5 text-xs text-emerald-700 text-center font-semibold">
                            🎉 You qualify for FREE delivery!
                        </div>
                    @endif

                    <a href="{{ route('checkout') }}"
                       class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3.5 rounded-xl font-bold transition shadow-lg shadow-blue-500/25 text-sm">
                        Proceed to Checkout →
                    </a>

                    <div class="mt-4 pt-4 border-t border-slate-100 text-center">
                        <p class="text-xs text-slate-400 mb-2">Secure payment via</p>
                        <div class="flex items-center justify-center gap-2">
                            <span class="bg-slate-100 text-slate-600 text-xs font-mono font-bold px-2 py-1 rounded">M-PESA</span>
                            <span class="bg-slate-100 text-slate-600 text-xs font-mono font-bold px-2 py-1 rounded">VISA</span>
                            <span class="bg-slate-100 text-slate-600 text-xs font-mono font-bold px-2 py-1 rounded">BANK</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection