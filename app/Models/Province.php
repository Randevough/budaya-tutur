<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function regencies(): HasMany
    {
        return $this->hasMany(Regency::class);
    }

    public function cultureItems(): HasManyThrough
    {
        return $this->hasManyThrough(CultureItem::class, Regency::class);
    }
}
