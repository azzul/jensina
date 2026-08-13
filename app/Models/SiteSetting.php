<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $guarded = [];

    /**
     * The whole site is one settings row. Cache it so app.blade.php doesn't
     * fire a query on every single request/page.
     */
    public static function current(): self
    {
        return Cache::rememberForever('site_settings', function () {
            return self::first() ?? new self();
        });
    }

    public static function forget(): void
    {
        Cache::forget('site_settings');
    }

    public function tagline(): ?string
    {
        return app()->getLocale() === 'en' ? $this->tagline_en : $this->tagline_id;
    }

    public function defaultMetaTitle(): ?string
    {
        return app()->getLocale() === 'en' ? $this->default_meta_title_en : $this->default_meta_title_id;
    }

    public function defaultMetaDescription(): ?string
    {
        return app()->getLocale() === 'en' ? $this->default_meta_description_en : $this->default_meta_description_id;
    }
}
