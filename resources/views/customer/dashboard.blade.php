@extends('layouts.app')
@section('title', 'My Account — zinlinktech Kenya')

@section('content')

{{-- Header --}}
<section class="bg-slate-900 text-white py-10">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white text-xl font-display font-bold shadow-lg">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <div>
                <h1 class="font-display font-bold text-2xl">Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="text-slate-400 text-sm">{{ auth()->user()->email }} · Member since {{ auth()->user()->created_at->format('M Y') }}</p>
            </div>
        </div>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-7">

        {{-- Sidebar --}}
        <aside class="lg:col-span-1 space-y-3">
            <nav class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <a href="{{ route('customer.dashboard') }}"
                   class="flex items-center gap-3 px-5 py-3.5 text-sm font-semibold border-b border-slate-100
                          {{ request()->routeIs('customer.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50' }} transition">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    My Orders
                </a>
                <a href="#profile"
                   class="flex items-center gap-3 px-5 py-3.5 text-sm font-semibold border-b border-slate-100 text-slate-600 hover:bg-slate-50 transition">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Profile Settings
                </a>
                <a href="#password"
                   class="flex items-center gap-3 px-5 py-3.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Change Password
                </a>
            </nav>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Quick Stats</p>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-600">Total Orders</span>
                        <span class="font-bold text-slate-900">{{ $orders->total() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-600">Delivered</span>
                        <span class="font-bold text-emerald-600">
                            {{ $orders->getCollection()->where('status','delivered')->count() }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-600">Pending</span>
                        <span class="font-bold text-amber-600">
                            {{ $orders->getCollection()->whereIn('status',['pending','confirmed','processing','shipped'])->count() }}
                        </span>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 justify-center border border-red-200 text-red-500 hover:bg-red-50 px-5 py-3 rounded-2xl text-sm font-semibold transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sign Out
                </button>
            </form>
        </aside>

        {{-- Main Content --}}
        <div class="lg:col-span-3 space-y-6">

            {{-- Flash --}}
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Orders --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h2 class="font-display font-bold text-lg text-slate-900">My Orders</h2>
                    <a href="{{ route('products') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">+ Shop More</a>
                </div>

                @forelse($orders as $order)
                    @php
                        $colors = ['pending'=>'amber','confirmed'=>'blue','processing'=>'indigo','shipped'=>'purple','delivered'=>'emerald','cancelled'=>'red'];
                        $c = $colors[$order->status] ?? 'slate';
                        $icons = ['pending'=>'⏳','confirmed'=>'✅','processing'=>'⚙️','shipped'=>'🚚','delivered'=>'🎉','cancelled'=>'❌'];
                    @endphp
                    <div class="px-6 py-5 border-b border-slate-100 last:border-0 hover:bg-slate-50 transition">
                        <div class="flex items-start justify-between gap-4 flex-wrap">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 flex-wrap mb-2">
                                    <span class="font-mono font-bold text-sm text-slate-900">{{ $order->order_number }}</span>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-{{ $c }}-100 text-{{ $c }}-800">
                                        {{ $icons[$order->status] ?? '📦' }} {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 mb-2">
                                    {{ $order->items->count() }} item(s) ·
                                    Ordered {{ $order->created_at->format('d M Y') }} ·
                                    {{ ucwords(str_replace('_',' ',$order->payment_method)) }}
                                </p>
                                {{-- Items preview --}}
                                <div class="flex gap-2 flex-wrap">
                                    @foreach($order->items->take(3) as $item)
                                        <span class="bg-slate-100 text-slate-600 text-xs px-2 py-1 rounded-lg">
                                            {{ $item->product_name }} ×{{ $item->quantity }}
                                        </span>
                                    @endforeach
                                    @if($order->items->count() > 3)
                                        <span class="bg-slate-100 text-slate-500 text-xs px-2 py-1 rounded-lg">+{{ $order->items->count() - 3 }} more</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="font-display font-bold text-lg text-slate-900">KES {{ number_format($order->total) }}</p>
                                <a href="{{ route('customer.order', $order->order_number) }}"
                                   class="mt-2 inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 text-sm font-bold">
                                    Track Order
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-16 text-center">
                        <div class="text-5xl mb-3">🛍️</div>
                        <p class="font-bold text-slate-600 text-lg mb-1">No orders yet</p>
                        <p class="text-slate-400 text-sm mb-5">Start shopping and your orders will appear here.</p>
                        <a href="{{ route('products') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition">
                            Browse Products
                        </a>
                    </div>
                @endforelse

                @if($orders->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>

            {{-- Profile Settings --}}
            <div id="profile" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h2 class="font-display font-bold text-lg text-slate-900 mb-5 pb-3 border-b border-slate-100">Profile Settings</h2>
                <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Full Name *</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" required
                                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Phone Number</label>
                            <input type="text" name="phone" value="{{ auth()->user()->phone }}"
                                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="+254 7xx xxx xxx">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address</label>
                            <input type="email" value="{{ auth()->user()->email }}" disabled
                                   class="w-full border border-slate-200 bg-slate-50 rounded-xl px-4 py-3 text-sm text-slate-400 cursor-not-allowed">
                            <p class="text-xs text-slate-400 mt-1">Email cannot be changed. Contact support if needed.</p>
                        </div>
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-7 py-3 rounded-xl font-bold text-sm transition">
                        Save Profile
                    </button>
                </form>
            </div>

            {{-- Change Password --}}
            <div id="password" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h2 class="font-display font-bold text-lg text-slate-900 mb-5 pb-3 border-b border-slate-100">Change Password</h2>
                <form action="{{ route('customer.password.change') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Current Password *</label>
                            <input type="password" name="current_password" required
                                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('current_password') border-red-400 @enderror">
                            @error('current_password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">New Password *</label>
                            <input type="password" name="new_password" required
                                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Confirm New Password *</label>
                            <input type="password" name="new_password_confirmation" required
                                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white px-7 py-3 rounded-xl font-bold text-sm transition">
                        Update Password
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection