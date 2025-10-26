<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
        'color',
        'is_featured',
        'show_in_menu',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'icon',
        'parent_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'show_in_menu' => 'boolean',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Parent-child relationships
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function subcategories()
    {
        return $this->children();
    }

    // Scope for parent categories only
    public function scopeParents($query)
    {
        return $query->where('parent_id', 0);
    }

    // Scope for subcategories only
    public function scopeSubcategories($query)
    {
        return $query->where('parent_id', '>', 0);
    }

    // Check if category is parent
    public function isParent()
    {
        return $this->parent_id == 0;
    }

    // Check if category is subcategory
    public function isSubcategory()
    {
        return $this->parent_id > 0;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
