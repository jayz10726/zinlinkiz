@extends('layouts.admin')
@section('title', 'Add Product — zinlinktech Admin')
@section('page-title', 'Add New Product')
@section('page-subtitle', 'Fill in the details to add a product to your catalogue')

@section('content')
<div class="max-w-3xl">

    <div class="mb-5">
        <a href="{{ route('admin.products') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-800 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Products
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- Basic Info --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-display font-bold text-base text-slate-800 mb-5 pb-3 border-b border-slate-100">Product Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Product Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror"
                           placeholder="e.g. Dell XPS 15 9530 Laptop">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand') }}"
                           class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="e.g. Dell, Apple, HP">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Category *</label>
                    <select name="category" required
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">— Select category —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Price (KES) *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-400">KES</span>
                        <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" required
                               class="w-full border border-slate-300 rounded-xl pl-12 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-400 @enderror"
                               placeholder="85000">
                    </div>
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Stock Quantity *</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" required
                           class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('stock') border-red-400 @enderror"
                           placeholder="10">
                    @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Quick Specs <span class="font-normal text-slate-400">(one line summary)</span></label>
                    <input type="text" name="specs" value="{{ old('specs') }}"
                           class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="e.g. Intel i7-13700H, 16GB RAM, 512GB SSD, 15.6 inch 4K OLED">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Full Description *</label>
                    <textarea name="description" rows="5" required
                              class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none @error('description') border-red-400 @enderror"
                              placeholder="Detailed product description — features, what's in the box, compatibility...">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Image & Settings --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h2 class="font-display font-bold text-base text-slate-800 mb-5 pb-3 border-b border-slate-100">Image & Settings</h2>

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Product Image</label>
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:border-blue-400 transition" id="drop-zone">
                        <div class="text-3xl mb-2">🖼️</div>
                        <input type="file" name="image" accept="image/*" id="img-input"
                               class="hidden" onchange="previewImage(this)">
                        <label for="img-input" class="cursor-pointer">
                            <p class="text-sm font-semibold text-blue-600 hover:text-blue-700">Click to upload image</p>
                            <p class="text-xs text-slate-400 mt-1">JPG, PNG or WebP — max 2MB</p>
                        </label>
                        <img id="img-preview" src="" alt="" class="hidden mx-auto mt-3 max-h-32 rounded-xl object-contain">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <label class="flex items-center gap-3 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 cursor-pointer hover:bg-blue-50 hover:border-blue-200 transition has-[:checked]:bg-blue-50 has-[:checked]:border-blue-300 flex-1">
                        <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded">
                        <div>
                            <p class="text-sm font-semibold text-slate-800">⭐ Feature on Homepage</p>
                            <p class="text-xs text-slate-400">Show in the featured products section</p>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 cursor-pointer hover:bg-emerald-50 hover:border-emerald-200 transition has-[:checked]:bg-emerald-50 has-[:checked]:border-emerald-300 flex-1">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-emerald-600 rounded">
                        <div>
                            <p class="text-sm font-semibold text-slate-800">✅ Active (Visible)</p>
                            <p class="text-xs text-slate-400">Customers can see and buy this product</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex gap-3">
            <button type="submit"
                    class="flex-1 sm:flex-none bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition shadow-lg shadow-blue-500/20 text-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Add Product
            </button>
            <a href="{{ route('admin.products') }}"
               class="px-6 py-3 border border-slate-300 text-slate-600 hover:bg-slate-50 rounded-xl font-semibold transition text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('img-preview');
            img.src = e.target.result;
            img.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection


