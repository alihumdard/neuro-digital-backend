<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'blog_title',
        'short_description',
        'blog_image',
        'content',
        'read_time',
    ];
}
