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

    /**
     * Get cover image URL or fall back to high-res YouTube thumbnail.
     */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->cover_image_path && Storage::disk('public')->exists($this->cover_image_path)) {
            return Storage::disk('public')->url($this->cover_image_path);
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
