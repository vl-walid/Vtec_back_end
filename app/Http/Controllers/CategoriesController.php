<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     $validated = $request->validate([
          "category_name" => "required|string|max:255"
        ]);
        Categories::create(["category_name"=>$validated["category_name"]]);

        return response()->json(['message' => 'Category created successfully!'], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Retrieve the id_category from the request
        $idCategory = $request->input('id_category');

        try {
            // Find the category by its ID
            $category = Categories::findOrFail($idCategory);

            // Delete the category
            $category->delete();

            // Return success message
            return response()->json(['message' => 'Category deleted successfully!'], 200);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error deleting category: ' . $e->getMessage());

            // Return error message if the category is not found or another error occurs
            return response()->json(['error' => 'Category not found or could not be deleted.'], 404);
        }
    }
}
