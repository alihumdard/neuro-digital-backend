<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Seed the application's blogs.
     */
    public function run(): void
    {
        $categories = BlogCategory::query()
            ->pluck('id', 'name');

        $blogs = [
            [
                'blog_title' => 'Understanding the Neurodivergent Algorithmic Misfit (NAM) Framework',
                'short_description' => 'A deep dive into how digital systems often misinterpret neurodivergent behaviours and how we can change that.',
                'content' => 'Digital systems often reward uniform behavior, predictable engagement patterns, and narrow communication styles. The NAM framework helps teams identify where those assumptions create friction for neurodivergent users and offers a path toward more inclusive product decisions.',
                'blog_image' => 'blogs/research-insights-hub.jpeg',
                'read_time' => 5,
                'is_featured' => true,
                'blog_category_id' => $categories['Research Insights'],
                'created_at' => Carbon::createFromFormat('M d, Y', 'Apr 12, 2025'),
                'updated_at' => Carbon::createFromFormat('M d, Y', 'Apr 12, 2025'),
            ],
            [
                'blog_title' => '5 Ways to Reduce Digital Sensory Overload Today',
                'short_description' => 'Simple, actionable strategies to create a calmer, more manageable online experience for neurodivergent minds.',
                'content' => 'From reducing animation density to simplifying notification patterns, small product changes can significantly lower cognitive load. These strategies help individuals and teams create digital environments that feel calmer, safer, and easier to navigate.',
                'blog_image' => 'blogs/homepage.jpeg',
                'read_time' => 5,
                'is_featured' => false,
                'blog_category_id' => $categories['Digital Safety'],
                'created_at' => Carbon::createFromFormat('M d, Y', 'Apr 10, 2025'),
                'updated_at' => Carbon::createFromFormat('M d, Y', 'Apr 10, 2025'),
            ],
            [
                'blog_title' => 'Building a Neuroinclusive Workplace: A Guide for HR',
                'short_description' => 'Practical steps HR leaders can take to foster inclusion, support wellbeing, and unlock neurodivergent talent.',
                'content' => 'Neuroinclusive workplaces are built through clear processes, flexible communication norms, and thoughtful accommodations. This guide outlines how HR leaders can turn inclusion from a statement into a daily operational practice.',
                'blog_image' => 'blogs/supportworker.jpeg',
                'read_time' => 5,
                'is_featured' => true,
                'blog_category_id' => $categories['Community'],
                'created_at' => Carbon::createFromFormat('M d, Y', 'Apr 08, 2025'),
                'updated_at' => Carbon::createFromFormat('M d, Y', 'Apr 08, 2025'),
            ],
            [
                'blog_title' => 'The Role of AI in Ethical Moderation for Autistic Users',
                'short_description' => 'Exploring how AI can be designed and trained to better serve autistic and neurodivergent communities.',
                'content' => 'AI moderation systems can unintentionally penalize direct communication, atypical language patterns, or repeated posting behaviors. Ethical design begins by testing moderation assumptions against real neurodivergent experiences.',
                'blog_image' => 'blogs/digital-advocacy-hub.jpeg',
                'read_time' => 6,
                'is_featured' => false,
                'blog_category_id' => $categories['Research Insights'],
                'created_at' => Carbon::createFromFormat('M d, Y', 'Apr 05, 2025'),
                'updated_at' => Carbon::createFromFormat('M d, Y', 'Apr 05, 2025'),
            ],
            [
                'blog_title' => 'Self-Identification in the Digital Age: Community vs. Clinical',
                'short_description' => 'Why self-identification matters and how online communities are shaping new models of understanding.',
                'content' => 'For many people, online communities provide language, recognition, and support long before formal assessment becomes accessible. This article looks at how digital spaces are changing the conversation around identity and belonging.',
                'blog_image' => 'blogs/about.png',
                'read_time' => 5,
                'is_featured' => false,
                'blog_category_id' => $categories['Community'],
                'created_at' => Carbon::createFromFormat('M d, Y', 'Apr 03, 2025'),
                'updated_at' => Carbon::createFromFormat('M d, Y', 'Apr 03, 2025'),
            ],
            [
                'blog_title' => 'How NuroTok is Redefining Social Interaction for ADHD Adults',
                'short_description' => 'Inside NuroTok\'s mission to build engaging, dopamine-friendly spaces that put users first.',
                'content' => 'Platforms built for attention extraction often leave ADHD users overwhelmed or depleted. NuroTok is exploring a different approach: designing interaction loops that are stimulating, respectful, and easier to control.',
                'blog_image' => 'blogs/nurotok.jpeg',
                'read_time' => 5,
                'is_featured' => true,
                'blog_category_id' => $categories['News'],
                'created_at' => Carbon::createFromFormat('M d, Y', 'Apr 01, 2025'),
                'updated_at' => Carbon::createFromFormat('M d, Y', 'Apr 01, 2025'),
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::updateOrCreate(
                ['blog_title' => $blog['blog_title']],
                $blog
            );
        }
    }
}
