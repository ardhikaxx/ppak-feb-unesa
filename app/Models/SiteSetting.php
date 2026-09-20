<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'group', 'key', 'value', 'type', 'label', 'description', 'sort_order',
    ];

    public const CACHE_KEY = 'ppak:site-settings';

    /**
     * Ambil semua settings sebagai array key => value (di-cache).
     */
    public static function allKeyed(): array
    {
        return Cache::remember(self::CACHE_KEY, 3600, function () {
            return self::query()->pluck('value', 'key')->all();
        });
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        $all = self::allKeyed();

        return $all[$key] ?? $default;
    }

    public static function flushCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    protected static function booted(): void
    {
        static::saved(fn () => self::flushCache());
        static::deleted(fn () => self::flushCache());
    }
}
