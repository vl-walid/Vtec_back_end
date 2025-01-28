<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ModelController extends Controller
{
    public function getModelsByBrand(Request $request)
    {
        // Validate brand_id
        $request->validate([
            'brand_id' => 'required|integer', // Ensure this is the correct parameter
        ]);
    
        // Get the brand ID from the query parameter
        $brandId = $request->query('brand_id'); // Change 'barnd_id' to 'brand_id'
    
        // Fetch all models for the given brand ID
        $models = VehicleModel::where('brand_id', $brandId)->get(['id', 'name' ,'is_active']); // Use 'brand_id'
    
        // Return response (adjust as needed)
        return response()->json($models);
    }
    public function getActivatedModelsByBrand(Request $request)
    {
        // Validate brand_id
        $request->validate([
            'brand_id' => 'required|integer', // Ensure this is the correct parameter
        ]);
    
        // Get the brand ID from the query parameter
        $brandId = $request->query('brand_id'); // Change 'barnd_id' to 'brand_id'
    
        // Fetch all models for the given brand ID where is_active is 1
        $models = VehicleModel::where('brand_id', $brandId)
                              ->where('is_active', 1)  // Filter models by active status
                              ->get(['id', 'name', 'is_active']);
    
        // Return response (adjust as needed)
        return response()->json($models);
    }
    
    public function store(Request $request)
    {
        // Validate that the model name and brand ID are provided
        $request->validate([
            'model_name' => 'required|string',  // Validate model name
            'brand_id' => 'required|exists:brands,id', // Validate that the brand exists in the brands table
        ]);
    
        // Retrieve the brand based on the brand_id
        $brand = Brand::findOrFail($request->brand_id);
    
        // Set the type to 'model' (fixed)
        $type = 'model';
    
        // Use the model_name from the request to generate the image filename
        $modelName = $request->model_name;
    
        // Create the model
        $model = VehicleModel::create([
            'type' => $type,  // Always set 'type' to 'model'
            'brand_id' => $brand->id,  // The ID of the brand
            'slug' => Str::slug($modelName), // Generate the slug from the model name
            'name' => $modelName,  // Model name from the request
        ]);
    
        // Return success response
        return response()->json([
            'message' => 'Model created successfully',
            'data' => $model
        ], 201);
    }

    public function toggleActiveStatus($id)
    {
        $model = VehicleModel::findOrFail($id);
        $model->is_active = !$model->is_active; // Toggle active status
        $model->save();

        // Return the updated model and all models
        return response()->json([
            'updated_model' => $model,
        ]);
    }
    
}
