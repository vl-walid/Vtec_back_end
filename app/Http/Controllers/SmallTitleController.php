<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;
use App\Models\SmallTitle;
use Illuminate\Http\Request;

class SmallTitleController extends Controller
{
      // Fetch small titles for a specific blog post
      public function index($blogPostId)
    {
        return SmallTitle::where('blog_post_id', $blogPostId)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'paragraph' => 'required|string',
            'blog_post_id' => 'required|exists:blog_posts,id',
        ]);

        return SmallTitle::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'paragraph' => 'required|string',
        ]);

        $smallTitle = SmallTitle::findOrFail($id);
        $smallTitle->update($request->all());

        return $smallTitle;
    }

    public function destroy($id)
    {
        SmallTitle::destroy($id);
        return response()->json(['message' => 'Small title deleted successfully!']);
    }
}
