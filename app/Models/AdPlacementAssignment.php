<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdPlacementAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'ad_placement_id',
        'weight',
        'priority',
        'is_active'
    ];

    protected $casts = [
        'weight' => 'integer',
        'priority' => 'integer',
        'is_active' => 'boolean',
    ];

    public function ad(): BelongsTo
    {
        return $this->belongsTo(Ad::class);
    }

    public function adPlacement(): BelongsTo
    {
        return $this->belongsTo(AdPlacement::class);
    }
}
