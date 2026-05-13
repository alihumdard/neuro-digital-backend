<?php

namespace App\Http\Controllers;

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
}
