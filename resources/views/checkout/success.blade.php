@extends('layouts.app')
@section('title', 'Order Confirmed — zinlinktech Kenya')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-16">

    {{-- Success Card --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

        {{-- Green top banner --}}
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 p-8 text-white text-center">

            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h1 class="font-display font-bold text-3xl mb-1">
                Order Placed! 🎉
            </h1>

            <p class="text-emerald-100">
                Thank you, {{ $order->customer_name }}! We've received your order.
            </p>
        </div>

        <div class="p-7">

            {{-- Order Number --}}
            <div class="bg-slate-50 rounded-xl p-4 mb-6 text-center border border-slate-100">

                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">
                    Your Order Number
                </p>

                <p class="font-display font-bold text-2xl text-blue-600">
                    {{ $order->order_number }}
                </p>

                <p class="text-xs text-slate-400 mt-1">
                    Save this number to track your order
                </p>
            </div>

            {{-- What happens next --}}
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6">

                <p class="text-sm font-bold text-blue-800 mb-2">
                    📞 What happens next?
                </p>

                <ol class="text-xs text-blue-700 space-y-1 list-decimal list-inside">
                    <li>Our team will call <strong>{{ $order->customer_phone }}</strong> within 30 minutes to confirm.</li>
                    <li>You’ll receive payment instructions for <strong>{{ str_replace('_',' ', $order->payment_method) }}</strong>.</li>
                    <li>Once payment is confirmed, your order will be dispatched immediately.</li>
                </ol>
            </div>

            {{-- Order Items --}}
            <h3 class="font-display font-bold text-lg text-slate-900 mb-4">
                Items Ordered
            </h3>

            <div class="space-y-3 mb-5">
                @foreach($order->items as $item)

                    <div class="flex items-center justify-between py-2 border-b border-slate-100 last:border-0">

                        <div>
                            <p class="text-sm font-semibold text-slate-800">
                                {{ $item->product_name }}
                            </p>

                            <p class="text-xs text-slate-400">
                                Qty: {{ $item->quantity }} × KES {{ number_format($item->product_price) }}
                            </p>
                        </div>

                        <span class="font-bold text-slate-900 text-sm">
                            KES {{ number_format($item->subtotal) }}
                        </span>
                    </div>

                @endforeach
            </div>

            {{-- Totals --}}
            <div class="bg-slate-50 rounded-xl p-4 mb-6 space-y-2 text-sm">

                <div class="flex justify-between text-slate-600">
                    <span>Subtotal</span>
                    <span>KES {{ number_format($order->subtotal) }}</span>
                </div>

                <div class="flex justify-between text-slate-600">
                    <span>Shipping</span>
                    <span>{{ $order->shipping == 0 ? 'FREE' : 'KES ' . number_format($order->shipping) }}</span>
                </div>

                <div class="flex justify-between font-bold text-slate-900 text-base pt-2 border-t border-slate-200">
                    <span>Total</span>
                    <span class="text-blue-600">KES {{ number_format($order->total) }}</span>
                </div>
            </div>

            {{-- Delivery info --}}
            <div class="grid grid-cols-2 gap-4 mb-6 text-sm">

                <div class="bg-slate-50 rounded-xl p-3">

                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">
                        Deliver To
                    </p>

                    <p class="font-semibold text-slate-800">
                        {{ $order->customer_name }}
                    </p>

                    <p class="text-slate-500 text-xs">
                        {{ $order->customer_address }}, {{ $order->city }}
                    </p>
                </div>

                <div class="bg-slate-50 rounded-xl p-3">

                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wide mb-1">
                        Payment
                    </p>

                    <p class="font-semibold text-slate-800 capitalize">
                        {{ str_replace('_',' ', $order->payment_method) }}
                    </p>

                    <p class="text-slate-500 text-xs">
                        Awaiting confirmation
                    </p>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-3">

                <a href="{{ route('home') }}"
                   class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-xl font-bold transition text-sm">

                    Continue Shopping
                </a>

                {{-- CEO WhatsApp --}}
                <a href="https://wa.me/254768244011?text=Hi!%20I%20placed%20order%20{{ $order->order_number }}%20and%20want%20to%20confirm%20my%20order."
                   target="_blank"
                   class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white text-center py-3 rounded-xl font-bold transition text-sm flex items-center justify-center gap-2">

                    👑 Chat CEO
                </a>

                {{-- Head of Sales WhatsApp --}}
                <a href="https://wa.me/254746049506?text=Hi!%20I%20placed%20order%20{{ $order->order_number }}%20and%20want%20to%20confirm%20my%20order."
                   target="_blank"
                   class="flex-1 bg-orange-500 hover:bg-orange-600 text-white text-center py-3 rounded-xl font-bold transition text-sm flex items-center justify-center gap-2">

                    📞 Head of Sales
                </a>

            </div>

        </div>
    </div>
</div>
@endsection