<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogPost;
class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogPost::create([
            'blog_overview_id' => 4, // Assuming the first overview corresponds to this post
            'main_paragraph' => 'This is the main paragraph for the first blog post.',
            'summary_paragraph' => 'Summary for the first blog post.',
            'additional_image_1' => 'additional1.jpg',
            'additional_image_2' => 'additional2.jpg',
        ]);

        BlogPost::create([
            'blog_overview_id' => 5,
            'main_paragraph' => 'This is the main paragraph for the second blog post.',
            'summary_paragraph' => 'Summary for the second blog post.',
            'additional_image_1' => 'additional3.jpg',
            'additional_image_2' => null,
        ]);

        BlogPost::create([
            'blog_overview_id' => 6,
            'main_paragraph' => 'This is the main paragraph for the third blog post.',
            'summary_paragraph' => 'Summary for the third blog post.',
            'additional_image_1' => 'additional4.jpg',
            'additional_image_2' => 'additional5.jpg',
        ]);
    }
}
