@extends('layouts.app')
@section('title', 'Order ' . $order->order_number . ' — zinlinktech')

@section('content')

<div class="bg-slate-50 border-b border-slate-200">
    <div class="max-w-5xl mx-auto px-4 py-3">
        <nav class="text-xs text-slate-500 flex items-center gap-2 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
            <span>›</span>
            <a href="{{ route('customer.dashboard') }}" class="hover:text-blue-600 transition">My Orders</a>
            <span>›</span>
            <span class="text-slate-700 font-mono font-bold">{{ $order->order_number }}</span>
        </nav>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 py-10">

    @php
        $colors = ['pending'=>'amber','confirmed'=>'blue','processing'=>'indigo','shipped'=>'purple','delivered'=>'emerald','cancelled'=>'red'];
        $c = $colors[$order->status] ?? 'slate';
        $icons = ['pending'=>'⏳','confirmed'=>'✅','processing'=>'⚙️','shipped'=>'🚚','delivered'=>'🎉','cancelled'=>'❌'];
        $allStatuses = ['pending','confirmed','processing','shipped','delivered'];
        $currentIdx = array_search($order->status, $allStatuses);
    @endphp

    {{-- Header --}}
    <div class="flex items-start justify-between flex-wrap gap-4 mb-7">
        <div>
            <h1 class="font-display font-bold text-2xl text-slate-900 mb-1">Order Tracking</h1>
            <p class="font-mono text-blue-600 font-bold text-lg">{{ $order->order_number }}</p>
            <p class="text-slate-400 text-sm mt-0.5">Placed {{ $order->created_at->format('d F Y \a\t H:i') }}</p>
        </div>
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold border
                     bg-{{ $c }}-100 text-{{ $c }}-800 border-{{ $c }}-200">
            {{ $icons[$order->status] ?? '📦' }} {{ ucfirst($order->status) }}
        </span>
    </div>

    {{-- Progress Timeline --}}
    @if($order->status !== 'cancelled')
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-7 mb-6">
        <h2 class="font-display font-bold text-base text-slate-900 mb-6">Order Progress</h2>
        <div class="flex items-start overflow-x-auto pb-2">
            @foreach($allStatuses as $i => $s)
                @php
                    $done    = $currentIdx !== false && $i <= $currentIdx;
                    $current = $order->status === $s;
                    $labels  = ['pending'=>'Order Placed','confirmed'=>'Confirmed','processing'=>'Processing','shipped'=>'Shipped','delivered'=>'Delivered'];
                    $stepIcons = ['pending'=>'📋','confirmed'=>'✅','processing'=>'⚙️','shipped'=>'🚚','delivered'=>'🎉'];
                @endphp
                <div class="flex items-center flex-1 min-w-0">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0 transition-all
                                    {{ $done ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/30' : 'bg-slate-100 text-slate-400' }}
                                    {{ $current ? 'ring-4 ring-emerald-200' : '' }}">
                            {{ $done ? '✓' : ($stepIcons[$s] ?? ($i+1)) }}
                        </div>
                        <p class="text-xs font-semibold mt-2 whitespace-nowrap {{ $done ? 'text-emerald-600' : 'text-slate-400' }}">
                            {{ $labels[$s] ?? ucfirst($s) }}
                        </p>
                        @if($current)
                            <span class="text-xs text-emerald-500 font-bold animate-pulse">← Now</span>
                        @endif
                    </div>
                    @if($i < count($allStatuses) - 1)
                        <div class="flex-1 h-0.5 mx-2 mb-5
                                    {{ $currentIdx !== false && $i < $currentIdx ? 'bg-emerald-500' : 'bg-slate-200' }}">
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Order Items + Tracking History --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Items --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h2 class="font-display font-bold text-base text-slate-900">Items Ordered</h2>
                </div>
                <div class="divide-y divide-slate-100">
                    @foreach($order->items as $item)
                        <div class="px-6 py-4 flex items-center gap-4">
                            <div class="w-12 h-12 bg-slate-100 rounded-xl overflow-hidden flex-shrink-0">
                                @if($item->product && $item->product->image)
                                    <img src="{{ asset('storage/'.$item->product->image) }}" class="w-full h-full object-cover" alt="">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">💻</div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-900 text-sm">{{ $item->product_name }}</p>
                                <p class="text-slate-400 text-xs">Qty: {{ $item->quantity }} × KES {{ number_format($item->product_price) }}</p>
                            </div>
                            <p class="font-bold text-slate-900 text-sm flex-shrink-0">KES {{ number_format($item->subtotal) }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 space-y-1.5 text-sm">
                    <div class="flex justify-between text-slate-600"><span>Subtotal</span><span>KES {{ number_format($order->subtotal) }}</span></div>
                    <div class="flex justify-between text-slate-600">
                        <span>Shipping</span>
                        <span class="{{ $order->shipping == 0 ? 'text-emerald-600 font-semibold' : '' }}">{{ $order->shipping == 0 ? 'FREE' : 'KES '.number_format($order->shipping) }}</span>
                    </div>
                    <div class="flex justify-between font-bold text-slate-900 text-base pt-2 border-t border-slate-200">
                        <span>Total</span>
                        <span class="text-blue-600">KES {{ number_format($order->total) }}</span>
                    </div>
                </div>
            </div>

            {{-- Tracking History --}}
            @if($order->trackings->count())
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h2 class="font-display font-bold text-base text-slate-900">Tracking History</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-5">
                        @foreach($order->trackings as $i => $track)
                            @php
                                $tc = $colors[$track->status] ?? 'slate';
                            @endphp
                            <div class="flex items-start gap-4">
                                <div class="flex flex-col items-center">
                                    <div class="w-9 h-9 rounded-full bg-{{ $tc }}-100 flex items-center justify-center text-sm flex-shrink-0">
                                        {{ $icons[$track->status] ?? '📦' }}
                                    </div>
                                    @if(!$loop->last)
                                        <div class="w-px flex-1 bg-slate-200 my-1" style="min-height: 24px;"></div>
                                    @endif
                                </div>
                                <div class="flex-1 pb-1">
                                    <div class="flex items-center justify-between flex-wrap gap-2">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-{{ $tc }}-100 text-{{ $tc }}-800">
                                            {{ ucfirst($track->status) }}
                                        </span>
                                        <span class="text-xs text-slate-400">{{ $track->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                    @if($track->note)
                                        <p class="text-slate-600 text-sm mt-1.5">{{ $track->note }}</p>
                                    @endif
                                    @if($track->updated_by)
                                        <p class="text-slate-400 text-xs mt-0.5">Updated by: {{ $track->updated_by }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- Delivery Info --}}
        <div class="space-y-5">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h2 class="font-display font-bold text-base text-slate-900 mb-4 pb-3 border-b border-slate-100">Delivery Details</h2>
                <div class="space-y-3 text-sm">
                    <div><p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-0.5">Name</p><p class="font-semibold text-slate-900">{{ $order->customer_name }}</p></div>
                    <div><p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-0.5">Phone</p><p class="text-slate-700">{{ $order->customer_phone }}</p></div>
                    <div><p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-0.5">Address</p><p class="text-slate-700">{{ $order->customer_address }}, {{ $order->city }}</p></div>
                    <div><p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-0.5">Payment</p>
                        <span class="bg-slate-100 text-slate-700 text-xs font-bold px-2.5 py-1 rounded-full capitalize">{{ str_replace('_',' ',$order->payment_method) }}</span>
                    </div>
                </div>
            </div>

            {{-- Need help? --}}
            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 text-center">
                <p class="text-2xl mb-2">💬</p>
                <p class="font-bold text-slate-800 text-sm mb-1">Need help with this order?</p>
                <p class="text-slate-500 text-xs mb-4">WhatsApp us with your order number and we'll assist you immediately.</p>
                <a href="https://wa.me/254700000000?text=Hi!%20I%20need%20help%20with%20order%20{{ $order->order_number }}"
                   target="_blank"
                   class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition w-full justify-center">
                    WhatsApp Support
                </a>
            </div>

            <a href="{{ route('customer.dashboard') }}"
               class="flex items-center justify-center gap-2 border border-slate-300 text-slate-600 hover:bg-slate-50 px-5 py-3 rounded-xl text-sm font-semibold transition">
                ← Back to My Orders
            </a>
        </div>
    </div>
</div>

@endsection