<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogOverview;
class BlogOverviewController extends Controller
{
    public function index(Request $request)
    {
        // Get the page number from the request, default to 1
        $page = $request->input('page', 1);
        $perPage = 4; // Number of blogs per page

        $blogOverviews = BlogOverview::paginate($perPage);

        return response()->json($blogOverviews);
    }


    public function getLatestNews()
    {
        $latestNews = BlogOverview::orderBy('date_added', 'desc')->take(2)->get();
        return response()->json($latestNews);
    }


    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'main_image_url' => 'required|string', // This will be the Cloudinary URL
            'date_added' => 'required|date',
        ]);

        // Create the new blog entry in the database
        $blog = BlogOverview::create([
            'main_title' => $validated['title'],
            'main_image' => $validated['main_image_url'],
            'date_added' => $validated['date_added'],
        ]);

        // Return a response (you can customize this)
        return response()->json([
            'message' => 'Blog post created successfully!',
            'blog' => $blog,
        ], 201);
    }



    public function update(Request $request, $id)
    {
        $blogOverview = BlogOverview::find($id);

        if (!$blogOverview) {
            return response()->json(['message' => 'Blog overview not found.'], 404);
        }

        // Validate the request, allowing either 'main_title' or 'main_image' to be optional
        $validatedData = $request->validate([
            'main_title' => 'nullable|string|max:255', // 'nullable' allows this field to be optional
            'main_image' => 'nullable|string',         // 'nullable' allows this field to be optional
        ]);

        // Update blog overview fields if they are provided in the request
        if ($request->has('main_title')) {
            $blogOverview->main_title = $validatedData['main_title'];
        }

        if ($request->has('main_image')) {
            $blogOverview->main_image = $validatedData['main_image'];
        }

        $blogOverview->save();

        return response()->json(['message' => 'Blog overview updated successfully.'], 200);
    }


    public function destroy($id)
    {
        $blogOverview = BlogOverview::find($id);

        if ($blogOverview) {
            $blogOverview->delete();
            return response()->json(['message' => 'Blog overview deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Blog overview not found.'], 404);
        }
    }
}
