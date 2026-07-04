<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function blogStore(Request $request)
    {
        $request->validate([
            'blog_title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'blog_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'blog_image_url' => 'nullable|url|max:2048',
            'content' => 'nullable|string',
            'read_time' => 'nullable|integer|min:1',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'is_featured' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'target_keyword' => 'nullable|string|max:255',
            'secondary_keywords' => 'nullable|string|max:500',
            'image_alt_text' => 'nullable|string|max:255',
            'status' => 'nullable|in:draft,published',
        ]);

        $imagePath = $this->resolveIncomingImage($request);
        $slugSource = $request->filled('slug') ? $request->slug : $request->blog_title;

        $blog = Blog::create([
            'blog_title' => $request->blog_title,
            'slug' => Blog::generateUniqueSlug($slugSource),
            'short_description' => $request->short_description,
            'blog_image' => $imagePath,
            'image_alt_text' => $request->image_alt_text,
            'content' => $request->content,
            'read_time' => $request->read_time,
            'blog_category_id' => $request->blog_category_id,
            'is_featured' => $request->boolean('is_featured'),
            'status' => $request->status ?: 'published',
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'target_keyword' => $request->target_keyword,
            'secondary_keywords' => $request->secondary_keywords,
        ]);

        return response()->json([
            'message' => 'Blog created successfully',
            'data' => new BlogResource($blog),
        ]);
    }

    public function index()
    {

        $blogs = Blog::with('blogCategory')->get();

        return response()->json([
            'status' => true,
            'message' => 'Blogs fetched successfully',
            'data' => BlogResource::collection($blogs),
        ]);
    }

    // delete a blog from the database

    public function destroy($id)
    {
        //   $blogId = $id ?? $request->input('id');


        //  dd($id);
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->json([
            "message" => "Blog is deleted successfully"
        ], 200);
    }

    // update blog

    public function updateBlog(Request $request, $id)
    {
        // find blog
        $blog = Blog::findOrFail($id);

        // validation
        $validated = $request->validate([
            'blog_title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'blog_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'blog_image_url' => 'nullable|url|max:2048',
            'content' => 'nullable|string',
            'read_time' => 'nullable|integer|min:1',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'target_keyword' => 'nullable|string|max:255',
            'secondary_keywords' => 'nullable|string|max:500',
            'image_alt_text' => 'nullable|string|max:255',
            'status' => 'nullable|in:draft,published',
        ]);

        unset($validated['blog_image_url']);

        // Handle image update (uploaded file takes priority, then an external URL, otherwise keep existing)
        $imagePath = $this->resolveIncomingImage($request);

        if ($imagePath !== null) {
            if ($request->hasFile('blog_image') && $blog->blog_image && ! str_starts_with($blog->blog_image, 'http') && Storage::disk('public')->exists($blog->blog_image)) {
                Storage::disk('public')->delete($blog->blog_image);
            }

            $validated['blog_image'] = $imagePath;
        }

        // handle featured flag
        $validated['is_featured'] = $request->boolean('is_featured');

        // regenerate slug when the user-provided slug or title changed
        $desiredSlug = $request->filled('slug') ? $request->slug : $validated['blog_title'];

        if (\Illuminate\Support\Str::slug($desiredSlug) !== $blog->slug) {
            $validated['slug'] = Blog::generateUniqueSlug($desiredSlug, $blog->id);
        } else {
            unset($validated['slug']);
        }

        // update blog
        $blog->update($validated);

        return response()->json([
            'message' => 'Blog updated successfully',
            'data' => new BlogResource($blog)
        ]);
    }

    // upload an image from the blog content editor and return its public URL
    public function uploadContentImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $path = $request->file('image')->store('blog-content', 'public');

        return response()->json([
            'message' => 'Image uploaded successfully',
            'url' => asset('storage/' . $path),
        ]);
    }

    private function resolveIncomingImage(Request $request): ?string
    {
        if ($request->hasFile('blog_image')) {
            return $request->file('blog_image')->store('blogs', 'public');
        }

        if ($request->filled('blog_image_url')) {
            return $request->input('blog_image_url');
        }

        return null;
    }
}
