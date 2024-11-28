<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BlogPost;
use App\Models\ListItem;

class ListItemController extends Controller
{
    public function index($blogPostId)
    {
        return ListItem::where('blog_post_id', $blogPostId)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'list_content' => 'required|string|max:255',
            'blog_post_id' => 'required|exists:blog_posts,id',
        ]);

        return ListItem::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'list_content' => 'required|string|max:255',
        ]);

        $listItem = ListItem::findOrFail($id);
        $listItem->update($request->all());

        return $listItem;
    }

    public function destroy($id)
    {
        ListItem::destroy($id);
        return response()->json(['message' => 'List item deleted successfully!']);
    }
}
