<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->blog_title,
            'image' => $this->resolveImageUrl(),
            'image_alt_text' => $this->image_alt_text,
            'short_description' => $this->short_description,
            'content' => $this->content,
            'Time' => $this->read_time,
            'is_featured' => $this->is_featured,
            'status' => $this->status,
            'category' => $this->blogCategory?->name,
            'blog_category_id' => $this->blog_category_id,
            'date' => $this->created_at?->format('M d, Y'),
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'target_keyword' => $this->target_keyword,
            'secondary_keywords' => $this->secondary_keywords,
        ];
    }

    private function resolveImageUrl(): ?string
    {
        if (! $this->blog_image) {
            return null;
        }

        if (str_starts_with($this->blog_image, 'http://') || str_starts_with($this->blog_image, 'https://')) {
            return $this->blog_image;
        }

        return asset('storage/' . $this->blog_image);
    }
}
