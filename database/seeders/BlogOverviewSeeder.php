<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogOverview;
class BlogOverviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        BlogOverview::create([
            'main_title' => 'First Blog Post Title',
            'main_image' => 'image1.jpg',
            'date_added' => now(),
        ]);

        BlogOverview::create([
            'main_title' => 'Second Blog Post Title',
            'main_image' => 'image2.jpg',
            'date_added' => now(),
        ]);

        BlogOverview::create([
            'main_title' => 'Third Blog Post Title',
            'main_image' => 'image3.jpg',
            'date_added' => now(),
        ]);
    }
}
