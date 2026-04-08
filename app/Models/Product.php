<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'stock',
        'sku',
        'brand',
        'category',
        'category_id',
        'gender',
        'image',
        'sizes',
        'colors',
        'specifications',
        'is_featured',
        'is_active',
        'total_sold'
    ];

    protected $casts = [
        'sizes' => 'array',
        'colors' => 'array',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the product's image URL.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600';
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }

    // Scope untuk produk aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Relasi ke kategori
    public function categoryModel()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Scope untuk produk featured
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Hitung harga setelah diskon
    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    // Cek apakah ada diskon
    public function getHasDiscountAttribute()
    {
        return !is_null($this->discount_price) && $this->discount_price < $this->price;
    }

    // Relasi ke ulasan
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function sizes_details()
    {
        return $this->hasMany(ProductSize::class);
    }
}