<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'session_id',
        'user_id',
        'ip_address',
        'user_agent',
        'referer',
        'landing_page',
        'source',
        'medium',
        'campaign',
        'term',
        'content',
        'gclid',
        'is_paid',
        'channel',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
