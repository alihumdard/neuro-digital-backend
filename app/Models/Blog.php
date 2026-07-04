<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'blog_title',
        'slug',
        'short_description',
        'blog_image',
        'image_alt_text',
        'content',
        'read_time',
        'is_featured',
        'status',
        'blog_category_id',
        'meta_title',
        'meta_description',
        'target_keyword',
        'secondary_keywords',
    ];

    public function blogCategory (){
        return $this->belongsTo(BlogCategory::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: 'blog';
        $slug = $baseSlug;
        $suffix = 2;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
