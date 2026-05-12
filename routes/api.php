<?php

use App\Http\Controllers\InquiryController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API route is working',
    ]);
});

Route::post('/contact-us', [InquiryController::class , 'inquiryStore'])->name('inquiry.store');


