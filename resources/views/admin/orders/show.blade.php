@extends('layouts.admin')
@section('title', 'Order ' . $order->order_number . ' — Admin')
@section('page-title', 'Order Details')
@section('page-subtitle', $order->order_number . ' · Placed ' . $order->created_at->format('d M Y \a\t H:i'))

@section('content')

@php
$statusColors = [
    'pending'    => 'bg-amber-100 text-amber-800 border-amber-200',
    'confirmed'  => 'bg-blue-100 text-blue-800 border-blue-200',
    'processing' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
    'shipped'    => 'bg-purple-100 text-purple-800 border-purple-200',
    'delivered'  => 'bg-emerald-100 text-emerald-800 border-emerald-200',
    'cancelled'  => 'bg-red-100 text-red-800 border-red-200',
];
$statusIcons = [
    'pending'=>'⏳','confirmed'=>'✅','processing'=>'⚙️',
    'shipped'=>'🚚','delivered'=>'🎉','cancelled'=>'❌',
];
$cls = $statusColors[$order->status] ?? 'bg-slate-100 text-slate-700 border-slate-200';
@endphp

{{-- Breadcrumb + status --}}
<div class="flex flex-wrap items-center gap-3 mb-6">
    <a href="{{ route('admin.orders') }}"
       class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-800 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        All Orders
    </a>
    <span class="text-slate-300">›</span>
    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-bold border {{ $cls }}">
        {{ $statusIcons[$order->status] ?? '📦' }} {{ ucfirst($order->status) }}
    </span>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- ── LEFT ── --}}
    <div class="xl:col-span-2 space-y-5">

        {{-- Order Items --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h2 class="font-display font-bold text-lg text-slate-900">Order Items</h2>
                <span class="text-sm text-slate-400">{{ $order->items->count() }} item(s)</span>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-bold text-slate-400 uppercase">Product</th>
                        <th class="px-5 py-3 text-right text-xs font-bold text-slate-400 uppercase">Unit Price</th>
                        <th class="px-5 py-3 text-right text-xs font-bold text-slate-400 uppercase">Qty</th>
                        <th class="px-5 py-3 text-right text-xs font-bold text-slate-400 uppercase">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($order->items as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 bg-slate-100 rounded-xl overflow-hidden flex-shrink-0">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ asset('storage/'.$item->product->image) }}"
                                                 class="w-full h-full object-cover" alt="">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-300 text-xs">💻</div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900 text-sm">{{ $item->product_name }}</p>
                                        @if($item->product)
                                            <a href="{{ route('admin.products.edit', $item->product->id) }}"
                                               class="text-xs text-blue-500 hover:underline">Edit product ↗</a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-right text-slate-600">KES {{ number_format($item->product_price) }}</td>
                            <td class="px-5 py-4 text-right font-bold text-slate-800">{{ $item->quantity }}</td>
                            <td class="px-5 py-4 text-right font-bold text-slate-900">KES {{ number_format($item->subtotal) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-t border-slate-200 bg-slate-50">
                    <tr>
                        <td colspan="3" class="px-5 py-3 text-right text-sm font-semibold text-slate-600">Subtotal</td>
                        <td class="px-5 py-3 text-right font-bold text-slate-900">KES {{ number_format($order->subtotal) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-5 py-3 text-right text-sm font-semibold text-slate-600">Shipping</td>
                        <td class="px-5 py-3 text-right font-bold {{ $order->shipping == 0 ? 'text-emerald-600' : 'text-slate-900' }}">
                            {{ $order->shipping == 0 ? 'FREE' : 'KES '.number_format($order->shipping) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="px-5 py-4 text-right font-bold text-slate-900 text-base">Total</td>
                        <td class="px-5 py-4 text-right font-display font-bold text-blue-600 text-xl">
                            KES {{ number_format($order->total) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Update Status --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-display font-bold text-lg text-slate-900 mb-4">Update Order Status</h2>

            {{-- Progress bar --}}
            @php
                $allStatuses = ['pending','confirmed','processing','shipped','delivered'];
                $currentIdx  = array_search($order->status, $allStatuses);
            @endphp
            @if($order->status !== 'cancelled')
                <div class="flex items-center mb-6 overflow-x-auto pb-2">
                    @foreach($allStatuses as $i => $s)
                        @php $done = $currentIdx !== false && $i <= $currentIdx; @endphp
                        <div class="flex items-center">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0
                                            {{ $done ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-400' }}">
                                    {{ $done ? '✓' : ($i+1) }}
                                </div>
                                <p class="text-xs mt-1.5 capitalize whitespace-nowrap {{ $done ? 'text-emerald-600 font-semibold' : 'text-slate-400' }}">
                                    {{ $s }}
                                </p>
                            </div>
                            @if($i < count($allStatuses)-1)
                                <div class="w-10 sm:w-16 h-0.5 mx-1 mb-5
                                            {{ $currentIdx !== false && $i < $currentIdx ? 'bg-emerald-500' : 'bg-slate-200' }}">
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-red-50 border border-red-200 rounded-xl p-3 mb-5">
                    <p class="text-red-700 text-sm font-semibold">❌ This order has been cancelled.</p>
                </div>
            @endif

            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="space-y-3">
                @csrf
                <div class="flex flex-col sm:flex-row gap-3">
                    <select name="status"
                            class="flex-1 border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach(['pending','confirmed','processing','shipped','delivered','cancelled'] as $s)
                            <option value="{{ $s }}" {{ $order->status == $s ? 'selected' : '' }}>
                                {{ $statusIcons[$s] ?? '' }} {{ ucfirst($s) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-7 py-3 rounded-xl font-bold text-sm transition shadow-lg shadow-blue-500/20 whitespace-nowrap">
                        Update Status
                    </button>
                </div>
                <div>
                    <input type="text" name="note" placeholder="Optional note (e.g. 'Dispatched via G4S, tracking #12345')"
                           class="w-full border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </form>

            @if($order->notes)
                <div class="mt-4 bg-amber-50 border border-amber-100 rounded-xl p-4">
                    <p class="text-xs font-bold text-amber-700 mb-1">📝 Customer Note</p>
                    <p class="text-sm text-amber-800">{{ $order->notes }}</p>
                </div>
            @endif
        </div>

        {{-- Tracking History --}}
        @if(isset($order->trackings) && $order->trackings->count() > 0)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h2 class="font-display font-bold text-lg text-slate-900">Tracking History</h2>
            </div>
            <div class="p-6 space-y-4">
                @foreach($order->trackings as $track)
                    @php $tc = $statusColors[$track->status] ?? 'bg-slate-100 text-slate-700 border-slate-200'; @endphp
                    <div class="flex items-start gap-4">
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm flex-shrink-0 border {{ $tc }}">
                            {{ $statusIcons[$track->status] ?? '📦' }}
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between flex-wrap gap-2 mb-0.5">
                                <span class="text-sm font-bold text-slate-800">{{ ucfirst($track->status) }}</span>
                                <span class="text-xs text-slate-400">{{ $track->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            @if($track->note)
                                <p class="text-slate-600 text-sm">{{ $track->note }}</p>
                            @endif
                            @if($track->updated_by)
                                <p class="text-xs text-slate-400 mt-0.5">By: {{ $track->updated_by }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    {{-- ── RIGHT ── --}}
    <div class="space-y-5">

        {{-- Order summary --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-display font-bold text-lg text-slate-900 mb-4 pb-3 border-b border-slate-100">Order Summary</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-slate-500">Order #</span>
                    <span class="font-mono font-bold text-slate-900 text-xs">{{ $order->order_number }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Date</span>
                    <span class="font-medium text-slate-900 text-xs">{{ $order->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Items</span>
                    <span class="font-medium text-slate-900">{{ $order->items->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Subtotal</span>
                    <span class="font-medium">KES {{ number_format($order->subtotal) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Shipping</span>
                    <span class="font-medium {{ $order->shipping == 0 ? 'text-emerald-600' : '' }}">
                        {{ $order->shipping == 0 ? 'FREE' : 'KES '.number_format($order->shipping) }}
                    </span>
                </div>
                <div class="flex justify-between pt-3 border-t border-slate-100">
                    <span class="font-bold text-slate-900">Total</span>
                    <span class="font-display font-bold text-blue-600 text-lg">KES {{ number_format($order->total) }}</span>
                </div>
            </div>
        </div>

        {{-- Customer details --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-display font-bold text-lg text-slate-900 mb-4 pb-3 border-b border-slate-100">Customer</h2>
            <div class="space-y-3 text-sm">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-0.5">Name</p>
                    <p class="font-semibold text-slate-900">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-0.5">Email</p>
                    <a href="mailto:{{ $order->customer_email }}" class="text-blue-600 hover:underline text-sm">{{ $order->customer_email }}</a>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-0.5">Phone</p>
                    <div class="flex items-center gap-2 flex-wrap">
                        <a href="tel:{{ $order->customer_phone }}" class="text-blue-600 hover:underline font-medium">{{ $order->customer_phone }}</a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$order->customer_phone) }}?text=Hi%20{{ urlencode($order->customer_name) }}%2C%20regarding%20your%20zinlinktech%20order%20{{ $order->order_number }}"
                           target="_blank"
                           class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2 py-1 rounded-full hover:bg-emerald-200 transition">
                            💬 WhatsApp
                        </a>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-0.5">Delivery Address</p>
                    <p class="text-slate-700">{{ $order->customer_address }}</p>
                    <p class="text-slate-700 font-semibold">{{ $order->city }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-0.5">Payment Method</p>
                    <span class="bg-slate-100 text-slate-800 font-bold text-xs px-3 py-1.5 rounded-full capitalize">
                        {{ str_replace('_',' ',$order->payment_method) }}
                    </span>
                </div>
                @if($order->user)
                    <div class="pt-2 border-t border-slate-100">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-0.5">Registered Customer</p>
                        <p class="text-emerald-600 text-xs font-semibold">✅ Has account — can track order online</p>
                    </div>
                @else
                    <div class="pt-2 border-t border-slate-100">
                        <p class="text-xs text-slate-400">Guest checkout — no account</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection