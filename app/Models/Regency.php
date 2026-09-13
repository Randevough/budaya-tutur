<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Regency extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id',
        'name',
        'slug',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function cultureItems(): HasMany
    {
        return $this->hasMany(CultureItem::class);
    }

    /**
     * Scope for Leaflet map markers: regencies that have published culture items.
     */
    public function scopeWithPublishedItems(Builder $query): Builder
    {
        return $query->whereHas('cultureItems', function (Builder $q) {
            $q->where('is_published', true);
        });
    }
}
