@extends('layouts.app')
@section('title', 'About Us — zinlinktech Kenya')

@section('content')

{{-- Hero --}}
<section class="bg-slate-900 text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 70% 50%, #3b82f6 0%, transparent 60%);"></div>
    <div class="max-w-4xl mx-auto px-4 text-center relative">
        <span class="text-blue-400 text-xs font-bold uppercase tracking-widest mb-3 block">Our Story</span>
        <h1 class="font-display font-bold text-4xl md:text-6xl mb-5">About zinlinktech</h1>
        <p class="text-slate-300 text-lg leading-relaxed max-w-2xl mx-auto">
            Kenya's most trusted tech retailer — built on transparency, genuine products, and a passion for putting the best technology in Kenyan hands.
        </p>
    </div>
</section>

{{-- Story + Stats --}}
<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">
        <div>
            <span class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-3 block">Who We Are</span>
            <h2 class="font-display font-bold text-3xl md:text-4xl text-slate-900 mb-5">
                Started in a Small Shop,<br>Now Serving All of Kenya
            </h2>
            <div class="space-y-4 text-slate-600 leading-relaxed text-sm">
                <p> Zinlinktech was Founded in December 2023 by Onyango Willis and Ndago isaiah, Zinlink Tech is your trusted
                partner for all things computing. We specialize in laptop sales, professional repairs, and
                a wide selection of quality computer accessories.</p>
                <p>At Zinlink Tech, our mission is simple: to make technology reliable, accessible, and affordable.
                Whether you're dealing with a slow system, looking to upgrade your gear, or need expert advice,
                we're here to help with honest service and real solutions.</p>
                <p>Our team of tech experts is available every day to help you pick the right device — whether you're a student on a tight budget, a creative professional, or a business buying in bulk.</p>
            </div>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('products') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold text-sm transition shadow-lg shadow-blue-500/25">
                    Browse Products
                </a>
                <a href="{{ route('contact') }}" class="border-2 border-slate-300 text-slate-700 hover:border-blue-500 hover:text-blue-600 px-6 py-3 rounded-xl font-bold text-sm transition">
                    Contact Us
                </a>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-blue-50 rounded-2xl p-6 text-center border border-blue-100 hover:shadow-md transition">
                <p class="font-display font-bold text-4xl text-blue-600 mb-1">2023</p>
                <p class="text-slate-600 text-sm font-semibold">Founded</p>
            </div>
            <div class="bg-emerald-50 rounded-2xl p-6 text-center border border-emerald-100 hover:shadow-md transition">
                <p class="font-display font-bold text-4xl text-emerald-600 mb-1">1,200+</p>
                <p class="text-slate-600 text-sm font-semibold">Happy Customers</p>
            </div>
            <div class="bg-amber-50 rounded-2xl p-6 text-center border border-amber-100 hover:shadow-md transition">
                <p class="font-display font-bold text-4xl text-amber-600 mb-1">350+</p>
                <p class="text-slate-600 text-sm font-semibold">Products</p>
            </div>
            <div class="bg-purple-50 rounded-2xl p-6 text-center border border-purple-100 hover:shadow-md transition">
                <p class="font-display font-bold text-4xl text-purple-600 mb-1">4.9★</p>
                <p class="text-slate-600 text-sm font-semibold">Avg Rating</p>
            </div>
        </div>
    </div>
</section>

{{-- Values --}}
<section class="bg-slate-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-blue-400 text-xs font-bold uppercase tracking-widest mb-2 block">What We Stand For</span>
            <h2 class="font-display font-bold text-3xl text-white">Our Core Values</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['icon'=>'🔒','title'=>'Authenticity First','desc'=>'Every device is sourced from verified distributors. We provide genuine warranty cards and receipts for every single purchase.','color'=>'border-blue-500/30 bg-blue-500/10'],
                ['icon'=>'💰','title'=>'Fair Pricing','desc'=>'We keep our margins honest. Our prices are competitive because we work directly with distributors, cutting out unnecessary middlemen.','color'=>'border-emerald-500/30 bg-emerald-500/10'],
                ['icon'=>'🤝','title'=>'Customer First','desc'=>'We are not just a shop — we are your tech partner. We help you choose, set up, and support your device long after the sale.','color'=>'border-amber-500/30 bg-amber-500/10'],
            ] as $v)
                <div class="border {{ $v['color'] }} rounded-2xl p-7 hover:scale-105 transition-transform duration-300">
                    <div class="text-4xl mb-4">{{ $v['icon'] }}</div>
                    <h3 class="font-display font-bold text-white text-lg mb-2">{{ $v['title'] }}</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Team — loaded from DB --}}
@if($team->count())
<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <span class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-2 block">The People Behind zinlinktech</span>
        <h2 class="font-display font-bold text-3xl text-slate-900">Meet Our Team</h2>
        <p class="text-slate-500 mt-2 text-sm">The experts who make zinlinktech possible</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7">
        @foreach($team as $member)
        <div class="group overflow-hidden rounded-3xl bg-white border border-slate-200 shadow-lg transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl">

            <div class="p-8 text-center">

                {{-- Photo / Avatar --}}
                <div class="relative mx-auto mb-6 flex justify-center">

                    @if($member->photo)
                        <div class="h-40 w-40 overflow-hidden rounded-3xl shadow-xl border-4 border-slate-100">
                            <img src="{{ asset('storage/'.$member->photo) }}"
                                 alt="{{ $member->name }}"
                                 class="h-full w-full object-cover object-top transition duration-500 group-hover:scale-105">
                        </div>
                    @else
                        <div class="flex h-40 w-40 items-center justify-center rounded-3xl bg-gradient-to-br from-blue-500 to-indigo-600 text-5xl font-black text-white shadow-xl">
                            {{ $member->initials ?: strtoupper(substr($member->name,0,2)) }}
                        </div>
                    @endif

                </div>

                {{-- Name --}}
                <h3 class="text-2xl font-bold text-slate-900">
                    {{ $member->name }}
                </h3>

                {{-- Role --}}
                <p class="mt-2 text-sm font-bold uppercase tracking-[0.2em] text-blue-600">
                    {{ $member->role }}
                </p>

                {{-- Bio --}}
                @if($member->bio)
                    <p class="mt-5 text-sm leading-relaxed text-slate-600">
                        {{ $member->bio }}
                    </p>
                @endif

                {{-- Contact --}}
                @if($member->phone || $member->email)
                    <div class="mt-6 space-y-3 border-t border-slate-100 pt-5">

                        @if($member->phone)
                            <a href="tel:{{ $member->phone }}"
                               class="flex items-center justify-center gap-2 rounded-2xl bg-slate-100 px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-blue-600 hover:text-white">
                                📞 {{ $member->phone }}
                            </a>
                        @endif

                        @if($member->email)
                            <a href="mailto:{{ $member->email }}"
                               class="flex items-center justify-center gap-2 rounded-2xl bg-slate-100 px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-indigo-600 hover:text-white">
                                ✉️ {{ $member->email }}
                            </a>
                        @endif

                    </div>
                @endif

            </div>
        </div>
    @endforeach
    </div>
</section>
@endif

{{-- CTA --}}
<section class="bg-blue-600 text-white py-14 text-center">
    <div class="max-w-2xl mx-auto px-4">
        <h2 class="font-display font-bold text-3xl mb-3">Ready to shop with us?</h2>
        <p class="text-blue-100 mb-7">Join over 1,200 happy Kenyans who trust zinlinktech for all their tech needs.</p>
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="{{ route('products') }}" class="bg-white text-blue-700 hover:bg-blue-50 px-8 py-3 rounded-xl font-bold transition shadow-lg text-sm">Browse Products</a>
            <a href="{{ route('contact') }}" class="border-2 border-white/40 hover:border-white text-white px-8 py-3 rounded-xl font-bold transition text-sm">Contact Us</a>
        </div>
    </div>
</section>

@endsection