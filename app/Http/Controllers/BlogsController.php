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
            'short_description' => 'nullable|string|max:500',
            'blog_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'nullable|string',
            'read_time' => 'nullable|integer|min:1',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'is_featured' => 'nullable|boolean',
        ]);

        $imagePath = null;

        if ($request->hasFile('blog_image')) {
            $imagePath = $request->file('blog_image')->store('blogs', 'public');
        }

        $blog = Blog::create([
            'blog_title' => $request->blog_title,
            'slug' => Blog::generateUniqueSlug($request->blog_title),
            'short_description' => $request->short_description,
            'blog_image' => $imagePath,
            // 'blog_image' => asset('storage/' . $this->$imagePath),
            'content' => $request->content,
            'read_time' => $request->read_time,
            'blog_category_id' => $request->blog_category_id,
            'is_featured' => $request->boolean('is_featured'),
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
            'short_description' => 'nullable|string|max:500',
            'blog_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'content' => 'nullable|string',
            'read_time' => 'nullable|integer|min:1',
            'blog_category_id' => 'required|exists:blog_categories,id',
        ]);

        // Handle image update
        if ($request->hasFile('blog_image')) {
            // Delete old image if exists
            if ($blog->blog_image && Storage::disk('public')->exists($blog->blog_image)) {
                Storage::disk('public')->delete($blog->blog_image);
            }

            $imagePath = $request->file('blog_image')->store('blogs', 'public');
            $validated['blog_image'] = $imagePath;
        }

        // handle featured flag
        $validated['is_featured'] = $request->boolean('is_featured');

        // regenerate slug only when the title actually changed
        if ($validated['blog_title'] !== $blog->blog_title) {
            $validated['slug'] = Blog::generateUniqueSlug($validated['blog_title'], $blog->id);
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
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $path = $request->file('image')->store('blog-content', 'public');

        return response()->json([
            'message' => 'Image uploaded successfully',
            'url' => asset('storage/' . $path),
        ]);
    }
}
