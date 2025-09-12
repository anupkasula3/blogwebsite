<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdPlacement extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'key',
        'description',
        'width',
        'height',
        'is_auto',
        'default_display_count',
        'default_gap',
        'embed_token',
    ];

    protected $casts = [
        'is_auto' => 'boolean',
        'width' => 'integer',
        'height' => 'integer',
        'default_display_count' => 'integer',
    ];

    public function ads(): BelongsToMany
    {
        return $this->belongsToMany(Ad::class, 'ad_placement_assignments')
            ->withPivot(['weight', 'priority', 'is_active'])
            ->withTimestamps();
    }

    public function impressions(): HasMany
    {
        return $this->hasMany(AdImpression::class);
    }

    public function clicks(): HasMany
    {
        return $this->hasMany(AdClick::class);
    }
}
