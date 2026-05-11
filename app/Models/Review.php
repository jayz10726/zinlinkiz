<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'product_bought',
        'location',
        'rating',
        'review_text',
        'status',
        'is_featured',
        'initials',
        'avatar_color',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'rating'      => 'integer',
    ];

    public function scopeApproved($q)  { return $q->where('status', 'approved'); }
    public function scopePending($q)   { return $q->where('status', 'pending'); }
    public function scopeFeatured($q)  { return $q->where('is_featured', true)->where('status', 'approved'); }
}