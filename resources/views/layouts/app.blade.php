<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'zinlinktech — Premium Laptops & Tech in Kisumu')</title>
    {{-- Remove browser tab favicon (replaces default Laravel logo) --}}
    <link rel="icon" href="data:,">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --accent: #f59e0b;
            --dark: #0f172a;
            --surface: #1e293b;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            /* Prevent horizontal scroll on mobile */
            overflow-x: hidden;
            width: 100%;
        }

        .font-display { font-family: 'Syne', sans-serif; }

        /* ── Navbar dropdown (desktop hover) ── */
        .nav-dropdown { display: none; }
        .nav-group:hover .nav-dropdown { display: block; }

        /* ── Mobile menu slide animation ── */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease;
        }
        #mobile-menu.open { max-height: 700px; }

        /* ── Flash message ── */
        .flash-msg { animation: slideDown 0.4s ease forwards; }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Smooth scroll ── */
        html { scroll-behavior: smooth; }

        /* ── Cart badge pulse ── */
        .cart-badge { animation: badgePulse 2s infinite; }
        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50%       { transform: scale(1.15); }
        }

        /* ── Scroll-to-top button ── */
        #scrollTop {
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 0.3s, transform 0.3s;
            /* stay above mobile browser chrome */
            bottom: 1.5rem;
            right: 1rem;
        }
        @media (min-width: 640px) {
            #scrollTop { right: 1.5rem; }
        }

        /* ── Prevent tap highlight on interactive elements ── */
        a, button { -webkit-tap-highlight-color: transparent; }

        /* ── Safe area padding for notched phones ── */
        footer .footer-bottom {
            padding-bottom: max(1.25rem, env(safe-area-inset-bottom));
        }
    </style>
</head>
<body class="bg-slate-50 text-gray-900">

    {{-- ═══════════════════ TOP BAR (visible on md+, collapsed to icon strip on mobile) ═══════════════════ --}}
    {{-- Mobile: single-line with phone + email icons only --}}
    <div class="bg-slate-900 text-slate-400 text-xs py-2">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center gap-2">

            {{-- Mobile: compact icon links --}}
            <div class="flex items-center gap-3 md:hidden">
                <a href="tel:+25468244011" class="flex items-center gap-1 text-slate-300 hover:text-white transition">
                    📞 <span>0768244011</span>
                </a>
                <a href="mailto:zinlinktech@gmail.com" class="flex items-center gap-1 text-slate-300 hover:text-white transition truncate">
                    ✉️ <span class="truncate">zinlinktech@gmail.com</span>
                </a>
            </div>

            {{-- Desktop: full info --}}
            <span class="hidden md:inline">
                📍 Kaimosi, Kenya &nbsp;·&nbsp;
                📞 +254 768 244 011 / 0746 049 506 &nbsp;·&nbsp;
                ✉️ zinlinktech@gmail.com
            </span>

            <div class="flex items-center gap-4 flex-shrink-0">
                <span class="hidden md:inline">🚚 Free delivery over KES 50,000</span>
                @auth
                    <span class="text-amber-400 font-medium truncate max-w-[120px]">👤 {{ auth()->user()->name }}</span>
                @else
                    <a href="{{ route('login') }}" class="text-slate-300 hover:text-white transition whitespace-nowrap">Sign In</a>
                @endauth
            </div>
        </div>
    </div>

    {{-- ═══════════════════ NAVBAR ═══════════════════ --}}
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-14 sm:h-16 gap-2">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 sm:gap-3 group flex-shrink-0">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30 flex-shrink-0"
                         style="background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="leading-tight">
                        <span class="font-display font-extrabold text-base sm:text-lg text-slate-900 tracking-tight block group-hover:text-blue-600 transition">zinlinktech</span>
                        <span class="text-[10px] sm:text-xs text-slate-400 -mt-0.5 block hidden sm:block">Premium Tech Kenya</span>
                    </div>
                </a>

                {{-- Desktop Nav Links --}}
                <div class="hidden lg:flex items-center gap-1 flex-1 justify-center">

                    <a href="{{ route('home') }}"
                       class="px-3 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Home
                    </a>

                    {{-- All Products dropdown --}}
                    <div class="relative nav-group">
                        <a href="{{ route('products') }}"
                           class="flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('products') ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            All Products
                            <svg class="w-3.5 h-3.5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>
                        <div class="nav-dropdown absolute top-full left-0 mt-1 w-52 bg-white rounded-xl shadow-xl border border-slate-100 py-2 z-50">
                            <a href="{{ route('products') }}"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <span class="text-lg">📦</span>
                                <div><p class="font-medium">All Products</p><p class="text-xs text-slate-400">Browse everything</p></div>
                            </a>
                            <a href="{{ route('products') }}?category=Laptops"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <span class="text-lg">💻</span>
                                <div><p class="font-medium">Laptops</p><p class="text-xs text-slate-400">Dell, Apple, HP & more</p></div>
                            </a>
                            <a href="{{ route('products') }}?category=Accessories"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <span class="text-lg">🖱️</span>
                                <div><p class="font-medium">Accessories</p><p class="text-xs text-slate-400">Mice, keyboards & more</p></div>
                            </a>
                            <a href="{{ route('products') }}?category=Monitors"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <span class="text-lg">🖥️</span>
                                <div><p class="font-medium">Monitors</p><p class="text-xs text-slate-400">4K, gaming & office</p></div>
                            </a>
                            <a href="{{ route('products') }}?category=Components"
                               class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <span class="text-lg">🔧</span>
                                <div><p class="font-medium">Components</p><p class="text-xs text-slate-400">RAM, SSD, GPUs</p></div>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('products') }}?category=Laptops"
                       class="px-3 py-2 text-sm font-medium rounded-lg transition {{ request('category') === 'Laptops' ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Laptops
                    </a>

                    <a href="{{ route('products') }}?category=Accessories"
                       class="px-3 py-2 text-sm font-medium rounded-lg transition {{ request('category') === 'Accessories' ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Accessories
                    </a>

                    <a href="{{ route('reviews') }}"
                       class="px-3 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('reviews') ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Reviews
                    </a>

                    <a href="{{ route('about') }}"
                       class="px-3 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('about') ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        About
                    </a>

                    <a href="{{ route('contact') }}"
                       class="px-3 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('contact') ? 'text-blue-600 bg-blue-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Contact
                    </a>
                </div>

                {{-- Right Side Actions --}}
                <div class="flex items-center gap-1.5 sm:gap-2 flex-shrink-0">

                    {{-- Search icon (visible on tablet and below) --}}
                    <a href="{{ route('products') }}"
                       class="p-2 rounded-lg text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition lg:hidden"
                       aria-label="Search products">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </a>

                    {{-- Cart --}}
                    <a href="{{ route('cart') }}"
                       class="relative flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white px-3 sm:px-4 py-2 rounded-xl transition text-sm font-semibold shadow-md shadow-blue-500/25"
                       aria-label="Shopping cart">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="hidden sm:inline">Cart</span>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="cart-badge absolute -top-2 -right-2 bg-amber-400 text-slate-900 text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center shadow">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>

                    {{-- Admin button --}}
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}"
                               class="hidden lg:flex items-center gap-1.5 bg-amber-400 hover:bg-amber-300 text-slate-900 px-4 py-2 rounded-xl transition text-sm font-bold shadow-md shadow-amber-400/30">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Admin
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           title="Admin Login"
                           class="hidden lg:flex items-center gap-1.5 border border-slate-300 hover:border-slate-400 text-slate-500 hover:text-slate-700 px-3 py-2 rounded-xl transition text-sm font-medium">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Admin
                        </a>
                    @endauth

                    {{-- Hamburger (mobile / tablet) --}}
                    <button id="menu-toggle"
                            onclick="toggleMenu()"
                            class="lg:hidden p-2 rounded-lg text-slate-500 hover:text-slate-900 hover:bg-slate-100 active:bg-slate-200 transition"
                            aria-label="Toggle menu"
                            aria-expanded="false"
                            aria-controls="mobile-menu">
                        {{-- Hamburger icon --}}
                        <svg id="icon-hamburger" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        {{-- Close icon (hidden by default) --}}
                        <svg id="icon-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- ── Mobile Menu ── --}}
        <div id="mobile-menu" class="lg:hidden bg-white border-t border-slate-100" role="navigation" aria-label="Mobile navigation">
            <div class="px-4 py-3 space-y-0.5">

                {{-- Primary links --}}
                <a href="{{ route('home') }}"
                   class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition
                          {{ request()->routeIs('home') ? 'text-blue-700 bg-blue-50' : 'text-slate-700 hover:bg-slate-50 active:bg-slate-100' }}">
                    🏠 <span>Home</span>
                </a>

                <a href="{{ route('products') }}"
                   class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition
                          {{ request()->routeIs('products') && !request('category') ? 'text-blue-700 bg-blue-50' : 'text-slate-700 hover:bg-slate-50 active:bg-slate-100' }}">
                    📦 <span>All Products</span>
                </a>

                {{-- Category sub-links with slight indent --}}
                <div class="pl-4 space-y-0.5 border-l-2 border-slate-100 ml-6">
                    <a href="{{ route('products') }}?category=Laptops"
                       class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm transition
                              {{ request('category') === 'Laptops' ? 'text-blue-700 bg-blue-50 font-medium' : 'text-slate-600 hover:bg-slate-50' }}">
                        💻 Laptops
                    </a>
                    <a href="{{ route('products') }}?category=Accessories"
                       class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm transition
                              {{ request('category') === 'Accessories' ? 'text-blue-700 bg-blue-50 font-medium' : 'text-slate-600 hover:bg-slate-50' }}">
                        🖱️ Accessories
                    </a>
                    <a href="{{ route('products') }}?category=Monitors"
                       class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm transition
                              {{ request('category') === 'Monitors' ? 'text-blue-700 bg-blue-50 font-medium' : 'text-slate-600 hover:bg-slate-50' }}">
                        🖥️ Monitors
                    </a>
                    <a href="{{ route('products') }}?category=Components"
                       class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm transition
                              {{ request('category') === 'Components' ? 'text-blue-700 bg-blue-50 font-medium' : 'text-slate-600 hover:bg-slate-50' }}">
                        🔧 Components
                    </a>
                </div>

                <a href="{{ route('reviews') }}"
                   class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition
                          {{ request()->routeIs('reviews') ? 'text-blue-700 bg-blue-50' : 'text-slate-700 hover:bg-slate-50 active:bg-slate-100' }}">
                    ⭐ <span>Reviews</span>
                </a>

                <a href="{{ route('about') }}"
                   class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition
                          {{ request()->routeIs('about') ? 'text-blue-700 bg-blue-50' : 'text-slate-700 hover:bg-slate-50 active:bg-slate-100' }}">
                    ℹ️ <span>About</span>
                </a>

                <a href="{{ route('contact') }}"
                   class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition
                          {{ request()->routeIs('contact') ? 'text-blue-700 bg-blue-50' : 'text-slate-700 hover:bg-slate-50 active:bg-slate-100' }}">
                    📩 <span>Contact</span>
                </a>

                {{-- Divider + auth section --}}
                <div class="border-t border-slate-100 pt-2 mt-2 space-y-0.5">
                    @auth
                        {{-- Logged-in user chip --}}
                        <div class="flex items-center gap-3 px-3 py-2.5 text-sm text-slate-500">
                            <span class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs flex-shrink-0">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span class="font-medium text-slate-700 truncate">{{ auth()->user()->name }}</span>
                        </div>

                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}"
                               class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 active:bg-amber-200 transition">
                                ⚙️ <span>Admin Panel</span>
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 active:bg-red-100 transition">
                                🚪 <span>Logout</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-700 active:bg-blue-100 transition">
                            🔒 <span>Admin Login</span>
                        </a>
                    @endauth
                </div>

                {{-- Contact info strip at bottom of menu --}}
                <div class="border-t border-slate-100 pt-3 mt-2 grid grid-cols-2 gap-2 text-xs text-slate-500 px-1">
                    <a href="tel:+254768244011" class="flex items-center gap-1.5 hover:text-blue-600 transition">
                        📞 0768 244 011
                    </a>
                    <span class="flex items-center gap-1.5">🕐 Mon–Sat 8am–7pm</span>
                    <a href="mailto:zinlinktech@gmail.com" class="col-span-2 flex items-center gap-1.5 hover:text-blue-600 transition truncate">
                        ✉️ zinlinktech@gmail.com
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="flash-msg bg-emerald-500 text-white text-center py-3 px-4 text-sm font-semibold" role="alert">
            ✓ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flash-msg bg-red-500 text-white text-center py-3 px-4 text-sm font-semibold" role="alert">
            ✗ {{ session('error') }}
        </div>
    @endif

    {{-- Main Content --}}
    <main>@yield('content')</main>

    {{-- ═══════════════════ FOOTER ═══════════════════ --}}
    <footer class="bg-slate-900 text-slate-400 mt-16 sm:mt-20">

        {{-- Newsletter --}}
        <div class="border-b border-slate-800">
            <div class="max-w-7xl mx-auto px-4 py-8 sm:py-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5">
                <div class="flex-shrink-0">
                    <h3 class="font-display font-bold text-white text-lg sm:text-xl mb-1">Stay in the loop</h3>
                    <p class="text-sm text-slate-400">Get notified about new products and exclusive deals.</p>
                </div>
                <form class="flex gap-2 w-full sm:w-auto" onsubmit="return false;">
                    <input type="email" placeholder="your@email.com"
                           class="flex-1 sm:w-64 md:w-72 bg-slate-800 border border-slate-700 text-white rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-slate-500 min-w-0">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-500 active:bg-blue-700 text-white px-4 sm:px-5 py-2.5 rounded-xl text-sm font-semibold transition whitespace-nowrap flex-shrink-0">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        {{-- Main footer grid --}}
        <div class="max-w-7xl mx-auto px-4 py-10 sm:py-14 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10">

            {{-- Brand --}}
            <div class="col-span-2 sm:col-span-2 lg:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="font-display font-bold text-white text-lg">zinlinktech</span>
                </div>
                <p class="text-sm leading-relaxed text-slate-400 mb-5 max-w-xs">Kenya's trusted source for genuine laptops and tech accessories. Quality guaranteed, prices unbeatable.</p>
                <div class="flex gap-2.5">
                    <a href="#" aria-label="Facebook" class="w-9 h-9 bg-slate-800 hover:bg-blue-600 rounded-lg flex items-center justify-center transition text-slate-400 hover:text-white">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" aria-label="Instagram" class="w-9 h-9 bg-slate-800 hover:bg-pink-600 rounded-lg flex items-center justify-center transition text-slate-400 hover:text-white">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="#" aria-label="WhatsApp" class="w-9 h-9 bg-slate-800 hover:bg-green-600 rounded-lg flex items-center justify-center transition text-slate-400 hover:text-white">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Products --}}
            <div>
                <h4 class="font-display font-bold text-white text-xs uppercase tracking-widest mb-4 sm:mb-5">Products</h4>
                <ul class="space-y-2.5 sm:space-y-3 text-sm">
                    <li><a href="{{ route('products') }}" class="hover:text-white transition flex items-center gap-2"><span class="text-blue-500">›</span> All Products</a></li>
                    <li><a href="{{ route('products') }}?category=Laptops" class="hover:text-white transition flex items-center gap-2"><span class="text-blue-500">›</span> Laptops</a></li>
                    <li><a href="{{ route('products') }}?category=Accessories" class="hover:text-white transition flex items-center gap-2"><span class="text-blue-500">›</span> Accessories</a></li>
                    <li><a href="{{ route('products') }}?category=Monitors" class="hover:text-white transition flex items-center gap-2"><span class="text-blue-500">›</span> Monitors</a></li>
                    <li><a href="{{ route('products') }}?category=Components" class="hover:text-white transition flex items-center gap-2"><span class="text-blue-500">›</span> Components</a></li>
                </ul>
            </div>

            {{-- Company --}}
            <div>
                <h4 class="font-display font-bold text-white text-xs uppercase tracking-widest mb-4 sm:mb-5">Company</h4>
                <ul class="space-y-2.5 sm:space-y-3 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-white transition flex items-center gap-2"><span class="text-blue-500">›</span> About Us</a></li>
                    <li><a href="{{ route('reviews') }}" class="hover:text-white transition flex items-center gap-2"><span class="text-blue-500">›</span> Reviews</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition flex items-center gap-2"><span class="text-blue-500">›</span> Contact</a></li>
                    <li><a href="{{ route('cart') }}" class="hover:text-white transition flex items-center gap-2"><span class="text-blue-500">›</span> My Cart</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="col-span-2 sm:col-span-1">
                <h4 class="font-display font-bold text-white text-xs uppercase tracking-widest mb-4 sm:mb-5">Get In Touch</h4>
                <ul class="space-y-2.5 sm:space-y-3 text-sm">
                    <li class="flex items-start gap-3">
                        <span class="text-blue-400 mt-0.5 flex-shrink-0">📍</span>
                        <span>Kaimosi, Vihiga, Kenya</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-blue-400 flex-shrink-0">📞</span>
                        <a href="tel:+254746049506" class="hover:text-white transition">0746 049 506 / 0768 244 011</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-blue-400 flex-shrink-0">✉️</span>
                        <a href="mailto:zinlinktech@gmail.com" class="hover:text-white transition break-all">zinlinktech@gmail.com</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="text-blue-400 flex-shrink-0">🕐</span>
                        <span>Mon–Sat: 8am – 7pm</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="border-t border-slate-800 footer-bottom">
            <div class="max-w-7xl mx-auto px-4 py-4 sm:py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
                <span>© {{ date('Y') }} zinlinktech Kenya. All rights reserved.</span>
                <div class="flex items-center gap-2 flex-wrap justify-center">
                    <span class="bg-slate-800 px-2 py-1 rounded font-mono text-slate-400">M-PESA</span>
                    <span class="bg-slate-800 px-2 py-1 rounded font-mono text-slate-400">VISA</span>
                    <span class="bg-slate-800 px-2 py-1 rounded font-mono text-slate-400">MASTERCARD</span>
                </div>
            </div>
        </div>
    </footer>

    {{-- Scroll to top --}}
    <button id="scrollTop"
            onclick="window.scrollTo({top:0,behavior:'smooth'})"
            class="fixed w-10 h-10 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-full shadow-lg shadow-blue-500/30 flex items-center justify-center z-40"
            aria-label="Scroll to top">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
        </svg>
    </button>

    <script>
        // ── Scroll-to-top visibility ──
        const scrollBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            const visible = window.scrollY > 300;
            scrollBtn.style.opacity  = visible ? '1' : '0';
            scrollBtn.style.transform = visible ? 'translateY(0)' : 'translateY(16px)';
        }, { passive: true });

        // ── Mobile menu toggle with icon swap + aria ──
        function toggleMenu() {
            const menu    = document.getElementById('mobile-menu');
            const toggle  = document.getElementById('menu-toggle');
            const iconHam = document.getElementById('icon-hamburger');
            const iconX   = document.getElementById('icon-close');
            const isOpen  = menu.classList.toggle('open');

            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            iconHam.classList.toggle('hidden', isOpen);
            iconX.classList.toggle('hidden', !isOpen);

            // Prevent body scroll while menu open on mobile
            document.body.style.overflow = isOpen ? 'hidden' : '';
        }

        // Close menu when a link inside it is tapped
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                const menu   = document.getElementById('mobile-menu');
                const toggle = document.getElementById('menu-toggle');
                if (menu.classList.contains('open')) {
                    menu.classList.remove('open');
                    document.getElementById('icon-hamburger').classList.remove('hidden');
                    document.getElementById('icon-close').classList.add('hidden');
                    toggle.setAttribute('aria-expanded', 'false');
                    document.body.style.overflow = '';
                }
            });
        });

        // Close menu on resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                const menu = document.getElementById('mobile-menu');
                menu.classList.remove('open');
                document.getElementById('icon-hamburger').classList.remove('hidden');
                document.getElementById('icon-close').classList.add('hidden');
                document.getElementById('menu-toggle').setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }
        });

        // ── Auto-dismiss flash messages ──
        setTimeout(() => {
            document.querySelectorAll('.flash-msg').forEach(el => {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            });
        }, 4000);
    </script>
</body>
</html>