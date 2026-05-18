@extends('layouts.app')
@section('title', 'zinlinktech — Premium Laptops & Tech in Kenya')

@section('content')

{{-- ══════════════════════ HERO CAROUSEL ══════════════════════ --}}

<section class="relative overflow-hidden" style="height: clamp(420px, 60vw, 580px);">

    <div id="carousel-track" class="flex h-full transition-transform duration-700 ease-in-out" style="width: 300%;">

        {{-- ── SLIDE 1 —— MacBook Pro ── --}}
        <div class="relative flex-shrink-0 h-full" style="width: 33.333%;">
            <img src="https://images.pexels.com/photos/1181354/pexels-photo-1181354.jpeg?auto=compress&cs=tinysrgb&w=1200&h=800&dpr=2"
                 alt="Person working on laptop"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(10,15,40,0.92) 0%, rgba(10,15,40,0.60) 60%, rgba(10,15,40,0.10) 100%);"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-5 sm:px-6 w-full">
                    <div class="max-w-lg">
                        <span class="inline-flex items-center gap-2 bg-blue-500/20 border border-blue-400/40 text-blue-300 text-xs font-bold px-3 sm:px-4 py-1.5 rounded-full uppercase tracking-widest mb-3 sm:mb-5">
                            🔥 2024 New Arrivals
                        </span>
                        <h1 class="font-display font-bold text-white leading-tight mb-3 sm:mb-4"
                            style="font-size: clamp(1.5rem, 5vw, 3.5rem);">
                            MacBook Pro<br>
                            <span class="text-blue-400">M3 Series</span>
                        </h1>
                        <p class="text-slate-300 leading-relaxed mb-5 sm:mb-8 hidden sm:block"
                           style="font-size: clamp(0.8rem, 2vw, 1.125rem);">
                            Breakthrough performance for creators and developers. The M3 chip redefines what a laptop can do.
                        </p>
                        <div class="flex flex-wrap gap-2 sm:gap-4 mb-5 sm:mb-8">
                            <a href="{{ route('products') }}?category=Laptops"
                               class="bg-blue-600 hover:bg-blue-500 active:bg-blue-700 text-white px-5 sm:px-7 py-2.5 sm:py-3.5 rounded-xl font-bold transition shadow-2xl shadow-blue-500/30 text-xs sm:text-sm">
                                Shop Laptops →
                            </a>
                            <a href="{{ route('about') }}"
                               class="border border-white/25 hover:border-white/50 backdrop-blur-sm text-white px-5 sm:px-7 py-2.5 sm:py-3.5 rounded-xl font-semibold transition text-xs sm:text-sm">
                                Our Guarantee
                            </a>
                        </div>
                        {{-- Stats: scrollable row on mobile --}}
                        <div class="flex items-center gap-4 sm:gap-6 overflow-x-auto pb-1 scrollbar-hide">
                            <div class="text-center flex-shrink-0">
                                <p class="font-display font-bold text-white" style="font-size:clamp(1rem,3vw,1.5rem);">KES 245K</p>
                                <p class="text-xs text-slate-400 mt-0.5 whitespace-nowrap">Starting from</p>
                            </div>
                            <div class="w-px h-8 bg-white/20 flex-shrink-0"></div>
                            <div class="text-center flex-shrink-0">
                                <p class="font-display font-bold text-white" style="font-size:clamp(1rem,3vw,1.5rem);">M3 Pro</p>
                                <p class="text-xs text-slate-400 mt-0.5 whitespace-nowrap">Apple Silicon</p>
                            </div>
                            <div class="w-px h-8 bg-white/20 flex-shrink-0"></div>
                            <div class="text-center flex-shrink-0">
                                <p class="font-display font-bold text-white" style="font-size:clamp(1rem,3vw,1.5rem);">22hr</p>
                                <p class="text-xs text-slate-400 mt-0.5 whitespace-nowrap">Battery life</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SLIDE 2 —— Dell XPS 15 ── --}}
        <div class="relative flex-shrink-0 h-full" style="width: 33.333%;">
            <img src="https://images.pexels.com/photos/1181675/pexels-photo-1181675.jpeg?auto=compress&cs=tinysrgb&w=1200&h=800&dpr=2"
                 alt="Network server setup"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(5,20,5,0.92) 0%, rgba(5,20,5,0.60) 60%, rgba(5,20,5,0.10) 100%);"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-5 sm:px-6 w-full">
                    <div class="max-w-lg">
                        <span class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 text-xs font-bold px-3 sm:px-4 py-1.5 rounded-full uppercase tracking-widest mb-3 sm:mb-5">
                            💰 Best Value Pick
                        </span>
                        <h1 class="font-display font-bold text-white leading-tight mb-3 sm:mb-4"
                            style="font-size: clamp(1.5rem, 5vw, 3.5rem);">
                            Dell XPS 15<br>
                            <span class="text-emerald-400">4K OLED Power</span>
                        </h1>
                        <p class="text-slate-300 leading-relaxed mb-5 sm:mb-8 hidden sm:block"
                           style="font-size: clamp(0.8rem, 2vw, 1.125rem);">
                            Intel i7 Gen 13, stunning 4K OLED display, 16GB RAM. Built for professionals who demand the best tools.
                        </p>
                        <div class="flex flex-wrap gap-2 sm:gap-4 mb-5 sm:mb-8">
                            <a href="{{ route('products') }}?category=Laptops"
                               class="bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 text-white px-5 sm:px-7 py-2.5 sm:py-3.5 rounded-xl font-bold transition shadow-2xl shadow-emerald-500/30 text-xs sm:text-sm">
                                Shop Now →
                            </a>
                            <a href="{{ route('contact') }}"
                               class="border border-white/25 hover:border-white/50 backdrop-blur-sm text-white px-5 sm:px-7 py-2.5 sm:py-3.5 rounded-xl font-semibold transition text-xs sm:text-sm">
                                Ask an Expert
                            </a>
                        </div>
                        <div class="flex items-center gap-4 sm:gap-6 overflow-x-auto pb-1 scrollbar-hide">
                            <div class="text-center flex-shrink-0">
                                <p class="font-display font-bold text-white" style="font-size:clamp(1rem,3vw,1.5rem);">KES 185K</p>
                                <p class="text-xs text-slate-400 mt-0.5 whitespace-nowrap">Starting from</p>
                            </div>
                            <div class="w-px h-8 bg-white/20 flex-shrink-0"></div>
                            <div class="text-center flex-shrink-0">
                                <p class="font-display font-bold text-white" style="font-size:clamp(1rem,3vw,1.5rem);">4K OLED</p>
                                <p class="text-xs text-slate-400 mt-0.5 whitespace-nowrap">Display</p>
                            </div>
                            <div class="w-px h-8 bg-white/20 flex-shrink-0"></div>
                            <div class="text-center flex-shrink-0">
                                <p class="font-display font-bold text-white" style="font-size:clamp(1rem,3vw,1.5rem);">i7-13th</p>
                                <p class="text-xs text-slate-400 mt-0.5 whitespace-nowrap">Processor</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── SLIDE 3 —— HP Pavilion ── --}}
        <div class="relative flex-shrink-0 h-full" style="width: 33.333%;">
            <img src="https://images.pexels.com/photos/3861968/pexels-photo-3861968.jpeg?auto=compress&cs=tinysrgb&w=1200&h=800&dpr=2"
                 alt="Gaming laptop desk setup"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(25,5,50,0.92) 0%, rgba(25,5,50,0.60) 60%, rgba(25,5,50,0.10) 100%);"></div>
            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-5 sm:px-6 w-full">
                    <div class="max-w-lg">
                        <span class="inline-flex items-center gap-2 bg-purple-500/20 border border-purple-400/40 text-purple-300 text-xs font-bold px-3 sm:px-4 py-1.5 rounded-full uppercase tracking-widest mb-3 sm:mb-5">
                            🎓 Student Deal
                        </span>
                        <h1 class="font-display font-bold text-white leading-tight mb-3 sm:mb-4"
                            style="font-size: clamp(1.5rem, 5vw, 3.5rem);">
                            HP Pavilion<br>
                            <span class="text-purple-400">Affordable Power</span>
                        </h1>
                        <p class="text-slate-300 leading-relaxed mb-5 sm:mb-8 hidden sm:block"
                           style="font-size: clamp(0.8rem, 2vw, 1.125rem);">
                            AMD Ryzen 5, fast SSD, 15.6" FHD display. The perfect laptop for students and everyday professionals.
                        </p>
                        <div class="flex flex-wrap gap-2 sm:gap-4 mb-5 sm:mb-8">
                            <a href="{{ route('products') }}?category=Laptops"
                               class="bg-purple-600 hover:bg-purple-500 active:bg-purple-700 text-white px-5 sm:px-7 py-2.5 sm:py-3.5 rounded-xl font-bold transition shadow-2xl shadow-purple-500/30 text-xs sm:text-sm">
                                Shop Laptops →
                            </a>
                            <a href="{{ route('reviews') }}"
                               class="border border-white/25 hover:border-white/50 backdrop-blur-sm text-white px-5 sm:px-7 py-2.5 sm:py-3.5 rounded-xl font-semibold transition text-xs sm:text-sm">
                                See Reviews
                            </a>
                        </div>
                        <div class="flex items-center gap-4 sm:gap-6 overflow-x-auto pb-1 scrollbar-hide">
                            <div class="text-center flex-shrink-0">
                                <p class="font-display font-bold text-white" style="font-size:clamp(1rem,3vw,1.5rem);">KES 65K</p>
                                <p class="text-xs text-slate-400 mt-0.5 whitespace-nowrap">Starting from</p>
                            </div>
                            <div class="w-px h-8 bg-white/20 flex-shrink-0"></div>
                            <div class="text-center flex-shrink-0">
                                <p class="font-display font-bold text-white" style="font-size:clamp(1rem,3vw,1.5rem);">Ryzen 5</p>
                                <p class="text-xs text-slate-400 mt-0.5 whitespace-nowrap">AMD Processor</p>
                            </div>
                            <div class="w-px h-8 bg-white/20 flex-shrink-0"></div>
                            <div class="text-center flex-shrink-0">
                                <p class="font-display font-bold text-white" style="font-size:clamp(1rem,3vw,1.5rem);">256GB</p>
                                <p class="text-xs text-slate-400 mt-0.5 whitespace-nowrap">Fast SSD</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Prev / Next — hidden on xs, visible sm+ --}}
    <button onclick="prevSlide()"
            class="hidden sm:flex absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-11 sm:h-11 bg-white/10 hover:bg-white/25 active:bg-white/40 backdrop-blur-sm border border-white/20 rounded-full items-center justify-center text-white transition z-20"
            aria-label="Previous slide">
        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button onclick="nextSlide()"
            class="hidden sm:flex absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-11 sm:h-11 bg-white/10 hover:bg-white/25 active:bg-white/40 backdrop-blur-sm border border-white/20 rounded-full items-center justify-center text-white transition z-20"
            aria-label="Next slide">
        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- Dots --}}
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 z-20">
        <button onclick="goTo(0)" id="dot-0" class="carousel-dot h-1.5 rounded-full transition-all duration-300 bg-white" style="width:24px;" aria-label="Slide 1"></button>
        <button onclick="goTo(1)" id="dot-1" class="carousel-dot h-1.5 rounded-full transition-all duration-300 bg-white/40" style="width:10px;" aria-label="Slide 2"></button>
        <button onclick="goTo(2)" id="dot-2" class="carousel-dot h-1.5 rounded-full transition-all duration-300 bg-white/40" style="width:10px;" aria-label="Slide 3"></button>
    </div>

    <div class="absolute bottom-4 right-4 z-20 hidden sm:block">
        <span id="slide-counter" class="text-white/60 text-xs font-bold">1 / 3</span>
    </div>
</section>

{{-- ══════════════════════ TRUST BADGES ══════════════════════ --}}
<section class="bg-white border-b border-slate-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:py-4">
        {{-- 2-col on xs, 4-col on md --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
            @foreach([
                ['icon'=>'🚚','bg'=>'bg-blue-50',  'title'=>'Free Delivery',  'sub'=>'Over KES 50,000'],
                ['icon'=>'🛡️','bg'=>'bg-emerald-50','title'=>'1 Year Warranty','sub'=>'On all products'],
                ['icon'=>'💳','bg'=>'bg-amber-50',  'title'=>'M-Pesa & Card',  'sub'=>'Secure payments'],
                ['icon'=>'✅','bg'=>'bg-purple-50', 'title'=>'100% Genuine',   'sub'=>'Authentic only'],
            ] as $b)
                <div class="flex items-center gap-2 sm:gap-2.5 py-1.5 justify-start">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 {{ $b['bg'] }} rounded-xl flex items-center justify-center text-base sm:text-lg flex-shrink-0">{{ $b['icon'] }}</div>
                    <div>
                        <p class="text-xs font-bold text-slate-800 leading-tight">{{ $b['title'] }}</p>
                        <p class="text-xs text-slate-400 leading-tight hidden sm:block">{{ $b['sub'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════ STATS BAR ══════════════════════ --}}
<section class="bg-blue-600 text-white py-10 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 text-center">
        <div><p class="font-display font-bold text-3xl sm:text-4xl mb-1">1,200<span class="text-blue-300">+</span></p><p class="text-blue-100 text-xs sm:text-sm font-medium">Happy Customers</p></div>
        <div><p class="font-display font-bold text-3xl sm:text-4xl mb-1">350<span class="text-blue-300">+</span></p><p class="text-blue-100 text-xs sm:text-sm font-medium">Products</p></div>
        <div><p class="font-display font-bold text-3xl sm:text-4xl mb-1">4.9<span class="text-blue-300">★</span></p><p class="text-blue-100 text-xs sm:text-sm font-medium">Avg Rating</p></div>
        <div><p class="font-display font-bold text-3xl sm:text-4xl mb-1">5<span class="text-blue-300">yr</span></p><p class="text-blue-100 text-xs sm:text-sm font-medium">In Business</p></div>
    </div>
</section>

{{-- ══════════════════════ FEATURED PRODUCTS ══════════════════════ --}}
@if($featured->count())
<section class="max-w-7xl mx-auto px-4 py-12 sm:py-16">
    <div class="flex items-end justify-between mb-7 sm:mb-10">
        <div>
            <span class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-1 sm:mb-2 block">Handpicked For You</span>
            <h2 class="font-display font-bold text-2xl sm:text-3xl md:text-4xl text-slate-900">Featured Products</h2>
        </div>
        <a href="{{ route('products') }}" class="flex items-center gap-1.5 text-blue-600 hover:text-blue-700 font-bold text-xs sm:text-sm group flex-shrink-0 ml-4">
            View all
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    {{-- 1-col xs, 2-col sm, 4-col lg --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        @foreach($featured as $product)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 sm:hover:-translate-y-1.5 transition-all duration-300 overflow-hidden group flex flex-col">
                <a href="{{ route('product.show', $product->id) }}" class="relative block">
                    <div class="bg-slate-50 h-44 sm:h-48 flex items-center justify-center overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
                                 class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <svg class="w-14 h-14 sm:w-16 sm:h-16 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="p-3 sm:p-4 flex flex-col flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs text-blue-600 font-bold uppercase tracking-wide">{{ $product->category }}</span>
                        @if($product->brand)<span class="text-xs text-slate-400 truncate ml-1">{{ $product->brand }}</span>@endif
                    </div>
                    <a href="{{ route('product.show', $product->id) }}">
                        <h3 class="font-semibold text-slate-900 text-sm leading-snug mb-1 hover:text-blue-600 transition line-clamp-2">{{ $product->name }}</h3>
                    </a>
                    @if($product->specs)<p class="text-xs text-slate-400 mb-2 line-clamp-1">{{ $product->specs }}</p>@endif
                    <div class="flex items-center gap-0.5 mb-3">
                        @for($i=0;$i<5;$i++)<svg class="w-3 h-3 text-amber-400 fill-amber-400" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                    </div>
                    <div class="mt-auto flex items-center justify-between pt-3 border-t border-slate-100">
                        <span class="font-display font-bold text-slate-900 text-sm sm:text-base">KES {{ number_format($product->price) }}</span>
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button class="flex items-center gap-1 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-xs font-bold px-3 py-2 rounded-xl transition shadow-sm shadow-blue-500/20">
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

    <div class="text-center mt-8 sm:mt-10">
        <a href="{{ route('products') }}"
           class="inline-flex items-center gap-2 border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white active:bg-blue-700 px-6 sm:px-8 py-3 rounded-xl font-bold transition text-sm">
            Browse All Products
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>
@endif

{{-- ══════════════════════ CATEGORIES ══════════════════════ --}}
<section class="bg-slate-900 py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-8 sm:mb-10">
            <span class="text-blue-400 text-xs font-bold uppercase tracking-widest mb-2 block">Shop by Category</span>
            <h2 class="font-display font-bold text-2xl sm:text-3xl text-white">Find What You Need</h2>
        </div>
        {{-- 2-col on mobile, 4-col on md --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
            @foreach([
                ['name'=>'Laptops',     'icon'=>'💻','from'=>'from-blue-600','to'=>'to-blue-800',     'desc'=>'Work & gaming'],
                ['name'=>'Accessories', 'icon'=>'🖱️','from'=>'from-emerald-600','to'=>'to-emerald-800','desc'=>'Mice, keyboards & more'],
                ['name'=>'Monitors',    'icon'=>'🖥️','from'=>'from-purple-600','to'=>'to-purple-800',  'desc'=>'4K & ultrawide'],
                ['name'=>'Components',  'icon'=>'🔧','from'=>'from-orange-600','to'=>'to-orange-800',  'desc'=>'RAM, SSD, GPU'],
            ] as $cat)
                <a href="{{ route('products') }}?category={{ $cat['name'] }}"
                   class="group bg-gradient-to-br {{ $cat['from'] }} {{ $cat['to'] }} rounded-2xl p-4 sm:p-6 hover:scale-105 active:scale-95 transition-transform duration-300 shadow-lg border border-white/10 text-center">
                    <div class="text-3xl sm:text-4xl mb-2 sm:mb-3">{{ $cat['icon'] }}</div>
                    <h3 class="font-display font-bold text-white text-base sm:text-lg mb-0.5 sm:mb-1">{{ $cat['name'] }}</h3>
                    <p class="text-white/60 text-xs hidden sm:block">{{ $cat['desc'] }}</p>
                    <div class="mt-3 sm:mt-4 inline-flex items-center gap-1 text-white/80 group-hover:text-white text-xs font-semibold transition">
                        Shop now <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════ LATEST ARRIVALS ══════════════════════ --}}
@if($latest->count())
<section class="max-w-7xl mx-auto px-4 py-12 sm:py-16">
    <div class="mb-7 sm:mb-10">
        <span class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-1 sm:mb-2 block">Just In</span>
        <h2 class="font-display font-bold text-2xl sm:text-3xl text-slate-900">Latest Arrivals</h2>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
        @foreach($latest as $product)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden group flex flex-col">
                <a href="{{ route('product.show', $product->id) }}" class="relative block">
                    <div class="bg-slate-50 h-36 sm:h-40 flex items-center justify-center overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
                                 class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        @endif
                    </div>
                    <span class="absolute top-2 left-2 bg-blue-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">New</span>
                </a>
                <div class="p-3 sm:p-4 flex-1 flex flex-col">
                    <span class="text-xs text-blue-600 font-bold uppercase tracking-wide">{{ $product->category }}</span>
                    <a href="{{ route('product.show', $product->id) }}">
                        <h3 class="font-semibold text-slate-900 mt-1 hover:text-blue-600 transition line-clamp-2 text-xs sm:text-sm flex-1">{{ $product->name }}</h3>
                    </a>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="font-display font-bold text-slate-900 text-sm">KES {{ number_format($product->price) }}</span>
                        <a href="{{ route('product.show', $product->id) }}" class="text-blue-600 text-xs font-bold hover:underline">View →</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

{{-- ══════════════════════ WHY CHOOSE US ══════════════════════ --}}
<section class="bg-gradient-to-br from-slate-50 to-blue-50 py-12 sm:py-16 border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-8 sm:mb-12">
            <span class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-2 block">Why zinlinktech?</span>
            <h2 class="font-display font-bold text-2xl sm:text-3xl text-slate-900">Built on Trust</h2>
        </div>
        {{-- 1-col xs, 3-col md --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 sm:gap-7">
            @foreach([
                ['icon'=>'🔒','bg'=>'bg-blue-50',   'title'=>'100% Genuine Products',     'desc'=>'Every product comes with official manufacturer warranty. We never sell refurbished items as new.'],
                ['icon'=>'📦','bg'=>'bg-emerald-50', 'title'=>'Same-Day Nairobi Delivery', 'desc'=>'Order before 2 PM and receive your purchase the same day in Nairobi. Countrywide within 48 hours.'],
                ['icon'=>'💬','bg'=>'bg-amber-50',   'title'=>'Expert Support 7 Days',     'desc'=>'Our tech-savvy team is available daily via WhatsApp, phone, or email to help you choose the right device.'],
            ] as $item)
                <div class="bg-white rounded-2xl p-5 sm:p-7 shadow-sm border border-slate-100 text-center hover:shadow-lg transition">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 {{ $item['bg'] }} rounded-2xl flex items-center justify-center text-2xl sm:text-3xl mx-auto mb-4 sm:mb-5">{{ $item['icon'] }}</div>
                    <h3 class="font-display font-bold text-base sm:text-lg text-slate-900 mb-2">{{ $item['title'] }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════ TESTIMONIALS ══════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 py-12 sm:py-16">
    <div class="text-center mb-8 sm:mb-12">
        <span class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-2 block">Customer Love</span>
        <h2 class="font-display font-bold text-2xl sm:text-3xl text-slate-900">What Customers Say</h2>
        <div class="flex items-center justify-center gap-1 mt-3">
            @for($i=0;$i<5;$i++)<svg class="w-4 h-4 sm:w-5 sm:h-5 text-amber-400 fill-amber-400" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
            <span class="text-slate-500 text-xs sm:text-sm ml-2 font-medium">4.9/5 from 1,200+ reviews</span>
        </div>
    </div>
    {{-- 1-col xs, 3-col md --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
        @foreach([
            ['name'=>'Martin Okello', 'role'=>'Software Developer, Nairobi',  'rating'=>5,'text'=>'Got my Dell XPS within 12 hours of ordering. Sealed box, genuine warranty card. zinlinktech is now my go-to for all tech purchases.','initials'=>'MO','color'=>'bg-blue-600'],
            ['name'=>'Grace Wanjiku', 'role'=>'Graphic Designer, Westlands',  'rating'=>5,'text'=>'I was nervous buying a MacBook online but these guys are legit. Sealed box, Apple Kenya sticker. The M3 is incredible for design work!','initials'=>'GW','color'=>'bg-pink-600'],
            ['name'=>'Brian Otieno',  'role'=>'Student, Kaimosi',             'rating'=>5,'text'=>'Best price I found in Kaimosi. HP Pavilion came with a proper warranty card and they threw in a free laptop bag. Highly recommend!','initials'=>'BO','color'=>'bg-emerald-600'],
        ] as $t)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 sm:p-6 hover:shadow-lg transition relative">
                <div class="absolute top-4 right-4 text-4xl sm:text-5xl text-slate-100 font-serif select-none leading-none">"</div>
                <div class="flex items-center gap-0.5 mb-3 sm:mb-4">
                    @for($i=0;$i<$t['rating'];$i++)<svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-amber-400 fill-amber-400" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                </div>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-4 sm:mb-5">{{ $t['text'] }}</p>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 {{ $t['color'] }} rounded-full flex items-center justify-center text-white text-xs sm:text-sm font-bold shadow-sm flex-shrink-0">{{ $t['initials'] }}</div>
                    <div>
                        <p class="font-bold text-slate-900 text-sm">{{ $t['name'] }}</p>
                        <p class="text-xs text-slate-400">{{ $t['role'] }}</p>
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-xs text-emerald-600 font-bold">Verified Purchase</span>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center mt-6 sm:mt-8">
        <a href="{{ route('reviews') }}" class="text-blue-600 hover:text-blue-700 font-bold text-sm flex items-center justify-center gap-1">
            Read all reviews
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>

{{-- ══════════════════════ CTA BANNER ══════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 pb-12 sm:pb-16">
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl sm:rounded-3xl p-8 sm:p-10 md:p-14 text-white text-center relative overflow-hidden shadow-2xl shadow-blue-500/20">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 80% 50%, white 0%, transparent 60%);"></div>
        <span class="relative text-blue-200 text-xs font-bold uppercase tracking-widest mb-2 sm:mb-3 block">Ready to Upgrade?</span>
        <h2 class="relative font-display font-bold text-2xl sm:text-3xl md:text-5xl mb-3 sm:mb-4">Find your perfect device</h2>
        <p class="relative text-blue-100 text-sm sm:text-lg mb-6 sm:mb-8 max-w-xl mx-auto">Browse our full catalogue and discover the best deals in Kenya. Our team is ready to help you choose.</p>
        <div class="relative flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
            <a href="{{ route('products') }}"
               class="bg-white text-blue-700 hover:bg-blue-50 active:bg-blue-100 px-7 sm:px-8 py-3 sm:py-3.5 rounded-xl font-bold transition shadow-lg text-sm">
                Browse Products
            </a>
            <a href="{{ route('contact') }}"
               class="border-2 border-white/40 hover:border-white active:bg-white/10 text-white px-7 sm:px-8 py-3 sm:py-3.5 rounded-xl font-bold transition text-sm">
                Talk to an Expert
            </a>
        </div>
    </div>
</section>

{{-- ══════════════════════ CAROUSEL JS ══════════════════════ --}}
<script>
(function() {
    let current = 0;
    const total = 3;
    const track = document.getElementById('carousel-track');
    const dots  = document.querySelectorAll('.carousel-dot');
    const counter = document.getElementById('slide-counter');
    let timer;
    let touchStartX = 0;

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
        timer = setInterval(() => show(current + 1), 4000);
    }

    window.nextSlide = nextSlide;
    window.prevSlide = prevSlide;
    window.goTo      = goTo;

    // Touch / swipe support for mobile
    const section = track.closest('section');
    if (section) {
        section.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
        section.addEventListener('touchend',   e => {
            const diff = touchStartX - e.changedTouches[0].screenX;
            if (Math.abs(diff) > 40) diff > 0 ? nextSlide() : prevSlide();
        }, { passive: true });
        section.addEventListener('mouseenter', () => clearInterval(timer));
        section.addEventListener('mouseleave', resetTimer);
    }

    show(0);
    timer = setInterval(() => show(current + 1), 4000);
})();
</script>

@endsection