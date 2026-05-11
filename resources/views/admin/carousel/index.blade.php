@extends('layouts.admin')
@section('title', 'Carousel Slides — zinlinktech Admin')
@section('page-title', 'Carousel Management')
@section('page-subtitle', 'Add, edit, reorder and manage homepage carousel slides')

@section('content')

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- ── SLIDES LIST ── --}}
    <div class="xl:col-span-2 space-y-4">

        <div class="flex items-center justify-between mb-2">
            <p class="text-sm text-slate-500">
                {{ $slides->count() }} slide(s) · auto-advances every 2 seconds
            </p>
            <a href="{{ route('home') }}" target="_blank"
               class="text-blue-600 hover:text-blue-700 text-xs font-bold flex items-center gap-1">
                Preview homepage ↗
            </a>
        </div>

        @forelse($slides as $slide)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-md transition">
                <div class="flex">
                    {{-- Image Preview --}}
                    <div class="w-44 h-32 flex-shrink-0 bg-slate-100 overflow-hidden relative">
                        @if($slide->image)
                            <img src="{{ asset('storage/'.$slide->image) }}"
                                 alt="{{ $slide->title }}"
                                 class="w-full h-full object-cover">
                            {{-- Overlay preview --}}
                            <div class="absolute inset-0 bg-black/30 flex items-end p-2">
                                <span class="text-white text-xs font-bold truncate">{{ $slide->title }}</span>
                            </div>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 gap-2">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-xs">No image</span>
                            </div>
                        @endif
                    </div>

                    {{-- Slide Info --}}
                    <div class="flex-1 min-w-0 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0 flex-1">
                                {{-- Title + subtitle --}}
                                <div class="flex items-center gap-2 flex-wrap mb-1">
                                    <h3 class="font-display font-bold text-slate-900">{{ $slide->title }}</h3>
                                    @if($slide->subtitle)
                                        <span class="text-blue-500 text-sm font-semibold">{{ $slide->subtitle }}</span>
                                    @endif
                                </div>

                                {{-- Badge --}}
                                @if($slide->badge_text)
                                    <span class="inline-block text-xs font-bold bg-slate-100 text-slate-600 px-2.5 py-0.5 rounded-full mb-2">
                                        {{ $slide->badge_text }}
                                    </span>
                                @endif

                                {{-- Description --}}
                                @if($slide->description)
                                    <p class="text-slate-500 text-xs line-clamp-1 mb-2">{{ $slide->description }}</p>
                                @endif

                                {{-- Buttons --}}
                                <div class="flex gap-2 flex-wrap">
                                    <span class="bg-blue-50 text-blue-700 text-xs px-2.5 py-1 rounded-lg font-semibold">
                                        🔗 {{ $slide->btn_primary_text }}
                                    </span>
                                    @if($slide->btn_secondary_text)
                                        <span class="bg-slate-50 text-slate-600 text-xs px-2.5 py-1 rounded-lg">
                                            {{ $slide->btn_secondary_text }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Stats preview --}}
                                @if($slide->stat_1_value || $slide->stat_2_value || $slide->stat_3_value)
                                    <div class="flex gap-3 mt-2 text-xs text-slate-400">
                                        @if($slide->stat_1_value)
                                            <span>{{ $slide->stat_1_value }} · {{ $slide->stat_1_label }}</span>
                                        @endif
                                        @if($slide->stat_2_value)
                                            <span>{{ $slide->stat_2_value }} · {{ $slide->stat_2_label }}</span>
                                        @endif
                                        @if($slide->stat_3_value)
                                            <span>{{ $slide->stat_3_value }} · {{ $slide->stat_3_label }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            {{-- Status --}}
                            <div class="flex flex-col items-end gap-1.5 flex-shrink-0">
                                <span class="{{ $slide->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }} text-xs font-bold px-2.5 py-1 rounded-full">
                                    {{ $slide->is_active ? '● Active' : '○ Hidden' }}
                                </span>
                                <span class="text-xs text-slate-400">Position #{{ $slide->sort_order + 1 }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action bar --}}
                <div class="flex items-center gap-2 px-4 py-3 border-t border-slate-100 bg-slate-50/60 flex-wrap">
                    {{-- Edit --}}
                    <button onclick="openEditModal({{ $slide->id }}, {{ json_encode([
                        'title'              => $slide->title,
                        'subtitle'           => $slide->subtitle,
                        'description'        => $slide->description,
                        'badge_text'         => $slide->badge_text,
                        'btn_primary_text'   => $slide->btn_primary_text,
                        'btn_primary_url'    => $slide->btn_primary_url,
                        'btn_secondary_text' => $slide->btn_secondary_text,
                        'btn_secondary_url'  => $slide->btn_secondary_url,
                        'stat_1_value'       => $slide->stat_1_value,
                        'stat_1_label'       => $slide->stat_1_label,
                        'stat_2_value'       => $slide->stat_2_value,
                        'stat_2_label'       => $slide->stat_2_label,
                        'stat_3_value'       => $slide->stat_3_value,
                        'stat_3_label'       => $slide->stat_3_label,
                        'image'              => $slide->image,
                        'is_active'          => $slide->is_active,
                    ]) }})"
                            class="bg-blue-50 hover:bg-blue-100 text-blue-700 px-4 py-1.5 rounded-lg text-xs font-bold transition">
                        ✏️ Edit Slide
                    </button>

                    {{-- Toggle active --}}
                    <form action="{{ route('admin.carousel.toggle', $slide->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="{{ $slide->is_active
                                    ? 'bg-amber-50 text-amber-700 hover:bg-amber-100'
                                    : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}
                                    px-4 py-1.5 rounded-lg text-xs font-bold transition">
                            {{ $slide->is_active ? '⏸ Hide Slide' : '▶ Show Slide' }}
                        </button>
                    </form>

                    {{-- Move up --}}
                    @if(!$loop->first)
                        <form action="{{ route('admin.carousel.reorder') }}" method="POST">
                            @csrf
                            <input type="hidden" name="direction" value="up">
                            <input type="hidden" name="id" value="{{ $slide->id }}">
                            <button type="submit"
                                    class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-3 py-1.5 rounded-lg text-xs font-bold transition"
                                    title="Move up">↑</button>
                        </form>
                    @endif

                    {{-- Move down --}}
                    @if(!$loop->last)
                        <form action="{{ route('admin.carousel.reorder') }}" method="POST">
                            @csrf
                            <input type="hidden" name="direction" value="down">
                            <input type="hidden" name="id" value="{{ $slide->id }}">
                            <button type="submit"
                                    class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-3 py-1.5 rounded-lg text-xs font-bold transition"
                                    title="Move down">↓</button>
                        </form>
                    @endif

                    {{-- Delete --}}
                    <form action="{{ route('admin.carousel.destroy', $slide->id) }}" method="POST"
                          onsubmit="return confirm('Delete slide \'{{ addslashes($slide->title) }}\'? This cannot be undone.')"
                          class="ml-auto">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-1.5 rounded-lg text-xs font-bold transition">
                            🗑 Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-slate-100 p-16 text-center">
                <div class="text-5xl mb-4">🖼️</div>
                <p class="font-display font-bold text-slate-700 text-xl mb-1">No carousel slides yet</p>
                <p class="text-slate-400 text-sm">Add your first slide using the form on the right.</p>
            </div>
        @endforelse
    </div>

    {{-- ── ADD NEW SLIDE FORM ── --}}
    <div>
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sticky top-24">
            <h2 class="font-display font-bold text-lg text-slate-900 mb-5 pb-3 border-b border-slate-100">
                ➕ Add New Slide
            </h2>
            <form action="{{ route('admin.carousel.store') }}" method="POST"
                  enctype="multipart/form-data" class="space-y-4">
                @csrf

                {{-- Image upload --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">
                        Slide Image *
                        <span class="font-normal text-slate-400 ml-1">1600×580px recommended</span>
                    </label>
                    <label for="add-image"
                           class="flex flex-col items-center justify-center border-2 border-dashed border-slate-300 rounded-xl p-5 cursor-pointer hover:border-blue-400 hover:bg-blue-50/20 transition group">
                        <div id="add-placeholder" class="text-center">
                            <svg class="w-8 h-8 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm font-semibold text-blue-600">Click to upload image</p>
                            <p class="text-xs text-slate-400 mt-0.5">JPG, PNG, WebP — max 5MB</p>
                        </div>
                        <img id="add-preview" class="hidden max-h-28 rounded-xl object-cover w-full" alt="">
                        <input type="file" id="add-image" name="image" accept="image/*" required
                               class="hidden" onchange="previewAddImage(this)">
                    </label>
                    @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Title --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Main Title *</label>
                    <input type="text" name="title" required value="{{ old('title') }}"
                           placeholder="MacBook Pro"
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-400 @enderror">
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Subtitle --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">
                        Subtitle / Highlight <span class="font-normal text-slate-400">(shown in colored text)</span>
                    </label>
                    <input type="text" name="subtitle" value="{{ old('subtitle') }}"
                           placeholder="M3 Series"
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Description</label>
                    <textarea name="description" rows="2"
                              placeholder="A short compelling description..."
                              class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('description') }}</textarea>
                </div>

                {{-- Badge text --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">
                        Badge Text <span class="font-normal text-slate-400">(top label)</span>
                    </label>
                    <input type="text" name="badge_text" value="{{ old('badge_text') }}"
                           placeholder="🔥 New Arrivals 2024"
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Primary button --}}
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Button Text *</label>
                        <input type="text" name="btn_primary_text" required value="{{ old('btn_primary_text','Shop Now →') }}"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('btn_primary_text')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Button URL *</label>
                        <input type="text" name="btn_primary_url" required value="{{ old('btn_primary_url','/products') }}"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('btn_primary_url')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Secondary button --}}
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">2nd Button</label>
                        <input type="text" name="btn_secondary_text" value="{{ old('btn_secondary_text') }}"
                               placeholder="Learn More"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">2nd URL</label>
                        <input type="text" name="btn_secondary_url" value="{{ old('btn_secondary_url') }}"
                               placeholder="/about"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                {{-- Stats --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">
                        Stats Bar <span class="font-normal text-slate-400">(3 stats shown at bottom of slide)</span>
                    </label>
                    <div class="grid grid-cols-3 gap-1.5 mb-1.5">
                        <input type="text" name="stat_1_value" value="{{ old('stat_1_value') }}"
                               placeholder="KES 245K"
                               class="border border-slate-300 rounded-xl px-2 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 text-center">
                        <input type="text" name="stat_2_value" value="{{ old('stat_2_value') }}"
                               placeholder="M3 Pro"
                               class="border border-slate-300 rounded-xl px-2 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 text-center">
                        <input type="text" name="stat_3_value" value="{{ old('stat_3_value') }}"
                               placeholder="22hr"
                               class="border border-slate-300 rounded-xl px-2 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 text-center">
                    </div>
                    <div class="grid grid-cols-3 gap-1.5">
                        <input type="text" name="stat_1_label" value="{{ old('stat_1_label') }}"
                               placeholder="Starting from"
                               class="border border-slate-300 rounded-xl px-2 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 text-center">
                        <input type="text" name="stat_2_label" value="{{ old('stat_2_label') }}"
                               placeholder="Chip"
                               class="border border-slate-300 rounded-xl px-2 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 text-center">
                        <input type="text" name="stat_3_label" value="{{ old('stat_3_label') }}"
                               placeholder="Battery"
                               class="border border-slate-300 rounded-xl px-2 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 text-center">
                    </div>
                    <p class="text-xs text-slate-400 mt-1">Top row: values · Bottom row: labels</p>
                </div>

                {{-- Active toggle --}}
                <label class="flex items-center gap-2.5 cursor-pointer p-3 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition">
                    <input type="checkbox" name="is_active" value="1" checked
                           class="w-4 h-4 text-blue-600 rounded">
                    <div>
                        <p class="text-sm font-semibold text-slate-800">✅ Active — show on homepage</p>
                        <p class="text-xs text-slate-400">Uncheck to hide this slide without deleting it</p>
                    </div>
                </label>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-sm transition shadow-lg shadow-blue-500/20 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Slide
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ── EDIT MODAL ── --}}
<div id="edit-modal"
     class="fixed inset-0 bg-black/60 z-50 hidden items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b border-slate-100 sticky top-0 bg-white z-10">
            <h2 class="font-display font-bold text-lg text-slate-900">Edit Carousel Slide</h2>
            <button onclick="closeEditModal()"
                    class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-lg transition">
                ✕
            </button>
        </div>
        <form id="edit-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf @method('PUT')

            {{-- Current image + replace --}}
            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">
                    Current Image
                </label>
                <div id="edit-current-img-wrap" class="hidden mb-3">
                    <img id="edit-current-img" src="" alt=""
                         class="w-full max-h-36 rounded-xl object-cover border border-slate-200">
                    <p class="text-xs text-slate-400 mt-1">Upload a new image below to replace it.</p>
                </div>
                <label class="flex items-center justify-center border-2 border-dashed border-slate-300 rounded-xl p-4 cursor-pointer hover:border-blue-400 hover:bg-blue-50/20 transition">
                    <div class="text-center">
                        <p class="text-sm font-semibold text-blue-600">Click to upload new image</p>
                        <p class="text-xs text-slate-400 mt-0.5">JPG, PNG, WebP — max 5MB · Leave blank to keep current</p>
                    </div>
                    <input type="file" name="image" accept="image/*" class="hidden">
                </label>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Main Title *</label>
                    <input type="text" name="title" id="e-title" required
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Subtitle</label>
                    <input type="text" name="subtitle" id="e-subtitle"
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Badge Text</label>
                    <input type="text" name="badge_text" id="e-badge"
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-2">
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Description</label>
                    <textarea name="description" id="e-desc" rows="2"
                              class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Button Text *</label>
                    <input type="text" name="btn_primary_text" id="e-btn1-text" required
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Button URL *</label>
                    <input type="text" name="btn_primary_url" id="e-btn1-url" required
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">2nd Button</label>
                    <input type="text" name="btn_secondary_text" id="e-btn2-text"
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">2nd URL</label>
                    <input type="text" name="btn_secondary_url" id="e-btn2-url"
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            {{-- Stats --}}
            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Stats Bar</label>
                <div class="grid grid-cols-3 gap-1.5 mb-1.5">
                    <input type="text" name="stat_1_value" id="e-s1v" placeholder="Value"
                           class="border border-slate-300 rounded-xl px-2 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 text-center">
                    <input type="text" name="stat_2_value" id="e-s2v" placeholder="Value"
                           class="border border-slate-300 rounded-xl px-2 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 text-center">
                    <input type="text" name="stat_3_value" id="e-s3v" placeholder="Value"
                           class="border border-slate-300 rounded-xl px-2 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 text-center">
                </div>
                <div class="grid grid-cols-3 gap-1.5">
                    <input type="text" name="stat_1_label" id="e-s1l" placeholder="Label"
                           class="border border-slate-300 rounded-xl px-2 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 text-center">
                    <input type="text" name="stat_2_label" id="e-s2l" placeholder="Label"
                           class="border border-slate-300 rounded-xl px-2 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 text-center">
                    <input type="text" name="stat_3_label" id="e-s3l" placeholder="Label"
                           class="border border-slate-300 rounded-xl px-2 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 text-center">
                </div>
            </div>

            <label class="flex items-center gap-2.5 cursor-pointer p-3 bg-slate-50 rounded-xl border border-slate-200">
                <input type="checkbox" name="is_active" id="e-active" value="1"
                       class="w-4 h-4 text-blue-600 rounded">
                <span class="text-sm font-semibold text-slate-800">Active — show on homepage</span>
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-sm transition shadow-lg shadow-blue-500/20">
                    Save Changes
                </button>
                <button type="button" onclick="closeEditModal()"
                        class="px-6 py-3 border border-slate-300 text-slate-600 hover:bg-slate-50 rounded-xl font-semibold text-sm transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Preview image on add form
function previewAddImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('add-placeholder').classList.add('hidden');
            const img = document.getElementById('add-preview');
            img.src = e.target.result;
            img.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Open edit modal and populate fields
function openEditModal(id, slide) {
    document.getElementById('edit-form').action = '/admin/carousel/' + id;

    document.getElementById('e-title').value      = slide.title        || '';
    document.getElementById('e-subtitle').value   = slide.subtitle     || '';
    document.getElementById('e-badge').value      = slide.badge_text   || '';
    document.getElementById('e-desc').value       = slide.description  || '';
    document.getElementById('e-btn1-text').value  = slide.btn_primary_text   || '';
    document.getElementById('e-btn1-url').value   = slide.btn_primary_url    || '';
    document.getElementById('e-btn2-text').value  = slide.btn_secondary_text || '';
    document.getElementById('e-btn2-url').value   = slide.btn_secondary_url  || '';
    document.getElementById('e-s1v').value        = slide.stat_1_value || '';
    document.getElementById('e-s1l').value        = slide.stat_1_label || '';
    document.getElementById('e-s2v').value        = slide.stat_2_value || '';
    document.getElementById('e-s2l').value        = slide.stat_2_label || '';
    document.getElementById('e-s3v').value        = slide.stat_3_value || '';
    document.getElementById('e-s3l').value        = slide.stat_3_label || '';
    document.getElementById('e-active').checked   = slide.is_active == 1;

    // Show current image
    const imgWrap = document.getElementById('edit-current-img-wrap');
    const imgEl   = document.getElementById('edit-current-img');
    if (slide.image) {
        imgEl.src = '/storage/' + slide.image;
        imgWrap.classList.remove('hidden');
    } else {
        imgWrap.classList.add('hidden');
    }

    const modal = document.getElementById('edit-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('edit-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Close on backdrop click
document.getElementById('edit-modal').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});
</script>

@endsection