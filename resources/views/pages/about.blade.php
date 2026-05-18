@extends('layouts.app')
@section('title', 'About Us — Zinlink Tech Kenya')

@section('content')

<div class="bg-slate-950 text-white">

{{-- Hero --}}
<section class="bg-gradient-to-br from-black via-slate-950 to-blue-950 py-20 md:py-24 relative overflow-hidden border-b border-slate-800">

    <div class="absolute inset-0 opacity-20"
         style="background-image: radial-gradient(circle at 70% 50%, #2563eb 0%, transparent 60%);">
    </div>

    <div class="max-w-5xl mx-auto px-4 text-center relative z-10">

        <span class="text-blue-400 text-xs font-bold uppercase tracking-[0.3em] mb-4 block">
            Our Story
        </span>

        <h1 class="font-display font-black text-4xl sm:text-5xl md:text-7xl mb-6 tracking-tight">
            About Zinlink Tech
        </h1>

        <p class="text-slate-300 text-base sm:text-lg md:text-xl leading-relaxed max-w-3xl mx-auto">
            A trusted tech retailer in Kenya — built on transparency,
            genuine products, and a passion for bringing the best technology
            to Kenyan businesses, students, and professionals.
        </p>

    </div>

</section>

{{-- Story + Stats --}}
<section class="bg-slate-950 py-20 border-b border-slate-900">

    <div class="max-w-7xl mx-auto px-4">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">

            {{-- Left --}}
            <div>

                <span class="text-blue-400 text-xs font-bold uppercase tracking-[0.25em] mb-3 block">
                    Who We Are
                </span>

                <h2 class="font-display font-bold text-3xl sm:text-4xl md:text-5xl text-white mb-6 leading-tight">
                    Started Small,
                    <br class="hidden md:block">
                    Now Serving All of Kenya
                </h2>

                <div class="space-y-5 text-slate-400 leading-relaxed text-sm md:text-base">

                    <p>
                        Founded in December 2023 by Onyango Willis and Ndago Isaiah,
                        Zinlink Tech has grown into a trusted destination
                        for laptops, repairs, and premium computer accessories.
                    </p>

                    <p>
                        We believe technology should be reliable,
                        affordable, and accessible.
                        Whether you're upgrading your setup,
                        repairing a device, or buying your first laptop,
                        we provide honest service and real support.
                    </p>

                    <p>
                        Our team helps students, creatives,
                        professionals, gamers, and businesses
                        choose the right technology every day.
                    </p>

                </div>

                <div class="mt-10 flex flex-col sm:flex-row gap-4">

                    <a href="{{ route('products') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-7 py-3 rounded-2xl font-bold text-sm text-center transition shadow-lg shadow-blue-900/40">
                        Browse Products
                    </a>

                    <a href="{{ route('contact') }}"
                       class="border border-slate-700 hover:border-blue-500 hover:text-blue-400 text-slate-300 px-7 py-3 rounded-2xl font-bold text-sm text-center transition">
                        Contact Us
                    </a>

                </div>

            </div>

            {{-- Right Stats --}}
            <div class="grid grid-cols-2 gap-4 sm:gap-5">

                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 text-center hover:border-blue-500/40 transition">
                    <p class="font-display font-black text-3xl sm:text-5xl text-blue-500 mb-2">
                        2023
                    </p>
                    <p class="text-slate-400 text-xs sm:text-sm font-semibold uppercase tracking-wide">
                        Founded
                    </p>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 text-center hover:border-emerald-500/40 transition">
                    <p class="font-display font-black text-3xl sm:text-5xl text-emerald-500 mb-2">
                        1,200+
                    </p>
                    <p class="text-slate-400 text-xs sm:text-sm font-semibold uppercase tracking-wide">
                        Customers
                    </p>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 text-center hover:border-amber-500/40 transition">
                    <p class="font-display font-black text-3xl sm:text-5xl text-amber-500 mb-2">
                        350+
                    </p>
                    <p class="text-slate-400 text-xs sm:text-sm font-semibold uppercase tracking-wide">
                        Products
                    </p>
                </div>

                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8 text-center hover:border-purple-500/40 transition">
                    <p class="font-display font-black text-3xl sm:text-5xl text-purple-500 mb-2">
                        4.9★
                    </p>
                    <p class="text-slate-400 text-xs sm:text-sm font-semibold uppercase tracking-wide">
                        Rating
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>

{{-- Values --}}
<section class="bg-black py-20 border-y border-slate-900">

    <div class="max-w-7xl mx-auto px-4">

        <div class="text-center mb-14">

            <span class="text-blue-400 text-xs font-bold uppercase tracking-[0.3em] mb-3 block">
                What We Stand For
            </span>

            <h2 class="font-display font-black text-3xl sm:text-4xl text-white">
                Our Core Values
            </h2>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">

            @foreach([
                ['icon'=>'🔒','title'=>'Authenticity First','desc'=>'Every device is sourced from verified distributors with genuine warranty support.','color'=>'border-blue-500/20 bg-blue-500/5'],
                ['icon'=>'💰','title'=>'Fair Pricing','desc'=>'Competitive pricing with transparent value and no unnecessary markups.','color'=>'border-emerald-500/20 bg-emerald-500/5'],
                ['icon'=>'🤝','title'=>'Customer First','desc'=>'We build long-term relationships through honest advice and support.','color'=>'border-amber-500/20 bg-amber-500/5'],
            ] as $v)

            <div class="rounded-3xl border {{ $v['color'] }} p-8 backdrop-blur-xl hover:-translate-y-2 transition-all duration-500">

                <div class="text-5xl mb-5">{{ $v['icon'] }}</div>

                <h3 class="font-display font-bold text-white text-2xl mb-3">
                    {{ $v['title'] }}
                </h3>

                <p class="text-slate-400 leading-relaxed text-sm">
                    {{ $v['desc'] }}
                </p>

            </div>

            @endforeach

        </div>

    </div>

</section>

{{-- Team --}}
@if($team->count())

<section class="bg-slate-950 py-20">

    <div class="max-w-7xl mx-auto px-4">

        <div class="text-center mb-14">

            <span class="text-blue-400 text-xs font-bold uppercase tracking-[0.3em] mb-3 block">
                The People Behind Zinlink Tech
            </span>

            <h2 class="font-display font-black text-3xl sm:text-4xl text-white">
                Meet Our Team
            </h2>

            <p class="text-slate-500 mt-3">
                The experts powering Zinlink Tech every day
            </p>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach($team as $member)

            <div class="group overflow-hidden rounded-3xl bg-slate-900 border border-slate-800 shadow-xl transition-all duration-500 hover:-translate-y-2 hover:border-blue-500/40">

                <div class="p-6 sm:p-8 text-center">

                    <div class="relative mx-auto mb-6 flex justify-center">

                        @if($member->photo)

                        <div class="h-40 w-40 overflow-hidden rounded-3xl border-4 border-slate-800 shadow-2xl">
                            <img src="{{ asset('storage/'.$member->photo) }}"
                                 alt="{{ $member->name }}"
                                 loading="lazy"
                                 class="h-full w-full object-cover object-top transition duration-500 group-hover:scale-105">
                        </div>

                        @else

                        <div class="flex h-40 w-40 items-center justify-center rounded-3xl bg-gradient-to-br from-blue-600 to-indigo-700 text-5xl font-black text-white shadow-2xl">
                            {{ $member->initials ?: strtoupper(substr($member->name ?? 'ZN',0,2)) }}
                        </div>

                        @endif

                    </div>

                    <h3 class="text-xl sm:text-2xl font-bold text-white break-words">
                        {{ $member->name }}
                    </h3>

                    <p class="mt-2 text-xs sm:text-sm font-bold uppercase tracking-[0.15em] text-blue-400 break-words">
                        {{ $member->role }}
                    </p>

                    @if($member->bio)
                    <p class="mt-4 text-sm leading-relaxed text-slate-400 break-words">
                        {{ $member->bio }}
                    </p>
                    @endif

                    @if($member->phone || $member->email)
                    <div class="mt-6 space-y-3 border-t border-slate-800 pt-5">

                        @if($member->phone)
                        <a href="tel:{{ $member->phone }}"
                           class="flex flex-wrap items-center justify-center gap-2 rounded-2xl bg-slate-800 px-3 py-3 text-xs sm:text-sm font-medium text-slate-300 transition hover:bg-blue-600 hover:text-white">
                            📞 {{ $member->phone }}
                        </a>
                        @endif

                        @if($member->email)
                        <a href="mailto:{{ $member->email }}"
                           class="flex flex-wrap items-center justify-center gap-2 rounded-2xl bg-slate-800 px-3 py-3 text-xs sm:text-sm font-medium text-slate-300 break-all transition hover:bg-indigo-600 hover:text-white">
                            ✉️ {{ $member->email }}
                        </a>
                        @endif

                    </div>
                    @endif

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>

@endif

{{-- CTA --}}
<section class="bg-gradient-to-r from-blue-700 via-indigo-700 to-purple-700 py-16 text-center">

    <div class="max-w-3xl mx-auto px-4">

        <h2 class="font-display font-black text-3xl sm:text-4xl mb-4 text-white">
            Ready to shop with us?
        </h2>

        <p class="text-blue-100 text-base sm:text-lg mb-8">
            Join hundreds of satisfied Kenyans who trust Zinlink Tech for quality technology.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-4">

            <a href="{{ route('products') }}"
               class="bg-white text-blue-700 hover:bg-slate-100 px-8 py-4 rounded-2xl font-bold transition shadow-2xl text-sm">
                Browse Products
            </a>

            <a href="{{ route('contact') }}"
               class="border border-white/30 hover:border-white text-white px-8 py-4 rounded-2xl font-bold transition text-sm">
                Contact Us
            </a>

        </div>

    </div>

</section>

</div>

@endsection