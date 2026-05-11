@extends('layouts.admin')
@section('title', 'Orders — zinlinktech Admin')
@section('page-title', 'Orders')
@section('page-subtitle', 'View and manage all customer orders')

@section('content')

{{-- Status filter tabs --}}
<div class="flex items-center gap-2 mb-5 flex-wrap">
    <a href="{{ route('admin.orders') }}"
       class="px-4 py-2 rounded-xl text-sm font-bold transition {{ !request('status') ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/20' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
        All <span class="ml-1 text-xs opacity-70">{{ \App\Models\Order::count() }}</span>
    </a>
    @php
    $tabs = [
        'pending'    => ['label'=>'Pending',    'color'=>'amber'],
        'confirmed'  => ['label'=>'Confirmed',  'color'=>'blue'],
        'processing' => ['label'=>'Processing', 'color'=>'indigo'],
        'shipped'    => ['label'=>'Shipped',    'color'=>'purple'],
        'delivered'  => ['label'=>'Delivered',  'color'=>'emerald'],
        'cancelled'  => ['label'=>'Cancelled',  'color'=>'red'],
    ];
    @endphp
    @foreach($tabs as $key => $tab)
        @php $count = \App\Models\Order::where('status',$key)->count(); @endphp
        <a href="{{ route('admin.orders') }}?status={{ $key }}"
           class="px-4 py-2 rounded-xl text-sm font-bold transition {{ request('status') == $key ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/20' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
            {{ $tab['label'] }}
            @if($count > 0)
                <span class="ml-1 text-xs opacity-70">{{ $count }}</span>
            @endif
        </a>
    @endforeach
</div>

{{-- Search --}}
<form method="GET" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 mb-5 flex flex-wrap gap-3">
    @if(request('status'))
        <input type="hidden" name="status" value="{{ request('status') }}">
    @endif
    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="Search order number or customer name/email..."
           class="flex-1 min-w-56 border border-slate-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    <button type="submit" class="bg-slate-900 hover:bg-slate-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition">
        Search
    </button>
    <a href="{{ route('admin.orders') }}" class="border border-slate-300 text-slate-600 hover:bg-slate-50 px-4 py-2.5 rounded-xl text-sm font-semibold transition">
        Reset
    </a>
</form>

{{-- Orders table --}}
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 border-b border-slate-100">
            <tr>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Order #</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Customer</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider hidden md:table-cell">Items</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Total</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider hidden lg:table-cell">Payment</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider hidden md:table-cell">Date</th>
                <th class="px-5 py-3.5"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($orders as $order)
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
                <tr class="hover:bg-slate-50 transition group">
                    <td class="px-5 py-4">
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                           class="font-mono text-xs font-bold text-blue-600 hover:text-blue-700 transition">
                            {{ $order->order_number }}
                        </a>
                    </td>
                    <td class="px-5 py-4">
                        <p class="font-semibold text-slate-900 text-xs">{{ $order->customer_name }}</p>
                        <p class="text-slate-400 text-xs">{{ $order->customer_phone }}</p>
                        <p class="text-slate-400 text-xs hidden sm:block">{{ $order->city }}</p>
                    </td>
                    <td class="px-5 py-4 hidden md:table-cell text-slate-600 text-xs">{{ $order->items->count() }} item(s)</td>
                    <td class="px-5 py-4 font-bold text-slate-900 text-sm">KES {{ number_format($order->total) }}</td>
                    <td class="px-5 py-4 hidden lg:table-cell text-xs text-slate-500 capitalize">{{ str_replace('_',' ',$order->payment_method) }}</td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ $cls }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-5 py-4 hidden md:table-cell text-xs text-slate-400">{{ $order->created_at->format('d M Y') }}<br>{{ $order->created_at->format('H:i') }}</td>
                    <td class="px-5 py-4">
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                           class="bg-slate-100 hover:bg-blue-100 hover:text-blue-700 text-slate-600 px-3 py-1.5 rounded-lg text-xs font-bold transition whitespace-nowrap">
                            View →
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-5 py-16 text-center">
                        <div class="text-4xl mb-3">📭</div>
                        <p class="font-semibold text-slate-600 mb-1">No orders found</p>
                        <p class="text-slate-400 text-xs">Orders from customers will appear here</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="px-5 py-4 border-t border-slate-100">
        {{ $orders->withQueryString()->links() }}
    </div>
</div>

@endsection