    @extends('layouts.app')
@section('title', 'Checkout — zinlinktech Kenya')

@section('content')

<div class="bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="text-xs text-slate-500 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
            <span>›</span>
            <a href="{{ route('cart') }}" class="hover:text-blue-600 transition">Cart</a>
            <span>›</span>
            <span class="text-slate-700 font-medium">Checkout</span>
        </nav>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 py-10">

    {{-- Progress steps --}}
    <div class="flex items-center justify-center gap-2 mb-10">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 bg-emerald-500 text-white rounded-full flex items-center justify-center text-xs font-bold">✓</div>
            <span class="text-sm font-semibold text-emerald-600 hidden sm:block">Cart</span>
        </div>
        <div class="w-12 h-0.5 bg-blue-600"></div>
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold">2</div>
            <span class="text-sm font-bold text-blue-600 hidden sm:block">Checkout</span>
        </div>
        <div class="w-12 h-0.5 bg-slate-200"></div>
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 bg-slate-200 text-slate-400 rounded-full flex items-center justify-center text-xs font-bold">3</div>
            <span class="text-sm font-semibold text-slate-400 hidden sm:block">Confirmation</span>
        </div>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ── LEFT: FORM ── --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Customer Info --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-7">
                    <h2 class="font-display font-bold text-xl text-slate-900 mb-5 flex items-center gap-2">
                        <span class="w-7 h-7 bg-blue-600 text-white rounded-lg flex items-center justify-center text-xs font-bold">1</span>
                        Delivery Information
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Full Name *</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('customer_name') border-red-400 @enderror"
                                   placeholder="e.g. your name">
                            @error('customer_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email Address *</label>
                            <input type="email" name="customer_email" value="{{ old('customer_email') }}" required
                                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('customer_email') border-red-400 @enderror"
                                   placeholder="you@email.com">
                            @error('customer_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Phone Number *</label>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" required
                                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('customer_phone') border-red-400 @enderror"
                                   placeholder="0712 345 678">
                            @error('customer_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">City / Town *</label>
                            <input type="text" name="city" value="{{ old('city') }}" required
                                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('city') border-red-400 @enderror"
                                   placeholder="Nairobi">
                            @error('city') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nearest Stage / Area *</label>
                            <input type="text" name="customer_address" value="{{ old('customer_address') }}" required
                                   class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('customer_address') border-red-400 @enderror"
                                   placeholder="e.g. Westlands, Sarit Centre">
                            @error('customer_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-7">
                    <h2 class="font-display font-bold text-xl text-slate-900 mb-5 flex items-center gap-2">
                        <span class="w-7 h-7 bg-blue-600 text-white rounded-lg flex items-center justify-center text-xs font-bold">2</span>
                        Payment Method
                    </h2>

                    <div class="space-y-3">
                        {{-- M-Pesa --}}
                        <label class="flex items-center gap-4 border-2 border-slate-200 rounded-xl p-4 cursor-pointer hover:border-blue-400 transition has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                            <input type="radio" name="payment_method" value="mpesa"
                                   {{ old('payment_method', 'mpesa') == 'mpesa' ? 'checked' : '' }}
                                   class="w-4 h-4 text-blue-600">
                            <div class="flex items-center gap-3 flex-1">
                                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-xl flex-shrink-0">📱</div>
                                <div>
                                    <p class="font-bold text-slate-800 text-sm">M-Pesa</p>
                                    <p class="text-xs text-slate-500">Pay via Safaricom M-Pesa Paybill</p>
                                </div>
                                <span class="ml-auto text-xs bg-emerald-100 text-emerald-700 font-bold px-2 py-1 rounded-full">Popular</span>
                            </div>
                        </label>

                        {{-- Bank Transfer --}}
                        <label class="flex items-center gap-4 border-2 border-slate-200 rounded-xl p-4 cursor-pointer hover:border-blue-400 transition has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                            <input type="radio" name="payment_method" value="bank_transfer"
                                   {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}
                                   class="w-4 h-4 text-blue-600">
                            <div class="flex items-center gap-3 flex-1">
                                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center text-xl flex-shrink-0">🏦</div>
                                <div>
                                    <p class="font-bold text-slate-800 text-sm">Bank Transfer</p>
                                    <p class="text-xs text-slate-500">Direct bank deposit or EFT</p>
                                </div>
                            </div>
                        </label>

                        {{-- Cash on Delivery --}}
                        <label class="flex items-center gap-4 border-2 border-slate-200 rounded-xl p-4 cursor-pointer hover:border-blue-400 transition has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                            <input type="radio" name="payment_method" value="cash_on_delivery"
                                   {{ old('payment_method') == 'cash_on_delivery' ? 'checked' : '' }}
                                   class="w-4 h-4 text-blue-600">
                            <div class="flex items-center gap-3 flex-1">
                                <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-xl flex-shrink-0">💵</div>
                                <div>
                                    <p class="font-bold text-slate-800 text-sm">Cash on Delivery</p>
                                    <p class="text-xs text-slate-500">Pay when your order arrives</p>
                                </div>
                            </div>
                        </label>
                    </div>

                    {{-- Notes --}}
                    <div class="mt-5">
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Order Notes <span class="font-normal text-slate-400">(optional)</span></label>
                        <textarea name="notes" rows="3"
                                  class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                                  placeholder="Special instructions, delivery notes, or any requests...">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- ── RIGHT: SUMMARY ── --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sticky top-24">
                    <h2 class="font-display font-bold text-xl text-slate-900 mb-5 pb-4 border-b border-slate-100">Your Order</h2>

                    <div class="space-y-3 mb-5">
                        @foreach($cart as $item)
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-lg flex-shrink-0 overflow-hidden">
                                    @if($item['image'])
                                        <img src="{{ asset('storage/' . $item['image']) }}" class="w-full h-full object-cover" alt="">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-slate-800 line-clamp-2">{{ $item['name'] }}</p>
                                    <p class="text-xs text-slate-400">Qty: {{ $item['quantity'] }}</p>
                                </div>
                                <span class="text-xs font-bold text-slate-900 flex-shrink-0">KES {{ number_format($item['price'] * $item['quantity']) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-2 text-sm border-t border-slate-100 pt-4 mb-5">
                        <div class="flex justify-between text-slate-600">
                            <span>Subtotal</span>
                            <span class="font-semibold">KES {{ number_format($total) }}</span>
                        </div>
                        <div class="flex justify-between text-slate-600">
                            <span>Shipping</span>
                            <span class="font-semibold {{ $total > 50000 ? 'text-emerald-600' : '' }}">{{ $total > 50000 ? 'FREE' : 'KES 500' }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-slate-900 text-base pt-3 border-t border-slate-100">
                            <span>Total</span>
                            <span class="text-blue-600 font-display text-xl">KES {{ number_format($total > 50000 ? $total : $total + 500) }}</span>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl font-bold transition shadow-lg shadow-blue-500/25 text-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Place Order
                    </button>

                    <p class="text-xs text-slate-400 text-center mt-3">By placing your order you agree to our terms of service</p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection