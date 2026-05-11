<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin — zinlinktech')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Syne', sans-serif; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 99px; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen">
<div class="flex min-h-screen">

    {{-- ══════════ SIDEBAR ══════════ --}}
    <aside class="w-64 bg-slate-950 flex flex-col h-screen sticky top-0 z-40 flex-shrink-0 overflow-y-auto">

        {{-- Logo --}}
        <div class="px-5 py-5 border-b border-slate-800/80 flex-shrink-0">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-display font-bold text-white text-base leading-tight">zinlinktech</p>
                    <p class="text-slate-500 text-xs">Admin Panel</p>
                </div>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-0.5">

            {{-- Overview --}}
            <p class="text-slate-600 text-xs font-bold uppercase tracking-widest px-3 pb-2 pt-1">Overview</p>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            {{-- Catalogue --}}
            <p class="text-slate-600 text-xs font-bold uppercase tracking-widest px-3 pb-2 pt-4">Catalogue</p>

            <a href="{{ route('admin.products') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.products') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                All Products
                <span class="ml-auto text-xs bg-slate-800 text-slate-400 px-2 py-0.5 rounded-full">{{ \App\Models\Product::count() }}</span>
            </a>

            <a href="{{ route('admin.products.create') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.products.create') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Product
            </a>

            <a href="{{ route('admin.inventory') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.inventory') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                Inventory
                @php $outCount = \App\Models\Product::where('stock',0)->count(); @endphp
                @if($outCount > 0)
                    <span class="ml-auto text-xs bg-red-500 text-white font-bold px-2 py-0.5 rounded-full">{{ $outCount }} out</span>
                @endif
            </a>

            {{-- Orders --}}
            <p class="text-slate-600 text-xs font-bold uppercase tracking-widest px-3 pb-2 pt-4">Orders</p>

            <a href="{{ route('admin.orders') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.orders*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                All Orders
                @php $pendingCount = \App\Models\Order::where('status','pending')->count(); @endphp
                @if($pendingCount > 0)
                    <span class="ml-auto text-xs bg-amber-400 text-slate-900 font-bold px-2 py-0.5 rounded-full animate-pulse">{{ $pendingCount }}</span>
                @endif
            </a>

            {{-- Content --}}
            <p class="text-slate-600 text-xs font-bold uppercase tracking-widest px-3 pb-2 pt-4">Content</p>

            <a href="{{ route('admin.reviews') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.reviews*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                Reviews
                @php $pendingReviews = \App\Models\Review::where('status','pending')->count(); @endphp
                @if($pendingReviews > 0)
                    <span class="ml-auto text-xs bg-amber-400 text-slate-900 font-bold px-2 py-0.5 rounded-full">{{ $pendingReviews }}</span>
                @endif
            </a>

            <a href="{{ route('admin.team') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ request()->routeIs('admin.team*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Our Team
                <span class="ml-auto text-xs bg-slate-800 text-slate-400 px-2 py-0.5 rounded-full">{{ \App\Models\TeamMember::count() }}</span>
            </a>

            {{-- Store --}}
            <p class="text-slate-600 text-xs font-bold uppercase tracking-widest px-3 pb-2 pt-4">Store</p>

            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-white transition-all">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                View Storefront ↗
            </a>
        </nav>

        {{-- User + Logout --}}
        <div class="p-3 border-t border-slate-800/80 flex-shrink-0">
            <div class="bg-slate-900 rounded-xl px-3 py-2.5 mb-2 flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-white text-xs font-bold truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-slate-500 text-xs truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-red-400 hover:bg-red-950 hover:text-red-300 transition font-medium">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- ══════════ MAIN ══════════ --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- Top header --}}
        <header class="bg-white border-b border-slate-200 px-6 py-3.5 flex items-center justify-between sticky top-0 z-30 shadow-sm">
            <div>
                <h1 class="font-display font-bold text-slate-900 text-lg leading-tight">@yield('page-title', 'Dashboard')</h1>
                <p class="text-slate-400 text-xs mt-0.5">@yield('page-subtitle', '')</p>
            </div>
            <div class="flex items-center gap-3">
                @if(\App\Models\Order::where('status','pending')->count() > 0)
                    <a href="{{ route('admin.orders') }}?status=pending"
                       class="hidden md:flex items-center gap-1.5 bg-amber-50 border border-amber-200 text-amber-700 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-amber-100 transition">
                        <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></span>
                        {{ \App\Models\Order::where('status','pending')->count() }} pending orders
                    </a>
                @endif
                <span class="hidden md:block text-slate-400 text-xs bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-lg">
                    {{ now()->format('D, d M Y') }}
                </span>
            </div>
        </header>

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="mx-6 mt-4 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2">
                <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <main class="flex-1 p-6">@yield('content')</main>

        <footer class="border-t border-slate-200 bg-white px-6 py-3 text-center text-xs text-slate-400">
            zinlinktech Admin © {{ date('Y') }}
        </footer>
    </div>
</div>
</body>
</html>