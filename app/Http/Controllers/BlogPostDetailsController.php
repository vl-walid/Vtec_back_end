<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\SmallTitle;
use App\Models\ListItem;
use Illuminate\Http\Request;
class BlogPostDetailsController extends Controller
{
    public function show($id)
{
    // Retrieve the blog post and related overview
    $blogPost = BlogPost::with(['smallTitles', 'listItems'])
        ->where('id', $id)
        ->firstOrFail();

    // Get the blog overview based on the blog_post's blog_overview_id
    $blogOverview = $blogPost->blogOverview; // Assuming you have defined the relation in BlogPost model

    return response()->json([
        'blogPost' => $blogPost,
        'blogOverview' => $blogOverview,
    ]);
}
}
