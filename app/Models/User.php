<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 
class User extends Authenticatable
{
    use HasFactory, Notifiable;
 
    protected $fillable = [
        'name', 'email', 'password', 'phone',
        'is_admin', 'role', 'permissions', 'is_active',
        'last_login_at',
    ];
 
    protected $hidden = ['password', 'remember_token'];
 
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at'     => 'datetime',
        'password'          => 'hashed',
        'is_admin'          => 'boolean',
        'is_active'         => 'boolean',
        'permissions'       => 'array',
    ];
 
    // ── Relationships ──────────────────────────────────
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
 
    // ── Role helpers ───────────────────────────────────
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }
 
    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'super_admin']) || $this->is_admin;
    }
 
    public function isCustomer(): bool
    {
        return $this->role === 'customer' && !$this->is_admin;
    }
 
    // ── Permission helpers ─────────────────────────────
    public function can_do(string $permission): bool
    {
        if ($this->isSuperAdmin()) return true;
        $perms = $this->permissions ?? [];
        return !empty($perms[$permission]);
    }
 
    public function getDefaultPermissions(): array
    {
        return [
            'manage_products'  => false,
            'manage_orders'    => false,
            'manage_reviews'   => false,
            'manage_team'      => false,
            'manage_inventory' => false,
            'manage_carousel'  => false,
            'manage_admins'    => false,
        ];
    }
}