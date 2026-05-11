@extends('layouts.admin')
@section('title', 'Dashboard — zinlinktech Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome back, ' . auth()->user()->name . '!')

@section('content')

{{-- ── STAT CARDS ── --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-7">

    {{-- Revenue --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-50 rounded-full -translate-y-8 translate-x-8"></div>
        <div class="relative">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">Revenue</span>
            </div>
            <p class="font-display font-bold text-2xl text-slate-900 mb-0.5">KES {{ number_format($totalRevenue) }}</p>
            <p class="text-xs text-slate-400">From confirmed orders</p>
        </div>
    </div>

    {{-- Orders --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-full -translate-y-8 translate-x-8"></div>
        <div class="relative">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full hover:bg-blue-100 transition">View all</a>
            </div>
            <p class="font-display font-bold text-2xl text-slate-900 mb-0.5">{{ $totalOrders }}</p>
            <p class="text-xs text-slate-400">Total orders placed</p>
        </div>
    </div>

    {{-- Pending --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-24 h-24 bg-amber-50 rounded-full -translate-y-8 translate-x-8"></div>
        <div class="relative">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <a href="{{ route('admin.orders') }}?status=pending" class="text-xs font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full hover:bg-amber-100 transition">Attend to</a>
            </div>
            <p class="font-display font-bold text-2xl text-slate-900 mb-0.5">{{ $pendingOrders }}</p>
            <p class="text-xs text-slate-400">Pending orders</p>
        </div>
    </div>

    {{-- Products --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-24 h-24 bg-purple-50 rounded-full -translate-y-8 translate-x-8"></div>
        <div class="relative">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <a href="{{ route('admin.products') }}" class="text-xs font-bold text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full hover:bg-purple-100 transition">Manage</a>
            </div>
            <p class="font-display font-bold text-2xl text-slate-900 mb-0.5">{{ $totalProducts }}</p>
            <p class="text-xs text-slate-400">Products in catalogue</p>
        </div>
    </div>
</div>

{{-- ── ORDER STATUS BREAKDOWN ── --}}
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 mb-7">
    @php
    $statuses = [
        ['label'=>'Pending',    'key'=>'pending',    'bg'=>'bg-amber-50',   'text'=>'text-amber-700',   'border'=>'border-amber-200'],
        ['label'=>'Confirmed',  'key'=>'confirmed',  'bg'=>'bg-blue-50',    'text'=>'text-blue-700',    'border'=>'border-blue-200'],
        ['label'=>'Processing', 'key'=>'processing', 'bg'=>'bg-indigo-50',  'text'=>'text-indigo-700',  'border'=>'border-indigo-200'],
        ['label'=>'Shipped',    'key'=>'shipped',    'bg'=>'bg-purple-50',  'text'=>'text-purple-700',  'border'=>'border-purple-200'],
        ['label'=>'Delivered',  'key'=>'delivered',  'bg'=>'bg-emerald-50', 'text'=>'text-emerald-700', 'border'=>'border-emerald-200'],
        ['label'=>'Cancelled',  'key'=>'cancelled',  'bg'=>'bg-red-50',     'text'=>'text-red-700',     'border'=>'border-red-200'],
    ];
    @endphp
    @foreach($statuses as $s)
        <a href="{{ route('admin.orders') }}?status={{ $s['key'] }}"
           class="{{ $s['bg'] }} {{ $s['border'] }} border rounded-xl p-3 text-center hover:shadow-sm transition group">
            <p class="font-display font-bold text-xl {{ $s['text'] }}">{{ \App\Models\Order::where('status',$s['key'])->count() }}</p>
            <p class="text-xs {{ $s['text'] }} font-semibold mt-0.5">{{ $s['label'] }}</p>
        </a>
    @endforeach
</div>

{{-- ── MAIN CONTENT GRID ── --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- Recent Orders table --}}
    <div class="xl:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <h2 class="font-display font-bold text-lg text-slate-900">Recent Orders</h2>
            <a href="{{ route('admin.orders') }}" class="text-blue-600 text-xs font-bold hover:text-blue-700 transition">View all →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Order</th>
                        <th class="px-5 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Customer</th>
                        <th class="px-5 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Total</th>
                        <th class="px-5 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Date</th>
                        <th class="px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentOrders as $order)
                        @php
                            $colors = [
                                'pending'    => 'bg-amber-100 text-amber-800',
                                'confirmed'  => 'bg-blue-100 text-blue-800',
                                'processing' => 'bg-indigo-100 text-indigo-800',
                                'shipped'    => 'bg-purple-100 text-purple-800',
                                'delivered'  => 'bg-emerald-100 text-emerald-800',
                                'cancelled'  => 'bg-red-100 text-red-800',
                            ];
                            $cls = $colors[$order->status] ?? 'bg-slate-100 text-slate-700';
                        @endphp
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-5 py-3.5">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                   class="font-mono text-xs font-bold text-blue-600 hover:text-blue-700 transition">
                                    {{ $order->order_number }}
                                </a>
                            </td>
                            <td class="px-5 py-3.5">
                                <p class="font-medium text-slate-800 text-xs">{{ $order->customer_name }}</p>
                                <p class="text-slate-400 text-xs">{{ $order->customer_phone }}</p>
                            </td>
                            <td class="px-5 py-3.5 font-bold text-slate-900 text-xs">KES {{ number_format($order->total) }}</td>
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ $cls }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-xs text-slate-400">{{ $order->created_at->format('d M, H:i') }}</td>
                            <td class="px-5 py-3.5">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                   class="text-xs bg-slate-100 hover:bg-blue-100 hover:text-blue-700 text-slate-600 px-3 py-1.5 rounded-lg font-semibold transition">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-slate-400 text-sm">
                                No orders yet. When customers place orders, they appear here.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Right column --}}
    <div class="space-y-5">

        {{-- Quick actions --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <h2 class="font-display font-bold text-lg text-slate-900 mb-4">Quick Actions</h2>
            <div class="space-y-2">
                <a href="{{ route('admin.products.create') }}"
                   class="flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-xl text-sm font-bold transition shadow-sm shadow-blue-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New Product
                </a>
                <a href="{{ route('admin.orders') }}?status=pending"
                   class="flex items-center gap-3 bg-amber-50 hover:bg-amber-100 text-amber-800 px-4 py-3 rounded-xl text-sm font-bold transition border border-amber-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Process Pending Orders
                </a>
                <a href="{{ route('admin.products') }}"
                   class="flex items-center gap-3 bg-slate-50 hover:bg-slate-100 text-slate-700 px-4 py-3 rounded-xl text-sm font-bold transition border border-slate-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Manage Products
                </a>
            </div>
        </div>

        {{-- Low stock --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <h2 class="font-display font-bold text-lg text-slate-900">Low Stock Alert</h2>
                @if($lowStock->count() > 0)
                    <span class="bg-red-100 text-red-700 text-xs font-bold px-2 py-1 rounded-full">{{ $lowStock->count() }} items</span>
                @endif
            </div>
            <div class="p-4 space-y-3">
                @forelse($lowStock as $product)
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-8 h-8 bg-slate-100 rounded-lg overflow-hidden flex-shrink-0">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-cover" alt="">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-semibold text-slate-800 truncate">{{ $product->name }}</p>
                                <p class="text-xs text-slate-400">{{ $product->category }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <span class="{{ $product->stock === 0 ? 'bg-red-100 text-red-700' : 'bg-orange-100 text-orange-700' }} text-xs font-bold px-2 py-1 rounded-lg">
                                {{ $product->stock === 0 ? 'OUT' : $product->stock . ' left' }}
                            </span>
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="text-blue-600 hover:text-blue-700 text-xs font-bold">Edit</a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <p class="text-2xl mb-1">✅</p>
                        <p class="text-xs text-slate-500 font-medium">All products are well stocked!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection