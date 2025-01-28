<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function getVehicleCategories()
    {
        // Fetch all vehicle categories
        $categories = Category::all();

        return response()->json($categories);
    }

    public function getActivatedVehicleCategories()
    {
        // Fetch all vehicle categories where is_active is 1
        $categories = Category::where('is_active', 1)->get();
    
        return response()->json($categories);
    }
    
    // Method to add a new category
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Create a new category
        $category = Category::create([
            'category_name' => $request->input('category_name'),
        ]);

        // Respond with success (for API or frontend)
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully!',
            'data' => $category,
        ], 201);
    }
    
    public function destroy($id)
    {
        // Restrict deletion for categories with IDs from 1 to 6
        if ($id >= 1 && $id <= 6) {
            return response()->json(['error' => 'Cannot delete this category.'], 403); // 403 Forbidden
        }

        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found.'], 404); // 404 Not Found
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully.'], 200); // 200 OK
    }

    public function toggleActive($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);
    
        // Toggle the 'is_active' status
        $category->is_active = !$category->is_active;
    
        // Save the updated status
        $category->save();
    
        // Fetch all categories
        $categories = Category::all();
    
        // Return the updated category and all categories as a JSON response
        return response()->json([
            'updated_category' => $category,
            'all_categories' => $categories,
        ]);
    }



  
    public function updateCategoryNames()
    {
        $translations = [
            'Lastwagen' => 'LKW',
        ];

        foreach ($translations as $english => $german) {
            Category::where('category_name', "Lastwagen")->update(['category_name' => "LKW"]);
        }

        // Return a response (optional)
        return response()->json(['message' => 'Category names updated successfully!']);
    }
    
}
