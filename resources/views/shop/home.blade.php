@extends('layouts.app')
@section('title', 'zinlinktech — Premium Laptops & Tech in Kenya')

@section('content')

{{-- ══════════════════════ HERO CAROUSEL ══════════════════════ --}}
<section class="relative overflow-hidden" style="height: 580px;">

    {{-- Slide wrapper --}}
    <div id="carousel-track" class="flex h-full transition-transform duration-700 ease-in-out" style="width: 300%;">

        {{-- ── SLIDE 1 — Person working on laptop ── --}}
        <div class="relative flex-shrink-0 h-full" style="width: 33.333%;">
            <img src="https://images.pexels.com/photos/1181354/pexels-photo-1181354.jpeg?auto=compress&cs=tinysrgb&w=1200&h=800&dpr=2"
                 alt="Person working on laptop"
                 class="absolute inset-0 w-full h-full object-cover">
            {{-- Dark overlay --}}
            <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(10,15,40,0.90) 0%, rgba(10,15,40,0.55) 55%, rgba(10,15,40,0.15) 100%);"></div>
            {{-- Content --}}
            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-6 w-full">
                    <div class="max-w-xl">
                        <span class="inline-flex items-center gap-2 bg-blue-500/20 border border-blue-400/40 text-blue-300 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-5">
                            🔥 2024 New Arrivals
                        </span>
                        <h1 class="font-display font-bold text-white leading-tight mb-4" style="font-size: clamp(2rem, 5vw, 3.5rem);">
                            MacBook Pro<br>
                            <span class="text-blue-400">M3 Series</span>
                        </h1>
                        <p class="text-slate-300 text-lg leading-relaxed mb-8">
                            Breakthrough performance for creators and developers. The M3 chip redefines what a laptop can do.
                        </p>
                        <div class="flex flex-wrap gap-4 mb-8">
                            <a href="{{ route('products') }}?category=Laptops"
                               class="bg-blue-600 hover:bg-blue-500 text-white px-7 py-3.5 rounded-xl font-bold transition shadow-2xl shadow-blue-500/30 text-sm">
                                Shop Laptops →
                            </a>
                            <a href="{{ route('about') }}"
                               class="border border-white/25 hover:border-white/50 backdrop-blur-sm text-white px-7 py-3.5 rounded-xl font-semibold transition text-sm">
                                Our Guarantee
                            </a>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="text-center"><p class="font-display font-bold text-2xl text-white">KES 245K</p><p class="text-xs text-slate-400 mt-0.5">Starting from</p></div>
                            <div class="w-px h-10 bg-white/20"></div>
                            <div class="text-center"><p class="font-display font-bold text-2xl text-white">M3 Pro</p><p class="text-xs text-slate-400 mt-0.5">Apple Silicon</p></div>
                            <div class="w-px h-10 bg-white/20"></div>
                            <div class="text-center"><p class="font-display font-bold text-2xl text-white">22hr</p><p class="text-xs text-slate-400 mt-0.5">Battery life</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SLIDE 2 — IT / Network setup ── --}}
        <div class="relative flex-shrink-0 h-full" style="width: 33.333%;">
            <img src="https://images.pexels.com/photos/1181675/pexels-photo-1181675.jpeg?auto=compress&cs=tinysrgb&w=1200&h=800&dpr=2"
                 alt="Network server setup"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(5,20,5,0.92) 0%, rgba(5,20,5,0.60) 55%, rgba(5,20,5,0.10) 100%);"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-6 w-full">
                    <div class="max-w-xl">
                        <span class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-5">
                            💰 Best Value Pick
                        </span>
                        <h1 class="font-display font-bold text-white leading-tight mb-4" style="font-size: clamp(2rem, 5vw, 3.5rem);">
                            Dell XPS 15<br>
                            <span class="text-emerald-400">4K OLED Power</span>
                        </h1>
                        <p class="text-slate-300 text-lg leading-relaxed mb-8">
                            Intel i7 Gen 13, stunning 4K OLED display, 16GB RAM. Built for professionals who demand the best tools.
                        </p>
                        <div class="flex flex-wrap gap-4 mb-8">
                            <a href="{{ route('products') }}?category=Laptops"
                               class="bg-emerald-600 hover:bg-emerald-500 text-white px-7 py-3.5 rounded-xl font-bold transition shadow-2xl shadow-emerald-500/30 text-sm">
                                Shop Now →
                            </a>
                            <a href="{{ route('contact') }}"
                               class="border border-white/25 hover:border-white/50 backdrop-blur-sm text-white px-7 py-3.5 rounded-xl font-semibold transition text-sm">
                                Ask an Expert
                            </a>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="text-center"><p class="font-display font-bold text-2xl text-white">KES 185K</p><p class="text-xs text-slate-400 mt-0.5">Starting from</p></div>
                            <div class="w-px h-10 bg-white/20"></div>
                            <div class="text-center"><p class="font-display font-bold text-2xl text-white">4K OLED</p><p class="text-xs text-slate-400 mt-0.5">Display</p></div>
                            <div class="w-px h-10 bg-white/20"></div>
                            <div class="text-center"><p class="font-display font-bold text-2xl text-white">i7-13th</p><p class="text-xs text-slate-400 mt-0.5">Processor</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SLIDE 3 — Gaming / desk setup ── --}}
        <div class="relative flex-shrink-0 h-full" style="width: 33.333%;">
            <img src="https://images.pexels.com/photos/3861968/pexels-photo-3861968.jpeg?auto=compress&cs=tinysrgb&w=1200&h=800&dpr=2"
                 alt="Gaming laptop desk setup"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(25,5,50,0.92) 0%, rgba(25,5,50,0.60) 55%, rgba(25,5,50,0.10) 100%);"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-6 w-full">
                    <div class="max-w-xl">
                        <span class="inline-flex items-center gap-2 bg-purple-500/20 border border-purple-400/40 text-purple-300 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-5">
                            🎓 Student Deal
                        </span>
                        <h1 class="font-display font-bold text-white leading-tight mb-4" style="font-size: clamp(2rem, 5vw, 3.5rem);">
                            HP Pavilion<br>
                            <span class="text-purple-400">Affordable Power</span>
                        </h1>
                        <p class="text-slate-300 text-lg leading-relaxed mb-8">
                            AMD Ryzen 5, fast SSD, 15.6" FHD display. The perfect laptop for students and everyday professionals.
                        </p>
                        <div class="flex flex-wrap gap-4 mb-8">
                            <a href="{{ route('products') }}?category=Laptops"
                               class="bg-purple-600 hover:bg-purple-500 text-white px-7 py-3.5 rounded-xl font-bold transition shadow-2xl shadow-purple-500/30 text-sm">
                                Shop Laptops →
                            </a>
                            <a href="{{ route('reviews') }}"
                               class="border border-white/25 hover:border-white/50 backdrop-blur-sm text-white px-7 py-3.5 rounded-xl font-semibold transition text-sm">
                                See Reviews
                            </a>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="text-center"><p class="font-display font-bold text-2xl text-white">KES 65K</p><p class="text-xs text-slate-400 mt-0.5">Starting from</p></div>
                            <div class="w-px h-10 bg-white/20"></div>
                            <div class="text-center"><p class="font-display font-bold text-2xl text-white">Ryzen 5</p><p class="text-xs text-slate-400 mt-0.5">AMD Processor</p></div>
                            <div class="w-px h-10 bg-white/20"></div>
                            <div class="text-center"><p class="font-display font-bold text-2xl text-white">256GB SSD</p><p class="text-xs text-slate-400 mt-0.5">Fast storage</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Prev / Next buttons --}}
    <button onclick="prevSlide()"
            class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 bg-white/10 hover:bg-white/25 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center text-white transition z-20">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button onclick="nextSlide()"
            class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 bg-white/10 hover:bg-white/25 backdrop-blur-sm border border-white/20 rounded-full flex items-center justify-center text-white transition z-20">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- Dots --}}
    <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex items-center gap-2 z-20">
        <button onclick="goTo(0)" id="dot-0" class="carousel-dot h-1.5 rounded-full transition-all duration-300 bg-white" style="width:24px;"></button>
        <button onclick="goTo(1)" id="dot-1" class="carousel-dot h-1.5 rounded-full transition-all duration-300 bg-white/40" style="width:10px;"></button>
        <button onclick="goTo(2)" id="dot-2" class="carousel-dot h-1.5 rounded-full transition-all duration-300 bg-white/40" style="width:10px;"></button>
    </div>

    {{-- Slide counter --}}
    <div class="absolute bottom-5 right-6 z-20">
        <span id="slide-counter" class="text-white/60 text-xs font-bold">1 / 3</span>
    </div>
</section>

{{-- ══════════════════════ TRUST BADGES ══════════════════════ --}}
<section class="bg-white border-b border-slate-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="flex items-center gap-2.5 py-2 justify-center md:justify-start">
                <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center text-lg flex-shrink-0">🚚</div>
                <div><p class="text-xs font-bold text-slate-800">Free Delivery</p><p class="text-xs text-slate-400">Over KES 50,000</p></div>
            </div>
            <div class="flex items-center gap-2.5 py-2 justify-center md:justify-start">
                <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center text-lg flex-shrink-0">🛡️</div>
                <div><p class="text-xs font-bold text-slate-800">1 Year Warranty</p><p class="text-xs text-slate-400">On all products</p></div>
            </div>
            <div class="flex items-center gap-2.5 py-2 justify-center md:justify-start">
                <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center text-lg flex-shrink-0">💳</div>
                <div><p class="text-xs font-bold text-slate-800">M-Pesa & Card</p><p class="text-xs text-slate-400">Secure payments</p></div>
            </div>
            <div class="flex items-center gap-2.5 py-2 justify-center md:justify-start">
                <div class="w-9 h-9 bg-purple-50 rounded-xl flex items-center justify-center text-lg flex-shrink-0">✅</div>
                <div><p class="text-xs font-bold text-slate-800">100% Genuine</p><p class="text-xs text-slate-400">Authentic only</p></div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════ STATS BAR ══════════════════════ --}}
<section class="bg-blue-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        <div><p class="font-display font-bold text-4xl mb-1">1,200<span class="text-blue-300">+</span></p><p class="text-blue-100 text-sm font-medium">Happy Customers</p></div>
        <div><p class="font-display font-bold text-4xl mb-1">350<span class="text-blue-300">+</span></p><p class="text-blue-100 text-sm font-medium">Products</p></div>
        <div><p class="font-display font-bold text-4xl mb-1">4.9<span class="text-blue-300">★</span></p><p class="text-blue-100 text-sm font-medium">Avg Rating</p></div>
        <div><p class="font-display font-bold text-4xl mb-1">5<span class="text-blue-300">yr</span></p><p class="text-blue-100 text-sm font-medium">In Business</p></div>
    </div>
</section>

{{-- ══════════════════════ FEATURED PRODUCTS ══════════════════════ --}}
@if($featured->count())
<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex items-end justify-between mb-10">
        <div>
            <span class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-2 block">Handpicked For You</span>
            <h2 class="font-display font-bold text-3xl md:text-4xl text-slate-900">Featured Products</h2>
        </div>
        <a href="{{ route('products') }}" class="hidden md:flex items-center gap-1.5 text-blue-600 hover:text-blue-700 font-bold text-sm group">
            View all
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($featured as $product)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden group flex flex-col">
                <a href="{{ route('product.show', $product->id) }}" class="relative block">
                    <div class="bg-slate-50 h-48 flex items-center justify-center overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
                                 class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <svg class="w-16 h-16 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        @endif
                    </div>
                    @if($product->featured)
                        <span class="absolute top-2 left-2 bg-amber-400 text-slate-900 text-xs font-bold px-2 py-0.5 rounded-full">⭐ Featured</span>
                    @endif
                    @if($product->stock === 0)
                        <div class="absolute inset-0 bg-white/60 flex items-center justify-center">
                            <span class="bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full">Out of Stock</span>
                        </div>
                    @elseif($product->stock <= 5)
                        <span class="absolute top-2 right-2 bg-orange-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">Low Stock</span>
                    @endif
                </a>
                <div class="p-4 flex flex-col flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs text-blue-600 font-bold uppercase tracking-wide">{{ $product->category }}</span>
                        @if($product->brand)<span class="text-xs text-slate-400">{{ $product->brand }}</span>@endif
                    </div>
                    <a href="{{ route('product.show', $product->id) }}">
                        <h3 class="font-semibold text-slate-900 text-sm leading-snug mb-1 hover:text-blue-600 transition line-clamp-2">{{ $product->name }}</h3>
                    </a>
                    @if($product->specs)<p class="text-xs text-slate-400 mb-2 line-clamp-1">{{ $product->specs }}</p>@endif
                    <div class="flex items-center gap-0.5 mb-3">
                        @for($i=0;$i<5;$i++)<svg class="w-3 h-3 text-amber-400 fill-amber-400" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                    </div>
                    <div class="mt-auto flex items-center justify-between pt-3 border-t border-slate-100">
                        <span class="font-display font-bold text-slate-900 text-base">KES {{ number_format($product->price) }}</span>
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button class="flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-3 py-2 rounded-xl transition shadow-sm shadow-blue-500/20">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
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
    <div class="text-center mt-10">
        <a href="{{ route('products') }}" class="inline-flex items-center gap-2 border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-8 py-3 rounded-xl font-bold transition text-sm">
            Browse All Products
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>
@endif

{{-- ══════════════════════ CATEGORIES ══════════════════════ --}}
<section class="bg-slate-900 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <span class="text-blue-400 text-xs font-bold uppercase tracking-widest mb-2 block">Shop by Category</span>
            <h2 class="font-display font-bold text-3xl text-white">Find What You Need</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach([
                ['name'=>'Laptops',     'icon'=>'💻','from'=>'from-blue-600','to'=>'to-blue-800',   'desc'=>'Work & gaming'],
                ['name'=>'Accessories', 'icon'=>'🖱️','from'=>'from-emerald-600','to'=>'to-emerald-800','desc'=>'Mice, keyboards & more'],
                ['name'=>'Monitors',    'icon'=>'🖥️','from'=>'from-purple-600','to'=>'to-purple-800','desc'=>'4K & ultrawide'],
                ['name'=>'Components',  'icon'=>'🔧','from'=>'from-orange-600','to'=>'to-orange-800','desc'=>'RAM, SSD, GPU'],
            ] as $cat)
                <a href="{{ route('products') }}?category={{ $cat['name'] }}"
                   class="group bg-gradient-to-br {{ $cat['from'] }} {{ $cat['to'] }} rounded-2xl p-6 hover:scale-105 transition-transform duration-300 shadow-lg border border-white/10 text-center">
                    <div class="text-4xl mb-3">{{ $cat['icon'] }}</div>
                    <h3 class="font-display font-bold text-white text-lg mb-1">{{ $cat['name'] }}</h3>
                    <p class="text-white/60 text-xs">{{ $cat['desc'] }}</p>
                    <div class="mt-4 inline-flex items-center gap-1 text-white/80 group-hover:text-white text-xs font-semibold transition">
                        Shop now
                        <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════ LATEST ARRIVALS ══════════════════════ --}}
@if($latest->count())
<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="mb-10">
        <span class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-2 block">Just In</span>
        <h2 class="font-display font-bold text-3xl text-slate-900">Latest Arrivals</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($latest as $product)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden group flex flex-col">
                <a href="{{ route('product.show', $product->id) }}" class="relative block">
                    <div class="bg-slate-50 h-40 flex items-center justify-center overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
                                 class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        @endif
                    </div>
                    <span class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">New</span>
                </a>
                <div class="p-4 flex-1 flex flex-col">
                    <span class="text-xs text-blue-600 font-bold uppercase tracking-wide">{{ $product->category }}</span>
                    <a href="{{ route('product.show', $product->id) }}">
                        <h3 class="font-semibold text-slate-900 mt-1 hover:text-blue-600 transition line-clamp-2 text-sm flex-1">{{ $product->name }}</h3>
                    </a>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="font-display font-bold text-slate-900">KES {{ number_format($product->price) }}</span>
                        <a href="{{ route('product.show', $product->id) }}" class="text-blue-600 text-xs font-bold hover:underline">View →</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

{{-- ══════════════════════ WHY CHOOSE US ══════════════════════ --}}
<section class="bg-gradient-to-br from-slate-50 to-blue-50 py-16 border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-2 block">Why zinlinktech?</span>
            <h2 class="font-display font-bold text-3xl text-slate-900">Built on Trust</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
            @foreach([
                ['icon'=>'🔒','bg'=>'bg-blue-50','title'=>'100% Genuine Products','desc'=>'Every product comes with official manufacturer warranty. We never sell refurbished items as new.'],
                ['icon'=>'📦','bg'=>'bg-emerald-50','title'=>'Same-Day Nairobi Delivery','desc'=>'Order before 2 PM and receive your purchase the same day in Nairobi. Countrywide within 48 hours.'],
                ['icon'=>'💬','bg'=>'bg-amber-50','title'=>'Expert Support 7 Days','desc'=>'Our tech-savvy team is available daily via WhatsApp, phone, or email to help you choose the right device.'],
            ] as $item)
                <div class="bg-white rounded-2xl p-7 shadow-sm border border-slate-100 text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 {{ $item['bg'] }} rounded-2xl flex items-center justify-center text-3xl mx-auto mb-5">{{ $item['icon'] }}</div>
                    <h3 class="font-display font-bold text-lg text-slate-900 mb-2">{{ $item['title'] }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════ TESTIMONIALS ══════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <span class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-2 block">Customer Love</span>
        <h2 class="font-display font-bold text-3xl text-slate-900">What Customers Say</h2>
        <div class="flex items-center justify-center gap-1 mt-3">
            @for($i=0;$i<5;$i++)<svg class="w-5 h-5 text-amber-400 fill-amber-400" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
            <span class="text-slate-500 text-sm ml-2 font-medium">4.9/5 from 1,200+ reviews</span>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach([
            ['name'=>'Martin okello','role'=>'Software Developer, Nairobi','rating'=>5,'text'=>'Got my Dell XPS within 12 hours of ordering. Sealed box, genuine warranty card. zinlinktech is now my go-to for all tech purchases.','initials'=>'JM','color'=>'bg-blue-600'],
            ['name'=>'Grace Wanjiku','role'=>'Graphic Designer, Westlands','rating'=>5,'text'=>'I was nervous buying a MacBook online but these guys are legit. Sealed box, Apple Kenya sticker. The M3 is incredible for design work!','initials'=>'GW','color'=>'bg-pink-600'],
            ['name'=>'Brian Otieno','role'=>'Student, kaimosi','rating'=>5,'text'=>'Best price I found in kaimosi. HP Pavilion came with a proper warranty card and they threw in a free laptop bag. Highly recommend!','initials'=>'BO','color'=>'bg-emerald-600'],
        ] as $t)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-lg transition relative">
                <div class="absolute top-5 right-5 text-5xl text-slate-100 font-serif select-none leading-none">"</div>
                <div class="flex items-center gap-0.5 mb-4">
                    @for($i=0;$i<$t['rating'];$i++)<svg class="w-4 h-4 text-amber-400 fill-amber-400" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                </div>
                <p class="text-slate-600 text-sm leading-relaxed mb-5">{{ $t['text'] }}</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 {{ $t['color'] }} rounded-full flex items-center justify-center text-white text-sm font-bold shadow-sm">{{ $t['initials'] }}</div>
                    <div><p class="font-bold text-slate-900 text-sm">{{ $t['name'] }}</p><p class="text-xs text-slate-400">{{ $t['role'] }}</p></div>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-xs text-emerald-600 font-bold">Verified Purchase</span>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center mt-8">
        <a href="{{ route('reviews') }}" class="text-blue-600 hover:text-blue-700 font-bold text-sm flex items-center justify-center gap-1">
            Read all reviews
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>

{{-- ══════════════════════ CTA ══════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 pb-16">
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-3xl p-10 md:p-14 text-white text-center relative overflow-hidden shadow-2xl shadow-blue-500/20">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 80% 50%, white 0%, transparent 60%);"></div>
        <span class="relative text-blue-200 text-xs font-bold uppercase tracking-widest mb-3 block">Ready to Upgrade?</span>
        <h2 class="relative font-display font-bold text-3xl md:text-5xl mb-4">Find your perfect device</h2>
        <p class="relative text-blue-100 text-lg mb-8 max-w-xl mx-auto">Browse our full catalogue and discover the best deals in Kenya. Our team is ready to help you choose.</p>
        <div class="relative flex flex-wrap justify-center gap-4">
            <a href="{{ route('products') }}" class="bg-white text-blue-700 hover:bg-blue-50 px-8 py-3.5 rounded-xl font-bold transition shadow-lg text-sm">Browse Products</a>
            <a href="{{ route('contact') }}" class="border-2 border-white/40 hover:border-white text-white px-8 py-3.5 rounded-xl font-bold transition text-sm">Talk to an Expert</a>
        </div>
    </div>
</section>

{{-- Carousel JS — auto-advance every 2 seconds --}}
<script>
(function() {
    let current = 0;
    const total = 3;
    const track = document.getElementById('carousel-track');
    const dots  = document.querySelectorAll('.carousel-dot');
    const counter = document.getElementById('slide-counter');
    let timer;

    function show(n) {
        current = (n + total) % total;
        track.style.transform = 'translateX(-' + (current * 33.333) + '%)';
        dots.forEach((d, i) => {
            d.style.width      = i === current ? '24px' : '10px';
            d.style.background = i === current ? 'white' : 'rgba(255,255,255,0.4)';
        });
        if (counter) counter.textContent = (current + 1) + ' / ' + total;
    }

    function nextSlide()  { show(current + 1); resetTimer(); }
    function prevSlide()  { show(current - 1); resetTimer(); }
    function goTo(n)      { show(n);           resetTimer(); }

    function resetTimer() {
        clearInterval(timer);
        timer = setInterval(function() { show(current + 1); }, 2000);
    }

    // Expose to HTML onclick
    window.nextSlide = nextSlide;
    window.prevSlide = prevSlide;
    window.goTo      = goTo;

    // Init
    show(0);
    timer = setInterval(function() { show(current + 1); }, 2000);

    // Pause on hover
    const section = track.closest('section');
    if (section) {
        section.addEventListener('mouseenter', function() { clearInterval(timer); });
        section.addEventListener('mouseleave', resetTimer);
    }
})();
</script>

@endsection