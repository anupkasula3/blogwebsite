<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'type',
        'status',
        'image_path',
        'html_code',
        'destination_url',
        'start_at',
        'end_at',
        'is_active',
        'manual_embed_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function placements(): BelongsToMany
    {
        return $this->belongsToMany(AdPlacement::class, 'ad_placement_assignments')
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

    public function isCurrentlyActive(): bool
    {
        $now = now();
        if (!$this->is_active || $this->status !== 'active') {
            return false;
        }
        if ($this->start_at && $now->lt($this->start_at))
            return false;
        if ($this->end_at && $now->gt($this->end_at))
            return false;
        return true;
    }
}
