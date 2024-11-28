<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\SmallTitle;
use App\Models\ListItem;
class BlogPostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'blog_overview_id' => 'required|exists:blog_overviews,id',
            'main_paragraph' => 'required',
            'summary_paragraph' => 'nullable',
            'additional_image_1' => 'nullable|string',
            'additional_image_2' => 'nullable|string',
        ]);

        $blogPost = BlogPost::create([
            'blog_overview_id' => $request->input('blog_overview_id'),
            'main_paragraph' => $request->input('main_paragraph'),
            'summary_paragraph' => $request->input('summary_paragraph'),
            'additional_image_1' => $request->input('additional_image_1'),
            'additional_image_2' => $request->input('additional_image_2'),
        ]);

        return response()->json($blogPost, 201);
    }

    // Get blog post by overview ID
    public function show($blog_overview_id)
    {
        $blogPost = BlogPost::where('blog_overview_id', $blog_overview_id)->first();

        if ($blogPost) {
            return response()->json($blogPost);
        }

        return response()->json(['message' => 'Blog post not found'], 404);
    }

    // Update an existing blog post
    public function update(Request $request, $blog_overview_id)
    {
        $blogPost = BlogPost::where('blog_overview_id', $blog_overview_id)->first();

        if (!$blogPost) {
            return response()->json(['message' => 'Blog post not found'], 404);
        }

        $request->validate([
            'main_paragraph' => 'required',
            'summary_paragraph' => 'nullable',
            'additional_image_1' => 'nullable|string',
            'additional_image_2' => 'nullable|string',
        ]);

        $blogPost->update([
            'main_paragraph' => $request->input('main_paragraph'),
            'summary_paragraph' => $request->input('summary_paragraph'),
            'additional_image_1' => $request->input('additional_image_1'),
            'additional_image_2' => $request->input('additional_image_2'),
        ]);

        return response()->json(['message' => 'Blog post updated successfully']);
    }

    // Delete a blog post
    public function destroy($blog_overview_id)
    {
        $blogPost = BlogPost::where('blog_overview_id', $blog_overview_id)->first();

        if (!$blogPost) {
            return response()->json(['message' => 'Blog post not found'], 404);
        }

        $blogPost->delete();

        return response()->json(['message' => 'Blog post deleted successfully']);
    }

    public function showdetails($id): JsonResponse
    {
        // Retrieve the blog post and related overview
        $blogPost = BlogPost::with(['overview', 'smallTitles', 'listItems'])
            ->where('blog_overview_id', $id)
            ->firstOrFail();

        return response()->json([
            'blogPost' => $blogPost,             // Includes 'smallTitles' and 'listItems'
            'blogOverview' => $blogPost->overview, // Fetches the related blogOverview
        ]);
    }
}
