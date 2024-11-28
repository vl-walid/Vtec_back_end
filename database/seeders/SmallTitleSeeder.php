<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SmallTitle;
use App\Models\BlogPost; // Ensure you include this if you're using foreign keys
use Faker\Factory as Faker;
class SmallTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            $faker = Faker::create();

            // Assuming you have some blog posts already created
            $blogPosts = BlogPost::all();

            foreach ($blogPosts as $post) {
                foreach (range(1, 3) as $index) { // Create 3 small titles for each blog post
                    SmallTitle::create([
                        'blog_post_id' => $post->id,
                        'title' => $faker->sentence(3),
                        'paragraph' => $faker->paragraph(2),
                    ]);
                }
            }

    }
}
