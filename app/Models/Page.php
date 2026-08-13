<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    protected $casts = [
        'show_in_menu' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getTitleAttribute(): string
    {
        return app()->getLocale() === 'en' ? $this->title_en : $this->title_id;
    }

    public function getContentAttribute(): ?string
    {
        return app()->getLocale() === 'en' ? $this->content_en : $this->content_id;
    }

    public function getMetaTitleAttribute(): ?string
    {
        return (app()->getLocale() === 'en' ? $this->meta_title_en : $this->meta_title_id) ?: $this->title;
    }

    public function getMetaDescriptionAttribute(): ?string
    {
        return app()->getLocale() === 'en' ? $this->meta_description_en : $this->meta_description_id;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublished($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('published_at')->orWhere('published_at', '<=', now());
        });
    }
}
