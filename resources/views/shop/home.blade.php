@extends('layouts.app')
@section('title', 'zinlinktech — Premium Laptops & Tech in Kenya')

@section('content')

<style>
    html,
    body {
        overflow-x: hidden;
        background: #020617;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

{{-- ══════════════════════ HERO CAROUSEL ══════════════════════ --}}
<section class="relative overflow-hidden min-h-[520px] sm:min-h-[580px] lg:h-[580px]">

    <div id="carousel-track"
         class="flex h-full w-full transition-transform duration-700 ease-in-out">

        {{-- ───────────────── SLIDE 1 ───────────────── --}}
        <div class="relative min-w-full h-full">

            <img src="https://images.pexels.com/photos/1181354/pexels-photo-1181354.jpeg?auto=compress&cs=tinysrgb&w=1600"
                 class="absolute inset-0 w-full h-full object-cover"
                 alt="Laptop">

            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-900/70 to-transparent"></div>

            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-5 w-full">

                    <div class="max-w-2xl">

                        <span class="inline-flex items-center gap-2 bg-blue-500/20 border border-blue-400/30 text-blue-300 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest mb-5">
                            🔥 New Arrivals
                        </span>

                        <h1 class="font-black text-white leading-tight mb-5"
                            style="font-size: clamp(2rem, 6vw, 4.5rem);">
                            MacBook Pro
                            <span class="text-blue-400 block">M3 Series</span>
                        </h1>

                        <p class="text-slate-300 text-base sm:text-lg leading-relaxed mb-8 max-w-xl">
                            Experience unmatched performance with Apple Silicon.
                            Perfect for creators, developers, and professionals.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 mb-10">

                            <a href="{{ route('products') }}"
                               class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-bold transition text-center">
                                Shop Laptops →
                            </a>

                            <a href="{{ route('about') }}"
                               class="w-full sm:w-auto border border-white/20 hover:border-white/40 text-white px-8 py-4 rounded-2xl font-bold transition text-center backdrop-blur">
                                Learn More
                            </a>

                        </div>

                        <div class="flex items-center gap-6 overflow-x-auto scrollbar-hide pb-2">

                            <div class="flex-shrink-0">
                                <p class="text-2xl font-black text-white">KES 245K</p>
                                <p class="text-xs text-slate-400">Starting price</p>
                            </div>

                            <div class="w-px h-10 bg-white/20"></div>

                            <div class="flex-shrink-0">
                                <p class="text-2xl font-black text-white">22HR</p>
                                <p class="text-xs text-slate-400">Battery life</p>
                            </div>

                            <div class="w-px h-10 bg-white/20"></div>

                            <div class="flex-shrink-0">
                                <p class="text-2xl font-black text-white">M3 PRO</p>
                                <p class="text-xs text-slate-400">Apple Silicon</p>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        {{-- ───────────────── SLIDE 2 ───────────────── --}}
        <div class="relative min-w-full h-full">

            <img src="https://images.pexels.com/photos/1181675/pexels-photo-1181675.jpeg?auto=compress&cs=tinysrgb&w=1600"
                 class="absolute inset-0 w-full h-full object-cover"
                 alt="Dell XPS">

            <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/95 via-slate-900/70 to-transparent"></div>

            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-5 w-full">

                    <div class="max-w-2xl">

                        <span class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest mb-5">
                            💻 Premium Choice
                        </span>

                        <h1 class="font-black text-white leading-tight mb-5"
                            style="font-size: clamp(2rem, 6vw, 4.5rem);">
                            Dell XPS 15
                            <span class="text-emerald-400 block">4K OLED</span>
                        </h1>

                        <p class="text-slate-300 text-base sm:text-lg leading-relaxed mb-8 max-w-xl">
                            Stunning visuals, powerful Intel performance,
                            and all-day productivity.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('products') }}"
                               class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-4 rounded-2xl font-bold transition text-center">
                                Explore →
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        {{-- ───────────────── SLIDE 3 ───────────────── --}}
        <div class="relative min-w-full h-full">

            <img src="https://images.pexels.com/photos/3861968/pexels-photo-3861968.jpeg?auto=compress&cs=tinysrgb&w=1600"
                 class="absolute inset-0 w-full h-full object-cover"
                 alt="HP Pavilion">

            <div class="absolute inset-0 bg-gradient-to-r from-purple-950/95 via-slate-900/70 to-transparent"></div>

            <div class="absolute inset-0 flex items-center">
                <div class="max-w-7xl mx-auto px-5 w-full">

                    <div class="max-w-2xl">

                        <span class="inline-flex items-center gap-2 bg-purple-500/20 border border-purple-400/30 text-purple-300 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest mb-5">
                            🎓 Student Deal
                        </span>

                        <h1 class="font-black text-white leading-tight mb-5"
                            style="font-size: clamp(2rem, 6vw, 4.5rem);">
                            HP Pavilion
                            <span class="text-purple-400 block">Affordable Power</span>
                        </h1>

                        <p class="text-slate-300 text-base sm:text-lg leading-relaxed mb-8 max-w-xl">
                            Fast, reliable and perfect for students,
                            office work and everyday productivity.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('products') }}"
                               class="w-full sm:w-auto bg-purple-600 hover:bg-purple-700 text-white px-8 py-4 rounded-2xl font-bold transition text-center">
                                Shop Now →
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- NAVIGATION --}}
    <button onclick="prevSlide()"
            class="hidden sm:flex absolute left-5 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white/10 backdrop-blur border border-white/20 items-center justify-center text-white hover:bg-white/20 transition">
        ←
    </button>

    <button onclick="nextSlide()"
            class="hidden sm:flex absolute right-5 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white/10 backdrop-blur border border-white/20 items-center justify-center text-white hover:bg-white/20 transition">
        →
    </button>

    {{-- DOTS --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-20">
        <button onclick="goTo(0)" class="carousel-dot w-8 h-2 rounded-full bg-white"></button>
        <button onclick="goTo(1)" class="carousel-dot w-2 h-2 rounded-full bg-white/40"></button>
        <button onclick="goTo(2)" class="carousel-dot w-2 h-2 rounded-full bg-white/40"></button>
    </div>

</section>

{{-- ══════════════════════ FEATURED PRODUCTS ══════════════════════ --}}
@if($featured->count())

<section class="bg-slate-950 py-16">

    <div class="max-w-7xl mx-auto px-4">

        <div class="mb-10">
            <span class="text-blue-400 text-xs font-bold uppercase tracking-widest block mb-2">
                Featured Products
            </span>

            <h2 class="text-3xl sm:text-4xl font-black text-white">
                Top Picks For You
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach($featured as $product)

                <div class="h-full flex flex-col bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden hover:border-blue-500/50 transition hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/10 duration-300">

                    <a href="{{ route('product.show', $product->id) }}"
                       class="block overflow-hidden">

                        <div class="h-56 sm:h-64 bg-slate-800 overflow-hidden">

                            @if($product->image)

                                <img src="{{ asset('storage/'.$product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover hover:scale-110 transition duration-700">

                            @endif

                        </div>

                    </a>

                    <div class="p-5 flex flex-col flex-1">

                        <span class="text-xs font-bold uppercase tracking-widest text-blue-400 mb-2">
                            {{ $product->category }}
                        </span>

                        <h3 class="text-white font-bold text-lg leading-snug mb-3 line-clamp-2">
                            {{ $product->name }}
                        </h3>

                        <div class="mt-auto flex items-center justify-between">

                            <span class="text-white font-black text-xl">
                                KES {{ number_format($product->price) }}
                            </span>

                            <a href="{{ route('product.show', $product->id) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm font-bold transition">
                                View
                            </a>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endif

{{-- ══════════════════════ JS ══════════════════════ --}}
<script>
    (() => {

        let current = 0;
        const total = 3;

        const track = document.getElementById('carousel-track');
        const dots = document.querySelectorAll('.carousel-dot');

        let auto;

        function updateDots() {

            dots.forEach((dot, index) => {

                if(index === current) {
                    dot.classList.add('w-8','bg-white');
                    dot.classList.remove('w-2','bg-white/40');
                } else {
                    dot.classList.remove('w-8','bg-white');
                    dot.classList.add('w-2','bg-white/40');
                }

            });

        }

        function showSlide(index) {

            current = (index + total) % total;

            track.style.transform = `translateX(-${current * 100}%)`;

            updateDots();
        }

        function nextSlide() {
            showSlide(current + 1);
            restart();
        }

        function prevSlide() {
            showSlide(current - 1);
            restart();
        }

        function goTo(index) {
            showSlide(index);
            restart();
        }

        function restart() {
            clearInterval(auto);
            auto = setInterval(() => {
                showSlide(current + 1);
            }, 5000);
        }

        window.nextSlide = nextSlide;
        window.prevSlide = prevSlide;
        window.goTo = goTo;

        showSlide(0);
        restart();

    })();
</script>

@endsection