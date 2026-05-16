@extends('layouts.app')
@section('title', 'Contact Us — zinlinktech Kenya')

@section('content')

{{-- Hero --}}
<section class="bg-slate-900 text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 30% 50%, #3b82f6 0%, transparent 50%);"></div>
    <div class="max-w-3xl mx-auto px-4 text-center relative">
        <span class="text-blue-400 text-xs font-bold uppercase tracking-widest mb-3 block">We're Here to Help</span>
        <h1 class="font-display font-bold text-4xl md:text-5xl mb-4">Get In Touch</h1>
        <p class="text-slate-300 text-lg">Have a question, need product advice, or want to place a bulk order? Our team responds within 1 hour during business hours.</p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- Contact Cards --}}
        <div class="space-y-5">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-2xl mb-4">📞</div>
                <h3 class="font-display font-bold text-slate-900 text-base mb-1">Call Us</h3>
                <p class="text-slate-500 text-sm mb-2">Mon–Sat: 8:00 AM – 7:00 PM</p>
                <a href="tel:0768244011\0746049506" class="text-blue-600 font-bold hover:underline">0768244011\0746049506</a>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition">
                <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-2xl mb-4">💬</div>
                <h3 class="font-display font-bold text-slate-900 text-base mb-1">WhatsApp</h3>
                <p class="text-slate-500 text-sm mb-2">Quickest way to reach us</p>
                 <div class="space-y-2">
        <a href="https://wa.me/254768244011"
           target="_blank"
           class="block text-emerald-600 font-bold hover:underline">
            Chat: 0768 244 011 →
        </a>

        <a href="https://wa.me/254746049506"
           target="_blank"
           class="block text-emerald-600 font-bold hover:underline">
            Chat: 0746 049 506 →
        </a>
    </div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition">
                <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-2xl mb-4">✉️</div>
                <h3 class="font-display font-bold text-slate-900 text-base mb-1">Email</h3>
                <p class="text-slate-500 text-sm mb-2">We reply within 2–3 hours</p>
                <a href="mailto:info@zinlinktech.co.ke" class="text-amber-600 font-bold hover:underline">info@zinlinktech.co.ke</a>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition">
                <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-2xl mb-4">📍</div>
                <h3 class="font-display font-bold text-slate-900 text-base mb-1">Visit Our Shop</h3>
                <p class="text-slate-500 text-sm">kaimosi, <br>vihiga, Kenya<br>Ground Floor, Suite 4</p>
            </div>
        </div>

        {{-- Contact Form --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
            <h2 class="font-display font-bold text-2xl text-slate-900 mb-2">Send Us a Message</h2>
            <p class="text-slate-500 text-sm mb-7">Fill out the form below and we'll get back to you within 1 hour.</p>

            @if(session('contact_success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-xl mb-6 flex items-center gap-3">
                    <span class="text-2xl">✅</span>
                    <div>
                        <p class="font-bold text-sm">Message sent!</p>
                        <p class="text-xs mt-0.5">Thank you! We'll reply within 1 hour during business hours.</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Your Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-400 @enderror"
                               placeholder="your name">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Phone Number *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                               class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-400 @enderror"
                               placeholder="0768244011">
                        @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-400 @enderror"
                               placeholder="your@email.com">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Subject *</label>
                        <select name="subject" required class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select a topic...</option>
                            <option value="Product Inquiry" {{ old('subject') == 'Product Inquiry' ? 'selected' : '' }}>Product Inquiry</option>
                            <option value="Order Status" {{ old('subject') == 'Order Status' ? 'selected' : '' }}>Order Status</option>
                            <option value="Warranty Claim" {{ old('subject') == 'Warranty Claim' ? 'selected' : '' }}>Warranty Claim</option>
                            <option value="Bulk Order" {{ old('subject') == 'Bulk Order' ? 'selected' : '' }}>Bulk / Corporate Order</option>
                            <option value="Technical Support" {{ old('subject') == 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
                            <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Your Message *</label>
                        <textarea name="message" rows="5" required
                                  class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none @error('message') border-red-400 @enderror"
                                  placeholder="Tell us how we can help you...">{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-bold transition shadow-lg shadow-blue-500/25 text-sm flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Send Message
                </button>
            </form>
        </div>
    </div>
</section>

{{-- Map-style section --}}
<section class="bg-gradient-to-b from-slate-50 to-slate-100 py-16 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4">

        <!-- Heading -->
        <div class="text-center mb-10">
            <p class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 bg-emerald-100 px-4 py-1 rounded-full">
                📍 Visit Our Location
            </p>

            <h2 class="mt-4 text-3xl md:text-4xl font-bold text-slate-800">
                Find Us in Kaimosi, Kenya
            </h2>

            <p class="mt-3 text-slate-500 max-w-2xl mx-auto">
                Conveniently located near Kencom Bus Stop. Easily accessible and open throughout the week.
            </p>
        </div>

        <!-- Map Container -->
        <div class="max-w-6xl mx-auto rounded-3xl overflow-hidden shadow-2xl border border-slate-200 bg-white">

            <!-- Real Embedded Google Map -->
            <div class="relative w-full h-[420px]">
                <iframe
                    src="https://maps.google.com/maps?q=Kaimosi%2C%20Kenya&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    class="w-full h-full"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>

                <!-- Floating Location Card -->
                <div class="absolute bottom-6 left-6 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl p-5 max-w-sm border border-slate-200">
                    <div class="flex items-start gap-4">
                        <div class="bg-emerald-100 text-emerald-600 p-3 rounded-xl text-2xl">
                            📍
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-slate-800">
                                Kaimosi, Kenya
                            </h3>

                            <p class="text-sm text-slate-500 mt-1">
                                Near Kencom Bus Stop
                            </p>

                            <div class="mt-3 text-sm text-slate-600">
                                <p><span class="font-semibold">Mon–Sat:</span> 8am – 7pm</p>
                                <p><span class="font-semibold">Sunday:</span> 10am – 4pm</p>
                            </div>

                            <a href="https://maps.google.com/?q=Kaimosi,Kenya"
                               target="_blank"
                               class="inline-flex items-center gap-2 mt-4 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium px-4 py-2 rounded-full transition duration-300">
                                Open Full Map →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection