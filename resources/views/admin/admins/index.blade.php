@extends('layouts.admin')
@section('title', 'Admin Users — zinlinktech')
@section('page-title', 'Admin Users')
@section('page-subtitle', 'Add new admins and manage their access permissions')

@section('content')

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- ── LEFT: Admin list ── --}}
    <div class="xl:col-span-2 space-y-5">

        {{-- Own password change card --}}
        <div class="bg-gradient-to-r from-blue-50 to-slate-50 border border-blue-100 rounded-2xl p-5">
            <div class="flex items-center justify-between flex-wrap gap-3 mb-0" id="own-pw-header">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 {{ auth()->user()->isSuperAdmin() ? 'bg-amber-500' : 'bg-blue-600' }} rounded-xl flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr(auth()->user()->name,0,2)) }}
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 text-sm">{{ auth()->user()->name }}</p>
                        <p class="text-slate-500 text-xs">{{ auth()->user()->isSuperAdmin() ? '👑 Super Admin' : '⚙️ Admin' }} · {{ auth()->user()->email }}</p>
                    </div>
                </div>
                <button onclick="toggleOwnPw()"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm shadow-blue-500/20">
                    🔑 Change My Password
                </button>
            </div>

            <form id="own-pw-form" action="{{ route('admin.my.password') }}" method="POST"
                  class="hidden mt-4 pt-4 border-t border-blue-100">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Current Password *</label>
                        <input type="password" name="current_password" required
                               placeholder="••••••••"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('current_password') border-red-400 @enderror">
                        @error('current_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">New Password *</label>
                        <input type="password" name="new_password" required
                               placeholder="Min 8 chars"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1 uppercase tracking-wide">Confirm Password *</label>
                        <input type="password" name="new_password_confirmation" required
                               placeholder="Repeat new password"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="mt-3 flex gap-2">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition">
                        Update Password
                    </button>
                    <button type="button" onclick="toggleOwnPw()"
                            class="border border-slate-300 text-slate-600 hover:bg-slate-50 px-5 py-2.5 rounded-xl text-sm font-semibold transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>

        {{-- Admin users list --}}
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <h2 class="font-display font-bold text-lg text-slate-900">
                    All Admin Accounts
                    <span class="text-sm font-normal text-slate-400 ml-1">({{ $admins->total() }} total)</span>
                </h2>
            </div>

            @forelse($admins as $admin)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-md transition">
                    <div class="p-5">
                        <div class="flex items-start gap-4">

                            {{-- Avatar --}}
                            <div class="w-12 h-12 {{ $admin->role === 'super_admin' ? 'bg-amber-500' : 'bg-blue-600' }} rounded-xl flex items-center justify-center text-white font-bold text-base flex-shrink-0 shadow-sm">
                                {{ strtoupper(substr($admin->name,0,2)) }}
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-3 flex-wrap">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap mb-0.5">
                                            <h3 class="font-bold text-slate-900 text-base">{{ $admin->name }}</h3>
                                            @if($admin->id === auth()->id())
                                                <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-0.5 rounded-full">You</span>
                                            @endif
                                        </div>
                                        <p class="text-slate-500 text-xs">{{ $admin->email }}</p>
                                        @if($admin->phone)
                                            <p class="text-slate-400 text-xs">{{ $admin->phone }}</p>
                                        @endif
                                        @if($admin->last_login_at)
                                            <p class="text-slate-400 text-xs mt-0.5">
                                                Last login: {{ $admin->last_login_at->diffForHumans() }}
                                            </p>
                                        @endif
                                    </div>

                                    {{-- Status badges --}}
                                    <div class="flex flex-col items-end gap-1.5 flex-shrink-0">
                                        <span class="{{ $admin->role === 'super_admin' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800' }} text-xs font-bold px-2.5 py-1 rounded-full">
                                            {{ $admin->role === 'super_admin' ? '👑 Super Admin' : '⚙️ Admin' }}
                                        </span>
                                        <span class="{{ $admin->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }} text-xs font-bold px-2.5 py-1 rounded-full">
                                            {{ $admin->is_active ? '● Active' : '○ Deactivated' }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Permissions --}}
                                @if($admin->role === 'super_admin')
                                    <p class="text-amber-600 text-xs font-bold mt-2">👑 Full access to everything</p>
                                @elseif($admin->permissions)
                                    @php
                                        $permLabels = [
                                            'manage_products'  => '📦 Products',
                                            'manage_orders'    => '🛒 Orders',
                                            'manage_reviews'   => '⭐ Reviews',
                                            'manage_team'      => '👥 Team',
                                            'manage_inventory' => '📊 Inventory',
                                            'manage_carousel'  => '🖼️ Carousel',
                                            'manage_admins'    => '🔑 Admins',
                                        ];
                                    @endphp
                                    <div class="flex flex-wrap gap-1.5 mt-2">
                                        @foreach($permLabels as $key => $label)
                                            <span class="text-xs px-2 py-0.5 rounded-full font-semibold
                                                {{ !empty($admin->permissions[$key]) ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-400' }}">
                                                {{ $label }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-slate-400 text-xs mt-2">No permissions assigned yet</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Action buttons --}}
                    @if($admin->id !== auth()->id())
                        <div class="flex flex-wrap items-center gap-2 px-5 py-3 border-t border-slate-100 bg-slate-50/60">

                            {{-- Edit permissions --}}
                            @if(auth()->user()->isSuperAdmin())
                                <button onclick="openEditModal({{ $admin->id }}, {{ json_encode([
                                    'name'        => $admin->name,
                                    'email'       => $admin->email,
                                    'phone'       => $admin->phone,
                                    'role'        => $admin->role,
                                    'is_active'   => $admin->is_active,
                                    'permissions' => $admin->permissions ?? [],
                                ]) }})"
                                        class="bg-blue-50 hover:bg-blue-100 text-blue-700 px-4 py-1.5 rounded-lg text-xs font-bold transition">
                                    ✏️ Edit Permissions
                                </button>

                                {{-- Reset password --}}
                                <button onclick="openResetModal({{ $admin->id }}, '{{ addslashes($admin->name) }}')"
                                        class="bg-amber-50 hover:bg-amber-100 text-amber-700 px-4 py-1.5 rounded-lg text-xs font-bold transition">
                                    🔑 Reset Password
                                </button>

                                {{-- Toggle active --}}
                                <form action="{{ route('admin.admins.toggle', $admin->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="{{ $admin->is_active
                                                ? 'bg-red-50 text-red-600 hover:bg-red-100'
                                                : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }}
                                                px-4 py-1.5 rounded-lg text-xs font-bold transition">
                                        {{ $admin->is_active ? '🚫 Deactivate' : '✅ Activate' }}
                                    </button>
                                </form>

                                {{-- Remove --}}
                                <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST"
                                      onsubmit="return confirm('Remove {{ addslashes($admin->name) }} as admin? This cannot be undone.')"
                                      class="ml-auto">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-1.5 rounded-lg text-xs font-bold transition">
                                        🗑 Remove
                                    </button>
                                </form>
                            @else
                                <p class="text-slate-400 text-xs italic">Only Super Admins can edit other admins.</p>
                            @endif
                        </div>
                    @endif
                </div>
            @empty
                <div class="bg-white rounded-2xl border border-slate-100 p-16 text-center">
                    <div class="text-5xl mb-3">👤</div>
                    <p class="font-bold text-slate-600 text-lg mb-1">No other admins yet</p>
                    <p class="text-slate-400 text-sm">Add your first admin using the form →</p>
                </div>
            @endforelse

            <div>{{ $admins->links() }}</div>
        </div>
    </div>

    {{-- ── RIGHT: Add admin form ── --}}
    <div>
        @if(auth()->user()->isSuperAdmin())
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sticky top-24">
                <h2 class="font-display font-bold text-lg text-slate-900 mb-1">➕ Add New Admin</h2>
                <p class="text-slate-400 text-xs mb-5">Create a new admin account and set their access level.</p>

                <form action="{{ route('admin.admins.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Full Name *</label>
                        <input type="text" name="name" required value="{{ old('name') }}"
                               placeholder="Sarah Njeri"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Email Address *</label>
                        <input type="email" name="email" required value="{{ old('email') }}"
                               placeholder="sarah@zinlinktech.co.ke"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-400 @enderror">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               placeholder="+254 7xx xxx xxx"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">
                            Password *
                            <span class="font-normal text-slate-400 ml-1">min 8 chars, uppercase + number</span>
                        </label>
                        <input type="password" name="password" required
                               placeholder="SecurePass1"
                               class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-400 @enderror">
                        @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Role *</label>
                        <select name="role" id="role-select" required
                                onchange="togglePermissions(this.value)"
                                class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="admin" {{ old('role','admin') == 'admin' ? 'selected' : '' }}>
                                ⚙️ Admin — limited access
                            </option>
                            <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>
                                👑 Super Admin — full access
                            </option>
                        </select>
                    </div>

                    {{-- Permissions (hidden for super_admin) --}}
                    <div id="permissions-section"
                         class="{{ old('role') === 'super_admin' ? 'hidden' : '' }}">
                        <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">
                            Access Permissions
                        </label>
                        <div class="bg-slate-50 rounded-xl border border-slate-200 divide-y divide-slate-200 overflow-hidden">
                            @foreach([
                                'perm_products'  => ['icon'=>'📦','label'=>'Manage Products',  'desc'=>'Add, edit, delete products'],
                                'perm_orders'    => ['icon'=>'🛒','label'=>'Manage Orders',    'desc'=>'View and update order status'],
                                'perm_inventory' => ['icon'=>'📊','label'=>'Manage Inventory', 'desc'=>'Update stock levels'],
                                'perm_reviews'   => ['icon'=>'⭐','label'=>'Manage Reviews',   'desc'=>'Approve and moderate reviews'],
                                'perm_team'      => ['icon'=>'👥','label'=>'Manage Team',      'desc'=>'Add and edit team members'],
                                'perm_carousel'  => ['icon'=>'🖼️','label'=>'Manage Carousel', 'desc'=>'Edit homepage slides'],
                                'perm_admins'    => ['icon'=>'🔑','label'=>'Manage Admins',   'desc'=>'Add and edit other admins'],
                            ] as $key => $perm)
                                <label class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-blue-50/50 transition">
                                    <input type="checkbox" name="{{ $key }}" value="1"
                                           {{ in_array($key, ['perm_products','perm_orders','perm_inventory']) || old($key) ? 'checked' : '' }}
                                           class="w-4 h-4 text-blue-600 rounded border-slate-300 flex-shrink-0">
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-slate-800">{{ $perm['icon'] }} {{ $perm['label'] }}</p>
                                        <p class="text-xs text-slate-400">{{ $perm['desc'] }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <p class="text-xs text-slate-400 mt-1.5">Super Admins get all permissions automatically.</p>
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-sm transition shadow-lg shadow-blue-500/20 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Create Admin Account
                    </button>
                </form>
            </div>
        @else
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 text-center sticky top-24">
                <div class="text-4xl mb-3">🔒</div>
                <p class="font-bold text-amber-800 mb-1">Super Admin Only</p>
                <p class="text-amber-600 text-sm">Only Super Admins can add or manage other admin users.</p>
            </div>
        @endif
    </div>
</div>

{{-- ═══════════════ EDIT PERMISSIONS MODAL ═══════════════ --}}
<div id="edit-modal" class="fixed inset-0 bg-black/60 z-50 hidden items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b border-slate-100 sticky top-0 bg-white z-10">
            <h2 class="font-display font-bold text-lg text-slate-900">Edit Admin Permissions</h2>
            <button onclick="closeEditModal()"
                    class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-lg transition">✕</button>
        </div>
        <form id="edit-form" method="POST" class="p-6 space-y-5">
            @csrf @method('PUT')

            {{-- Admin info preview --}}
            <div class="bg-slate-50 rounded-xl p-3 flex items-center gap-3">
                <div id="edit-avatar" class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-sm flex-shrink-0"></div>
                <div>
                    <p id="edit-name-display" class="font-bold text-slate-900 text-sm"></p>
                    <p id="edit-email-display" class="text-slate-400 text-xs"></p>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Role *</label>
                <select name="role" id="edit-role" required
                        onchange="toggleEditPermissions(this.value)"
                        class="w-full border border-slate-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="admin">⚙️ Admin — limited access</option>
                    <option value="super_admin">👑 Super Admin — full access</option>
                </select>
            </div>

            <div id="edit-perms-section">
                <label class="block text-xs font-bold text-slate-600 mb-2 uppercase tracking-wide">Access Permissions</label>
                <div class="bg-slate-50 rounded-xl border border-slate-200 divide-y divide-slate-200 overflow-hidden">
                    @foreach([
                        'perm_products'  => ['icon'=>'📦','label'=>'Manage Products',  'desc'=>'Add, edit, delete products'],
                        'perm_orders'    => ['icon'=>'🛒','label'=>'Manage Orders',    'desc'=>'View and update order status'],
                        'perm_inventory' => ['icon'=>'📊','label'=>'Manage Inventory', 'desc'=>'Update stock levels'],
                        'perm_reviews'   => ['icon'=>'⭐','label'=>'Manage Reviews',   'desc'=>'Approve and moderate reviews'],
                        'perm_team'      => ['icon'=>'👥','label'=>'Manage Team',      'desc'=>'Add and edit team members'],
                        'perm_carousel'  => ['icon'=>'🖼️','label'=>'Manage Carousel', 'desc'=>'Edit homepage slides'],
                        'perm_admins'    => ['icon'=>'🔑','label'=>'Manage Admins',   'desc'=>'Add and edit other admins'],
                    ] as $inputName => $perm)
                        <label class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-blue-50/50 transition">
                            <input type="checkbox" name="{{ $inputName }}" value="1"
                                   id="ep_{{ $inputName }}"
                                   class="w-4 h-4 text-blue-600 rounded border-slate-300 flex-shrink-0">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">{{ $perm['icon'] }} {{ $perm['label'] }}</p>
                                <p class="text-xs text-slate-400">{{ $perm['desc'] }}</p>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <label class="flex items-center gap-3 cursor-pointer p-3 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition">
                <input type="checkbox" name="is_active" id="edit-is-active" value="1"
                       class="w-4 h-4 text-blue-600 rounded border-slate-300 flex-shrink-0">
                <div>
                    <p class="text-sm font-semibold text-slate-800">Account Active</p>
                    <p class="text-xs text-slate-400">Uncheck to prevent this admin from logging in</p>
                </div>
            </label>

            <div class="flex gap-3 pt-1">
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

{{-- ═══════════════ RESET PASSWORD MODAL ═══════════════ --}}
<div id="reset-modal" class="fixed inset-0 bg-black/60 z-50 hidden items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between p-6 border-b border-slate-100">
            <h2 class="font-display font-bold text-lg text-slate-900">Reset Admin Password</h2>
            <button onclick="closeResetModal()"
                    class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-lg transition">✕</button>
        </div>
        <form id="reset-form" method="POST" class="p-6 space-y-4">
            @csrf

            <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 flex items-center gap-3">
                <span class="text-2xl">⚠️</span>
                <div>
                    <p class="text-amber-800 text-sm font-bold">Resetting password for: <span id="reset-name-display" class="text-amber-900"></span></p>
                    <p class="text-amber-600 text-xs mt-0.5">Share the new password securely with this admin.</p>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">New Password *</label>
                <input type="password" name="new_password" required
                       placeholder="Min 8 chars, uppercase + number"
                       class="w-full border border-slate-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex gap-3 pt-1">
                <button type="submit"
                        class="flex-1 bg-amber-500 hover:bg-amber-600 text-white py-3 rounded-xl font-bold text-sm transition shadow-lg shadow-amber-500/20">
                    🔑 Reset Password
                </button>
                <button type="button" onclick="closeResetModal()"
                        class="px-6 py-3 border border-slate-300 text-slate-600 hover:bg-slate-50 rounded-xl font-semibold text-sm transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Toggle own password form
function toggleOwnPw() {
    const form = document.getElementById('own-pw-form');
    form.classList.toggle('hidden');
}

// Toggle permissions section based on role
function togglePermissions(role) {
    const section = document.getElementById('permissions-section');
    section.style.display = role === 'super_admin' ? 'none' : 'block';
}

function toggleEditPermissions(role) {
    const section = document.getElementById('edit-perms-section');
    section.style.display = role === 'super_admin' ? 'none' : 'block';
}

// Permission key map
const permMap = {
    'ep_perm_products'  : 'manage_products',
    'ep_perm_orders'    : 'manage_orders',
    'ep_perm_inventory' : 'manage_inventory',
    'ep_perm_reviews'   : 'manage_reviews',
    'ep_perm_team'      : 'manage_team',
    'ep_perm_carousel'  : 'manage_carousel',
    'ep_perm_admins'    : 'manage_admins',
};

// Open edit modal
function openEditModal(id, admin) {
    document.getElementById('edit-form').action = '/admin/admins/' + id;

    // Avatar + name
    const av = document.getElementById('edit-avatar');
    av.textContent   = admin.name.substring(0, 2).toUpperCase();
    av.className     = 'w-10 h-10 ' + (admin.role === 'super_admin' ? 'bg-amber-500' : 'bg-blue-600') + ' rounded-xl flex items-center justify-center text-white font-bold text-sm flex-shrink-0';
    document.getElementById('edit-name-display').textContent  = admin.name;
    document.getElementById('edit-email-display').textContent = admin.email;

    // Role
    document.getElementById('edit-role').value = admin.role || 'admin';
    toggleEditPermissions(admin.role);

    // Permissions
    for (const [inputId, permKey] of Object.entries(permMap)) {
        const el = document.getElementById(inputId);
        if (el) el.checked = !!(admin.permissions && admin.permissions[permKey]);
    }

    // Active status
    document.getElementById('edit-is-active').checked = admin.is_active == 1;

    const modal = document.getElementById('edit-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeEditModal() {
    document.getElementById('edit-modal').classList.add('hidden');
    document.getElementById('edit-modal').classList.remove('flex');
}

// Open reset password modal
function openResetModal(id, name) {
    document.getElementById('reset-form').action = '/admin/admins/' + id + '/reset-password';
    document.getElementById('reset-name-display').textContent = name;
    const modal = document.getElementById('reset-modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeResetModal() {
    document.getElementById('reset-modal').classList.add('hidden');
    document.getElementById('reset-modal').classList.remove('flex');
}

// Close modals on backdrop click
['edit-modal','reset-modal'].forEach(id => {
    document.getElementById(id).addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            this.classList.remove('flex');
        }
    });
});
</script>

@endsection