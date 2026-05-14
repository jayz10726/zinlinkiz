@extends('layouts.app')
@section('title', $product->name . ' — zinlinktech Kenya')

@section('content')

{{-- Breadcrumb --}}
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="text-xs text-gray-400 flex items-center gap-1.5">
            <a href="{{ route('home') }}" class="hover:text-blue-500">Home</a>
            <span>/</span>
            <a href="{{ route('products') }}" class="hover:text-blue-500">Products</a>
            <span>/</span>
            <span class="text-gray-700">{{ $product->name }}</span>
        </nav>
    </div>
</div>

<div class="bg-gray-100 min-h-screen py-6">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Product Section --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <div class="grid md:grid-cols-2 gap-8">

                {{-- Image --}}
                <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-center">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             alt="{{ $product->name }}"
                             class="max-h-96 object-contain">
                    @else
                        <div class="text-gray-400">No image available</div>
                    @endif
                </div>

                {{-- Details --}}
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-3">
                        {{ $product->name }}
                    </h1>

                    <p class="text-sm text-gray-500 mb-3">
                        Category: {{ $product->category }}
                    </p>

                    <p class="text-3xl font-bold text-orange-600 mb-4">
                        KES {{ number_format($product->price) }}
                    </p>

                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-2">
                            Description
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $product->description ?? 'No description available.' }}
                        </p>
                    </div>

                    @if($product->stock > 0)
                        <p class="text-green-600 font-semibold mb-4">
                            In Stock ({{ $product->stock }})
                        </p>

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden"
                                   name="product_id"
                                   value="{{ $product->id }}">

                            <button type="submit"
                                    class="w-full md:w-auto px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-lg">
                                Add to Cart
                            </button>
                        </form>
                    @else
                        <p class="text-red-500 font-semibold">
                            Out of Stock
                        </p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if($related->count())
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h2 class="text-xl font-bold mb-4">
                    Related Products
                </h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">

                    @foreach($related as $item)
                        <div class="border rounded-lg overflow-hidden bg-white">

                            <a href="{{ route('product.show', $item->id) }}">
                                @if($item->image)
                                    <img src="{{ asset('storage/'.$item->image) }}"
                                         alt="{{ $item->name }}"
                                         class="w-full h-40 object-contain p-2">
                                @endif
                            </a>

                            <div class="p-3">
                                <a href="{{ route('product.show', $item->id) }}">
                                    <h3 class="text-sm font-medium text-gray-800 line-clamp-2">
                                        {{ $item->name }}
                                    </h3>
                                </a>

                                <p class="text-orange-600 font-bold mt-2">
                                    KES {{ number_format($item->price) }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        @endif

    </div>
</div>

@endsection