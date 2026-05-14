<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoriesController extends Controller
{
    public function storeBlogCategory(Request $request)
    {
        $request->validate([
      'name' => 'required|string|unique:blog_categories,name',
        ]);

        BlogCategory::create([
            'name' => $request->name,
        ]);

        return response()->json([
            "message" => "category added successfully"
        ]);
    }
    public function update(Request $request , $id)
    {
        $blogCategory = BlogCategory::findOrFail($id);
       $validated = $request->validate([
      'name' => 'required|string|unique:blog_categories,name',
        ]);

        $blogCategory->update($validated);
        return response()->json([
            "message" => "category updated successfully"
        ]);
    }

    // showing all blogs 

    public function index () {
        $blogsCategory = BlogCategory:: all();
        // dd($blogsCategory);
        return response()->json([
            "message" => "All blog categories are successfully fetched",
            "data" => $blogsCategory
        ]);

    }
   // delere category
     public function destroy($id)
    {
        //   $blogId = $id ?? $request->input('id');


        //  dd($id);
        $category = BlogCategory::findOrFail($id);
        $category->delete();

        return response()->json([
            "message" => "Category is deleted successfully"
        ], 200);
    }
}
