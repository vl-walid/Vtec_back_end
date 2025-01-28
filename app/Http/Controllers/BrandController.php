<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function getBrandsByCategoryId(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
        ]);
    
        // Get the category ID from the query parameter
        $categoryId = $request->query('category_id');
    
        // Fetch all brands for the given category ID
        $brands = Brand::where('categories_id', $categoryId)->get(['id', 'name','is_active']);  
    
        // Return the brands as a JSON response
        return response()->json($brands);
    }

    public function getActivatedBrandsByCategoryId(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
        ]);
    
        // Get the category ID from the query parameter
        $categoryId = $request->query('category_id');
    
        // Fetch all brands for the given category ID where is_active is 1
        $brands = Brand::where('categories_id', $categoryId)
                       ->where('is_active', 1)  // Add this condition to filter only active brands
                       ->get(['id', 'name', 'is_active']);
    
        // Return the brands as a JSON response
        return response()->json($brands);
    }
    
    public function store(Request $request)
    {
        // Validate that the brand name and category ID are provided
        $request->validate([
            'brand_name' => 'required|string',  // Validate brand name
            'category_id' => 'required|exists:categories,id', // Validate that the category exists
        ]);

        // Retrieve the category based on the category_id
        $category = Category::findOrFail($request->category_id);

        // Set the type to 'brand' (fixed)
        $type = 'brand';

        // Use the brand_name from the request to generate the image filename
        $brandName = $request->brand_name;
        $imagePath = 'brands/' . Str::slug($brandName) . '.jpg'; // Use slugified brand name as image filename

        // Create the brand
        $brand = Brand::create([
            'type' => $type,  // Always set 'type' to 'brand'
            'categories_id' => $category->id,  // The ID of the category the brand belongs to
           'slug' => Str::slug($brandName) ,
            'name' => $brandName,  // Brand name from the request

            'image' => $imagePath,  // Image name is always 'brand_name.jpg' (slugified)
        ]);

        // Return success response
        return response()->json([
            'message' => 'Brand created successfully',
            'data' => $brand
        ], 201);
    }
    
    public function toggleActiveStatus($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->is_active = !$brand->is_active; // Toggle active status
        $brand->save();
    
        // Return only the updated brand
        return response()->json([
            'updated_brand' => $brand,
        ]);
    }
    

}
