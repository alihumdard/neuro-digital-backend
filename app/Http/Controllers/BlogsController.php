<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

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
        ]);

        $imagePath = null;

        if ($request->hasFile('blog_image')) {
            $imagePath = $request->file('blog_image')->store('blogs', 'public');
        }

        Blog::create([
            'blog_title' => $request->blog_title,
            'short_description' => $request->short_description,
            'blog_image' => $imagePath,
            // 'blog_image' => asset('storage/' . $this->$imagePath),
            'content' => $request->content,
            'read_time' => $request->read_time,
            'blog_category_id' => $request->blog_category_id,
        ]);

        return response()->json([

            'message' => 'Blog created successfully',

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
}
