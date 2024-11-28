<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListItem;
use App\Models\BlogPost; // Ensure you include this if you're using foreign keys
use Faker\Factory as Faker;
class ListItemSeeder extends Seeder
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
            foreach (range(1, 5) as $index) { // Create 5 list items for each blog post
                ListItem::create([
                    'blog_post_id' => $post->id,
                    'list_content' => $faker->sentence(4),
                ]);
            }

    }
    }
}
