@extends('layouts.app')
@section('title', 'Customer Reviews — zinlinktech Kenya')

@section('content')

{{-- Hero --}}
<section class="bg-slate-900 text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 50% 50%, #f59e0b 0%, transparent 60%);"></div>
    <div class="max-w-3xl mx-auto px-4 text-center relative">
        <span class="text-amber-400 text-xs font-bold uppercase tracking-widest mb-3 block">Customer Voices</span>
        <h1 class="font-display font-bold text-4xl md:text-5xl mb-4">What Customers Say</h1>
        <div class="flex items-center justify-center gap-1 mb-3">
            @for($i=0;$i<5;$i++)
                <svg class="w-7 h-7 text-amber-400 fill-amber-400" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            @endfor
        </div>
        <p class="text-slate-300 text-lg">
            Rated <strong class="text-white">{{ $avgRating ? number_format($avgRating,1) : '5.0' }}/5</strong>
            by <strong class="text-white">{{ $totalCount }}+</strong> verified customers
        </p>
    </div>
</section>

{{-- Rating Breakdown --}}
<section class="max-w-5xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
            <div class="text-center">
                <p class="font-display font-bold text-7xl text-slate-900">{{ $avgRating ? number_format($avgRating,1) : '5.0' }}</p>
                <div class="flex justify-center gap-1 my-2">
                    @for($i=0;$i<5;$i++)
                        <svg class="w-5 h-5 text-amber-400 fill-amber-400" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                </div>
                <p class="text-slate-500 text-sm">{{ $totalCount }} verified reviews</p>
            </div>
            <div class="md:col-span-2 space-y-2.5">
                @foreach($breakdown as $stars => $data)
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1 w-14 justify-end flex-shrink-0">
                            <span class="text-xs font-bold text-slate-600">{{ $stars }}</span>
                            <svg class="w-3 h-3 text-amber-400 fill-amber-400" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <div class="flex-1 bg-slate-100 rounded-full h-3 overflow-hidden">
                            <div class="bg-amber-400 h-full rounded-full transition-all duration-700"
                                 style="width: {{ $data['pct'] }}%"></div>
                        </div>
                        <span class="text-xs text-slate-500 w-10 flex-shrink-0">{{ $data['count'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Reviews grid --}}
<section class="max-w-7xl mx-auto px-4 pb-10">

    @if(session('review_success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-xl mb-8 flex items-center gap-3">
            <span class="text-2xl">🎉</span>
            <div>
                <p class="font-bold text-sm">Thank you for your review!</p>
                <p class="text-xs mt-0.5">Thanks for sharing your experience. Your review will appear soon.</p>
            </div>
        </div>
    @endif

    @if($reviews->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @foreach($reviews as $review)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:shadow-lg transition relative flex flex-col">
                    <div class="absolute top-5 right-5 text-5xl text-slate-100 font-serif leading-none select-none">"</div>

                    {{-- Stars --}}
                    <div class="flex items-center gap-0.5 mb-3">
                        @for($i=1;$i<=5;$i++)
                            <svg class="w-4 h-4 {{ $i<=$review->rating ? 'text-amber-400 fill-amber-400' : 'text-slate-200 fill-slate-200' }}" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>

                    @if($review->product_bought)
                        <span class="inline-block bg-blue-50 text-blue-700 text-xs font-bold px-2.5 py-1 rounded-full mb-3">
                            🛒 {{ $review->product_bought }}
                        </span>
                    @endif

                    <p class="text-slate-600 text-sm leading-relaxed mb-5 flex-1">{{ $review->review_text }}</p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 {{ $review->avatar_color ?? 'bg-blue-600' }} rounded-full flex items-center justify-center text-white text-sm font-bold shadow-sm flex-shrink-0">
                                {{ $review->initials ?: strtoupper(substr($review->customer_name,0,2)) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 text-sm">{{ $review->customer_name }}</p>
                                @if($review->location)
                                    <p class="text-xs text-slate-400">📍 {{ $review->location }}</p>
                                @endif
                            </div>
                        </div>
                        <span class="text-xs text-slate-400">{{ $review->created_at->format('M Y') }}</span>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-xs text-emerald-600 font-bold">Verified Purchase</span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mb-10">{{ $reviews->links() }}</div>
    @else
        <div class="text-center py-16 bg-white rounded-2xl border border-slate-100 shadow-sm mb-10">
            <div class="text-5xl mb-3">⭐</div>
            <p class="font-bold text-slate-600 text-lg">No approved reviews yet</p>
            <p class="text-slate-400 text-sm mt-1">Be the first to leave a review!</p>
        </div>
    @endif
</section>

{{-- Leave a review --}}
<section class="bg-slate-50 border-t border-slate-200 py-16">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
            <div class="text-center mb-7">
                <span class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-2 block">Your Opinion Matters</span>
                <h2 class="font-display font-bold text-2xl text-slate-900">Leave a Review</h2>
                <p class="text-slate-500 text-sm mt-1">Bought from us? Share your experience — it helps other Kenyans!</p>
            </div>

            <form action="{{ route('reviews.store') }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Your Name *</label>
                        <input type="text" name="name" required value="{{ old('name') }}"
                               class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="James Mwangi">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Product Bought</label>
                        <input type="text" name="product" value="{{ old('product') }}"
                               class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Dell XPS 15">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Your Rating *</label>
                    <div class="flex gap-2">
                        @for($i=1;$i<=5;$i++)
                            <label class="cursor-pointer group">
                                <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer"
                                       {{ old('rating') == $i ? 'checked' : '' }}>
                                <svg class="w-9 h-9 text-slate-200 fill-slate-200 peer-checked:text-amber-400 peer-checked:fill-amber-400 hover:text-amber-300 hover:fill-amber-300 transition-colors" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </label>
                        @endfor
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Your Review *</label>
                    <textarea name="review" rows="4" required
                              class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                              placeholder="Share your experience with zinlinktech — the product, delivery, customer service...">{{ old('review') }}</textarea>
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl font-bold transition text-sm shadow-lg shadow-blue-500/25">
                    ⭐ Submit Review
                </button>
                <p class="text-xs text-slate-400 text-center">Reviews are verified by our team before appearing on the site.</p>
            </form>
        </div>
    </div>
</section>

@endsection