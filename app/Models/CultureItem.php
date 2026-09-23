<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CultureItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'regency_id',
        'title',
        'slug',
        'category',
        'excerpt',
        'description',
        'youtube_id',
        'cover_image_path',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    protected static function booted(): void
    {
        static::saving(function (CultureItem $item) {
            if ($item->isDirty('cover_image_path') && filled($item->cover_image_path)) {
                \App\Services\ImageOptimizer::optimizeCoverImage($item->cover_image_path);
            }
        });

        static::saved(function () {
            static::clearPerformanceCaches();
        });

        static::deleted(function () {
            static::clearPerformanceCaches();
        });
    }

    /**
     * Flush cached lists and counters when culture items are modified.
     */
    public static function clearPerformanceCaches(): void
    {
        \Illuminate\Support\Facades\Cache::forget('published_provinces_filter');
        \Illuminate\Support\Facades\Cache::forget('home_map_regencies');
        \Illuminate\Support\Facades\Cache::forget('home_stats');
    }

    /**
     * Get lightweight thumbnail URL (optimized for grid cards, ~25KB).
     */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->cover_image_path) {
            $thumbPath = 'covers/thumbnails/' . basename($this->cover_image_path);
            if (file_exists(public_path('storage/' . $thumbPath))) {
                return asset('storage/' . $thumbPath);
            }

            return asset('storage/' . $this->cover_image_path);
        }

        if ($this->youtube_id) {
            // hqdefault (480x360) is ~25KB compared to maxresdefault ~250KB (10x lighter for grid lists)
            return "https://img.youtube.com/vi/{$this->youtube_id}/hqdefault.jpg";
        }

        return '';
    }

    /**
     * Get high-resolution cover image URL (for detail hero player, ~200KB).
     */
    public function getCoverUrlAttribute(): string
    {
        if ($this->cover_image_path) {
            return asset('storage/' . $this->cover_image_path);
        }

        if ($this->youtube_id) {
            return "https://img.youtube.com/vi/{$this->youtube_id}/maxresdefault.jpg";
        }

        return '';
    }

    /**
     * YouTube privacy-enhanced embed URL per brief.
     */
    public function getYoutubeEmbedUrlAttribute(): string
    {
        if (! $this->youtube_id) {
            return '';
        }

        return "https://www.youtube-nocookie.com/embed/{$this->youtube_id}?autoplay=1&modestbranding=1&rel=0";
    }
}
