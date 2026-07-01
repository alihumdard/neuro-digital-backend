<?php

use App\Http\Controllers\BlogCategoriesController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\InquiryController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API route is working',
    ]);
});
//------------------------------ Routes for contact us page------------------
// contact-us form  submission
Route::post('/contact-us', [InquiryController::class , 'inquiryStore'])->name('inquiry.store');

//-----------------------------------Routes for Blogs-----------------------------

// getting all blogs with categories
Route::get('/blogs', [BlogsController::class , 'index'])->name('blog.index');

Route::middleware('admin.key')->group(function () {
    // store blog data
    Route::post('/create/blog', [BlogsController::class , 'blogStore'])->name('create.blog');
    // update the blog
    Route::post('/update/blog/{id}', [BlogsController::class , 'updateBlog'])->name('update.blog');
    // Delete Blog api route
    Route::delete('/blog/delete/{id}', [BlogsController::class , 'destroy'])->name('delete.blog');
});

//------------------------ Routes for blog's categories----------------------------------

// getting all blog's  categories
Route::get('/categories', [BlogCategoriesController::class , 'index'])->name('category.index');

Route::middleware('admin.key')->group(function () {
    //store blogs category
    Route::post('/add/category', [BlogCategoriesController::class , 'storeBlogCategory'])->name('create.blogCategory');
    //update category of blog
    Route::post('/category/update/{id}', [BlogCategoriesController::class , 'update'])->name('update.blogCategory');
    // Delete category
    Route::delete('/category/delete/{id}', [BlogCategoriesController::class , 'destroy'])->name('delete.blogCategory');
});

