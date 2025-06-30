<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'category_id',
        'user_id',
        'admin_id',
        'author_type',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical_url',
        'schema_markup',
        'views_count',
        'is_featured',
        'is_approved',
        'reading_time',
        'seo_score'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views_count' => 'integer',
        'is_featured' => 'boolean',
        'is_approved' => 'boolean',
        'reading_time' => 'integer',
        'seo_score' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function author()
    {
        return $this->author_type === 'admin' ? $this->admin() : $this->user();
    }

    public function getAuthorNameAttribute()
    {
        if ($this->author_type === 'admin') {
            return $this->admin ? $this->admin->name : 'Unknown Admin';
        }
        return $this->user ? $this->user->name : 'Unknown User';
    }

    public function getAuthorTypeLabelAttribute()
    {
        return $this->author_type === 'admin' ? 'Admin' : 'User';
    }

    public function getContentHtmlAttribute()
    {
        return Str::markdown($this->content);
    }

    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return ceil($wordCount / 200);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }
        return Str::limit(strip_tags($this->content), 150);
    }

    public function getSeoScoreAttribute($value)
    {
        if ($value) {
            return $value;
        }

        $score = 0;

        // Title length (50-60 characters is optimal)
        if (strlen($this->title) >= 50 && strlen($this->title) <= 60) {
            $score += 20;
        } elseif (strlen($this->title) >= 30 && strlen($this->title) <= 70) {
            $score += 15;
        } else {
            $score += 5;
        }

        // Meta description length (150-160 characters is optimal)
        if (strlen($this->meta_description) >= 150 && strlen($this->meta_description) <= 160) {
            $score += 20;
        } elseif (strlen($this->meta_description) >= 120 && strlen($this->meta_description) <= 200) {
            $score += 15;
        } else {
            $score += 5;
        }

        // Content length (minimum 300 words)
        $wordCount = str_word_count(strip_tags($this->content));
        if ($wordCount >= 300) {
            $score += 20;
        } elseif ($wordCount >= 150) {
            $score += 10;
        }

        // Featured image
        if ($this->featured_image) {
            $score += 15;
        }

        // Keywords
        if ($this->meta_keywords) {
            $score += 10;
        }

        // Excerpt
        if ($this->excerpt) {
            $score += 10;
        }

        return min($score, 100);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('is_approved', true)
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function getFullUrlAttribute()
    {
        return url('/post/' . $this->slug);
    }

    public function getOgImageUrlAttribute()
    {
        if ($this->og_image) {
            return Storage::url($this->og_image);
        }
        return $this->featured_image ? Storage::url($this->featured_image) : asset('images/default-og.jpg');
    }

    public function getTwitterImageUrlAttribute()
    {
        if ($this->twitter_image) {
            return Storage::url($this->twitter_image);
        }
        return $this->featured_image ? Storage::url($this->featured_image) : asset('images/default-twitter.jpg');
    }
}
