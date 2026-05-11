<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 
class CarouselSlide extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'title', 'subtitle', 'description', 'image',
        'badge_text', 'badge_color',
        'btn_primary_text', 'btn_primary_url', 'btn_primary_color',
        'btn_secondary_text', 'btn_secondary_url',
        'overlay_color',
        'stat_1_value', 'stat_1_label',
        'stat_2_value', 'stat_2_label',
        'stat_3_value', 'stat_3_label',
        'sort_order', 'is_active',
    ];
 
    protected $casts = [
        'is_active' => 'boolean',
    ];
 
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
 
    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset('storage/' . $this->image) : '';
    }
}
 