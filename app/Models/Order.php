<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number', 'customer_name', 'customer_email',
        'customer_phone', 'customer_address', 'city',
        'subtotal', 'shipping', 'total',
        'status', 'payment_method', 'notes',
    ];

    // ── Relationships ──────────────────────────────────────
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function trackings()
    {
        return $this->hasMany(OrderTracking::class)->orderBy('created_at', 'desc');
    }

    // ── Helpers ────────────────────────────────────────────
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending'    => 'amber',
            'confirmed'  => 'blue',
            'processing' => 'indigo',
            'shipped'    => 'purple',
            'delivered'  => 'emerald',
            'cancelled'  => 'red',
            default      => 'slate',
        };
    }

    public function getStatusIconAttribute(): string
    {
        return match($this->status) {
            'pending'    => '⏳',
            'confirmed'  => '✅',
            'processing' => '⚙️',
            'shipped'    => '🚚',
            'delivered'  => '🎉',
            'cancelled'  => '❌',
            default      => '📦',
        };
    }
}