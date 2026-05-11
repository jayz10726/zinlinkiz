<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category',
        'brand',
        'specs',
        'featured',
        'is_active',
    ];
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'featured' => 'boolean',
        'is_active' => 'boolean',
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
}
