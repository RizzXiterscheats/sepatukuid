<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the category's image URL.
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

    // Relasi ke parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Relasi ke child categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Scope untuk kategori aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk kategori utama (tidak punya parent)
    public function scopeMain($query)
    {
        return $query->whereNull('parent_id');
    }
}