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

Route::post('/contact-us', [InquiryController::class , 'inquiryStore'])->name('inquiry.store');
// store blog data
Route::post('/create/blog', [BlogsController::class , 'blogStore'])->name('create.blog');
Route::get('/blogs', [BlogsController::class , 'index'])->name('blog.index');
//store blogs category 
Route::post('/category', [BlogCategoriesController::class , 'storeBlogCategory'])->name('store.blogCategory');


