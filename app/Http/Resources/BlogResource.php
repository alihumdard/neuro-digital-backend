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
            'title' => $this->blog_title,
            'image' => asset('storage/' . $this->blog_image),
            // 'short_description' => $this->short_description,
            'content' => $this->content,
            'Time' => $this->read_time,
            'is_featured' => $this->is_featured,
            'category' => $this->blogCategory?->name,
            'date' => $this->created_at?->format('M d, Y'),

        ];
    }
}
