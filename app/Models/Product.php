<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'gallery' => 'array',
        'specifications' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // --- Locale-aware accessors: keeps Blade files free of if/else ---

    public function getNameAttribute(): string
    {
        return app()->getLocale() === 'en' ? $this->name_en : $this->name_id;
    }

    public function getExcerptAttribute(): ?string
    {
        return app()->getLocale() === 'en' ? $this->excerpt_en : $this->excerpt_id;
    }

    public function getDescriptionAttribute(): ?string
    {
        return app()->getLocale() === 'en' ? $this->description_en : $this->description_id;
    }

    public function getMetaTitleAttribute(): ?string
    {
        return (app()->getLocale() === 'en' ? $this->meta_title_en : $this->meta_title_id) ?: $this->name;
    }

    public function getMetaDescriptionAttribute(): ?string
    {
        return (app()->getLocale() === 'en' ? $this->meta_description_en : $this->meta_description_id) ?: $this->excerpt;
    }

    public function getThumbnailUrlAttribute(): string
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : asset('assets/img/placeholder-product.jpg');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
