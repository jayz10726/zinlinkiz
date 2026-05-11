@extends('layouts.admin')
@section('title', 'Our Team — zinlinktech Admin')
@section('page-title', 'Our Team')
@section('page-subtitle', 'Manage team members shown on the About page')

@section('content')

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- ── Team Members List ── --}}
    <div class="xl:col-span-2 space-y-4">
        <div class="flex items-center justify-between mb-2">
            <p class="text-sm text-slate-500">{{ $team->total() }} team member(s)</p>
        </div>

        @forelse($team as $member)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 hover:shadow-md transition">
                <div class="flex items-start gap-4">

                    {{-- Photo or Avatar --}}
                    <div class="flex-shrink-0">
                        @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}"
                                 alt="{{ $member->name }}"
                                 class="w-16 h-16 rounded-2xl object-cover border-2 border-slate-100 shadow-sm">
                        @else
                            <div class="w-16 h-16 {{ $member->avatar_color ?? 'bg-blue-600' }} rounded-2xl flex items-center justify-center text-white text-xl font-display font-bold shadow-sm">
                                {{ $member->initials ?: strtoupper(substr($member->name,0,2)) }}
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-3 flex-wrap">
                            <div>
                                <h3 class="font-display font-bold text-slate-900 text-base">{{ $member->name }}</h3>
                                <p class="text-blue-600 text-xs font-bold uppercase tracking-wide">{{ $member->role }}</p>
                            </div>
                            <span class="{{ $member->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }} text-xs font-bold px-2.5 py-1 rounded-full flex-shrink-0">
                                {{ $member->is_active ? 'Visible' : 'Hidden' }}
                            </span>
                        </div>

                        @if($member->bio)
                            <p class="text-slate-500 text-sm mt-1.5 line-clamp-2">{{ $member->bio }}</p>
                        @endif

                        <div class="flex flex-wrap gap-4 mt-2 text-xs text-slate-400">
                            @if($member->phone)
                                <span>📞 {{ $member->phone }}</span>
                            @endif
                            @if($member->email)
                                <span>✉️ {{ $member->email }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Action buttons --}}
                <div class="flex items-center gap-2 mt-4 pt-3 border-t border-slate-100">
                    <button onclick="openEditModal(
                                {{ $member->id }},
                                '{{ addslashes($member->name) }}',
                                '{{ addslashes($member->role) }}',
                                '{{ addslashes($member->bio ?? '') }}',
                                '{{ addslashes($member->phone ?? '') }}',
                                '{{ addslashes($member->email ?? '') }}',
                                '{{ $member->avatar_color ?? 'bg-blue-600' }}',
                                {{ $member->is_active ? 'true' : 'false' }}
                            )"
                            class="bg-blue-50 hover:bg-blue-100 text-blue-700 px-4 py-1.5 rounded-lg text-xs font-bold transition">
                        ✏️ Edit
                    </button>

                    <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST"
                          onsubmit="return confirm('Remove {{ addslashes($member->name) }} from the team?')">
                        @csrf @method('DELETE')
                        <button class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-1.5 rounded-lg text-xs font-bold transition">
                            🗑 Remove
                        </button>
                    </form>

                    <span class="ml-auto text-xs text-slate-400">Position #{{ $member->sort_order + 1 }}</span>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-slate-100 p-16 text-center">
                <div class="text-5xl mb-3">👥</div>
                <p class="font-bold text-slate-600 text-lg mb-1">No team members yet</p>
                <p class="text-slate-400 text-sm">Add your first team member using the form →</p>
            </div>
        @endforelse

        <div>{{ $team->links() }}</div>
    </div>

    {{-- ── Add New Member Form ── --}}
    <div>
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sticky top-24">
            <h2 class="font-display font-bold text-lg text-slate-900 mb-5 pb-3 border-b border-slate-100">
                ➕ Add Team Member
            </h2>
            <form action="{{ route('admin.team.store') }}" method="POST"
                  enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Full Name *</label>
                    <input type="text" name="name" required value="{{ old('name') }}"
                           placeholder="David Kamau"
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Job Title / Role *</label>
                    <input type="text" name="role" required value="{{ old('role') }}"
                           placeholder="Founder & CEO"
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role') border-red-400 @enderror">
                    @error('role')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Short Bio</label>
                    <textarea name="bio" rows="3"
                              placeholder="Brief description of their expertise..."
                              class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('bio') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               placeholder="+254 7xx xxx xxx"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="name@zinlinktech.com"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
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
                    <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Photo (optional)</label>
                    <label for="new-photo" class="flex flex-col items-center justify-center border-2 border-dashed border-slate-300 rounded-xl p-4 cursor-pointer hover:border-blue-400 hover:bg-blue-50/20 transition">
                        <p class="text-sm font-semibold text-blue-600">Click to upload photo</p>
                        <p class="text-xs text-slate-400 mt-0.5">JPG, PNG — max 2MB</p>
                        <input type="file" id="new-photo" name="photo" accept="image/*" class="hidden"
                               onchange="document.getElementById('new-photo-name').textContent = this.files[0]?.name ?? ''; document.getElementById('new-photo-name').classList.remove('hidden');">
                    </label>
                    <p id="new-photo-name" class="text-xs text-slate-500 mt-1 hidden"></p>
                </div>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-blue-600 rounded">
                    <span class="text-sm font-semibold text-slate-700">✅ Show on About page</span>
                </label>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-sm transition shadow-lg shadow-blue-500/20">
                    Add Team Member
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div id="edit-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b border-slate-100 sticky top-0 bg-white">
            <h2 class="font-display font-bold text-lg text-slate-900">Edit Team Member</h2>
            <button onclick="closeEditModal()"
                    class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-500 transition font-bold">✕</button>
        </div>
        <form id="edit-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Full Name *</label>
                <input type="text" name="name" id="edit-name" required
                       class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Job Title / Role *</label>
                <input type="text" name="role" id="edit-role" required
                       class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Short Bio</label>
                <textarea name="bio" id="edit-bio" rows="3"
                          class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Phone</label>
                    <input type="text" name="phone" id="edit-phone"
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Email</label>
                    <input type="email" name="email" id="edit-email"
                           class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Avatar Color</label>
                <div class="flex gap-2 flex-wrap">
                    @foreach(['bg-blue-600','bg-emerald-600','bg-pink-600','bg-purple-600','bg-orange-600','bg-teal-600','bg-red-600','bg-indigo-600'] as $color)
                        <label class="cursor-pointer">
                            <input type="radio" name="avatar_color" value="{{ $color }}" class="sr-only peer edit-color-radio">
                            <div class="w-7 h-7 {{ $color }} rounded-full ring-2 ring-transparent peer-checked:ring-slate-900 peer-checked:scale-110 transition-all shadow-sm"></div>
                        </label>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">New Photo (optional)</label>
                <input type="file" name="photo" accept="image/*"
                       class="w-full border border-slate-300 rounded-xl px-3 py-2 text-sm">
            </div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" id="edit-active" value="1" class="w-4 h-4 text-blue-600 rounded">
                <span class="text-sm font-semibold text-slate-700">Show on About page</span>
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-sm transition">
                    Save Changes
                </button>
                <button type="button" onclick="closeEditModal()"
                        class="px-5 py-3 border border-slate-300 text-slate-600 hover:bg-slate-50 rounded-xl font-semibold text-sm transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, name, role, bio, phone, email, color, isActive) {
    document.getElementById('edit-form').action = '/admin/team/' + id;
    document.getElementById('edit-name').value   = name;
    document.getElementById('edit-role').value   = role;
    document.getElementById('edit-bio').value    = bio;
    document.getElementById('edit-phone').value  = phone;
    document.getElementById('edit-email').value  = email;
    document.getElementById('edit-active').checked = isActive;

    document.querySelectorAll('.edit-color-radio').forEach(r => {
        r.checked = (r.value === color);
    });

    const modal = document.getElementById('edit-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    const modal = document.getElementById('edit-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

document.getElementById('edit-modal').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});
</script>

@endsection