@extends('layouts.admin')
@section('title', 'Reviews — zinlinktech Admin')
@section('page-title', 'Customer Reviews')
@section('page-subtitle', 'Moderate, approve, and manage customer reviews')

@section('content')

{{-- Stats --}}
@php
$total    = \App\Models\Review::count();
$pending  = \App\Models\Review::where('status','pending')->count();
$approved = \App\Models\Review::where('status','approved')->count();
$featured = \App\Models\Review::where('is_featured',true)->where('status','approved')->count();
$avg      = \App\Models\Review::where('status','approved')->avg('rating');
@endphp

<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-7">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 text-center">
        <p class="font-display font-bold text-2xl text-slate-900">{{ $total }}</p>
        <p class="text-xs font-bold text-slate-400 uppercase tracking-wide mt-0.5">Total</p>
    </div>
    <div class="bg-amber-50 border border-amber-100 rounded-2xl shadow-sm p-4 text-center">
        <p class="font-display font-bold text-2xl text-amber-700">{{ $pending }}</p>
        <p class="text-xs font-bold text-amber-500 uppercase tracking-wide mt-0.5">Pending</p>
    </div>
    <div class="bg-emerald-50 border border-emerald-100 rounded-2xl shadow-sm p-4 text-center">
        <p class="font-display font-bold text-2xl text-emerald-700">{{ $approved }}</p>
        <p class="text-xs font-bold text-emerald-500 uppercase tracking-wide mt-0.5">Approved</p>
    </div>
    <div class="bg-blue-50 border border-blue-100 rounded-2xl shadow-sm p-4 text-center">
        <p class="font-display font-bold text-2xl text-blue-700">{{ $featured }}</p>
        <p class="text-xs font-bold text-blue-500 uppercase tracking-wide mt-0.5">Featured</p>
    </div>
    <div class="bg-purple-50 border border-purple-100 rounded-2xl shadow-sm p-4 text-center">
        <p class="font-display font-bold text-2xl text-purple-700">{{ $avg ? number_format($avg,1) : '—' }}⭐</p>
        <p class="text-xs font-bold text-purple-500 uppercase tracking-wide mt-0.5">Avg Rating</p>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- Reviews list --}}
    <div class="xl:col-span-2">
        {{-- Filter tabs --}}
        <div class="flex gap-2 mb-4 flex-wrap">
            @foreach(['' => 'All', 'pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $val => $label)
                <a href="{{ route('admin.reviews') }}{{ $val ? '?status='.$val : '' }}"
                   class="px-4 py-2 rounded-xl text-xs font-bold transition
                          {{ request('status','') == $val
                             ? 'bg-blue-600 text-white shadow-sm'
                             : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <div class="space-y-3">
            @forelse($reviews as $review)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 hover:shadow-md transition">
                    <div class="flex items-start gap-3">
                        {{-- Avatar --}}
                        <div class="w-10 h-10 {{ $review->avatar_color ?? 'bg-blue-600' }} rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                            {{ $review->initials ?: strtoupper(substr($review->customer_name,0,2)) }}
                        </div>

                        <div class="flex-1 min-w-0">
                            {{-- Header --}}
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <p class="font-bold text-slate-900 text-sm">{{ $review->customer_name }}</p>
                                @if($review->location)
                                    <span class="text-slate-400 text-xs">📍 {{ $review->location }}</span>
                                @endif
                                {{-- Stars --}}
                                <div class="flex gap-0.5">
                                    @for($i=1;$i<=5;$i++)
                                        <svg class="w-3 h-3 {{ $i<=$review->rating ? 'text-amber-400 fill-amber-400' : 'text-slate-200 fill-slate-200' }}" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</span>
                            </div>

                            @if($review->product_bought)
                                <p class="text-xs text-blue-600 font-semibold mb-1">🛒 {{ $review->product_bought }}</p>
                            @endif

                            <p class="text-slate-600 text-sm leading-relaxed">{{ $review->review_text }}</p>
                        </div>

                        {{-- Status + featured badges --}}
                        <div class="flex flex-col items-end gap-1.5 flex-shrink-0">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full
                                {{ $review->status === 'approved' ? 'bg-emerald-100 text-emerald-700'
                                   : ($review->status === 'rejected' ? 'bg-red-100 text-red-700'
                                   : 'bg-amber-100 text-amber-700') }}">
                                {{ ucfirst($review->status) }}
                            </span>
                            @if($review->is_featured)
                                <span class="text-xs font-bold bg-amber-50 text-amber-600 px-2 py-0.5 rounded-full">⭐ Featured</span>
                            @endif
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-wrap items-center gap-2 mt-4 pt-3 border-t border-slate-100">
                        @if($review->status !== 'approved')
                            <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST">
                                @csrf
                                <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                    ✓ Approve
                                </button>
                            </form>
                        @endif

                        @if($review->status !== 'rejected')
                            <form action="{{ route('admin.reviews.reject', $review->id) }}" method="POST">
                                @csrf
                                <button class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                    ✕ Reject
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('admin.reviews.feature', $review->id) }}" method="POST">
                            @csrf
                            <button class="{{ $review->is_featured ? 'bg-amber-100 text-amber-700 hover:bg-amber-200' : 'bg-slate-100 text-slate-600 hover:bg-amber-50 hover:text-amber-600' }} px-3 py-1.5 rounded-lg text-xs font-bold transition">
                                {{ $review->is_featured ? '★ Unfeature' : '☆ Feature' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST"
                              onsubmit="return confirm('Delete this review permanently?')" class="ml-auto">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-600 hover:bg-red-50 text-xs font-bold px-3 py-1.5 rounded-lg transition">
                                🗑 Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-slate-100 p-16 text-center">
                    <div class="text-5xl mb-3">⭐</div>
                    <p class="font-bold text-slate-600 text-lg">No reviews found</p>
                    <p class="text-slate-400 text-sm mt-1">Customer reviews will appear here when submitted</p>
                </div>
            @endforelse

            <div class="mt-4">{{ $reviews->withQueryString()->links() }}</div>
        </div>
    </div>

    {{-- Add review form --}}
    <div>
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sticky top-24">
            <h2 class="font-display font-bold text-lg text-slate-900 mb-5 pb-3 border-b border-slate-100">
                ➕ Add Review Manually
            </h2>
            <form action="{{ route('admin.reviews.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Customer Name *</label>
                    <input type="text" name="customer_name" required value="{{ old('customer_name') }}"
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="James Mwangi">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Email (optional)</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="james@example.com">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Product</label>
                        <input type="text" name="product_bought" value="{{ old('product_bought') }}"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Dell XPS 15">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Location</label>
                        <input type="text" name="location" value="{{ old('location') }}"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Nairobi">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Rating *</label>
                    <select name="rating" required
                            class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="5">⭐⭐⭐⭐⭐ — 5 Stars</option>
                        <option value="4">⭐⭐⭐⭐ — 4 Stars</option>
                        <option value="3">⭐⭐⭐ — 3 Stars</option>
                        <option value="2">⭐⭐ — 2 Stars</option>
                        <option value="1">⭐ — 1 Star</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Avatar Color</label>
                    <div class="flex gap-2 flex-wrap">
                        @foreach(['bg-blue-600','bg-emerald-600','bg-pink-600','bg-purple-600','bg-orange-600','bg-teal-600','bg-red-600','bg-indigo-600'] as $color)
                            <label class="cursor-pointer" title="{{ $color }}">
                                <input type="radio" name="avatar_color" value="{{ $color }}" class="sr-only peer"
                                       {{ old('avatar_color','bg-blue-600') == $color ? 'checked' : '' }}>
                                <div class="w-7 h-7 {{ $color }} rounded-full ring-2 ring-transparent peer-checked:ring-slate-900 peer-checked:scale-110 transition-all shadow-sm"></div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Review Text *</label>
                    <textarea name="review_text" rows="4" required
                              class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                              placeholder="Customer's review text...">{{ old('review_text') }}</textarea>
                </div>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" class="w-4 h-4 text-blue-600 rounded">
                    <span class="text-sm font-semibold text-slate-700">⭐ Feature on homepage</span>
                </label>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-sm transition shadow-lg shadow-blue-500/20">
                    Add Review
                </button>
            </form>
        </div>
    </div>
</div>

@endsection