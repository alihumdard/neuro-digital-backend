<?php

namespace App\Console\Commands;

use App\Models\Blog;
use Illuminate\Console\Command;

class BackfillBlogSlugs extends Command
{
    protected $signature = 'blogs:backfill-slugs';

    protected $description = 'Generate slugs for any blog posts that do not have one yet';

    public function handle(): int
    {
        $blogs = Blog::whereNull('slug')->orWhere('slug', '')->get();

        foreach ($blogs as $blog) {
            $blog->update([
                'slug' => Blog::generateUniqueSlug($blog->blog_title ?: "blog-{$blog->id}", $blog->id),
            ]);
        }

        $this->info("Backfilled slugs for {$blogs->count()} blog(s).");

        return self::SUCCESS;
    }
}
