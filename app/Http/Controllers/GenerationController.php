<?php

namespace App\Http\Controllers;

use App\Models\Generation;
use Illuminate\Http\Request;
use App\Models\VehicleModel;

class GenerationController extends Controller
{
    public function getGenerationsByModel(Request $request)
    {
        // Validate brand_id
        $request->validate([
            'model_id' => 'required|integer', // Ensure this is the correct parameter
        ]);
    
        // Get the brand ID from the query parameter
        $modelId = $request->query('model_id'); // Change 'barnd_id' to 'brand_id'
    
        // Fetch all models for the given brand ID
        $generations = Generation::where('model_id', $modelId)->get(['id', 'name' ,'is_active']); // Use 'brand_id'
    
        // Return response (adjust as needed)
        return response()->json($generations);
    }
    public function getActivatedGenerationsByModel(Request $request)
    {
        // Validate model_id
        $request->validate([
            'model_id' => 'required|integer', // Ensure this is the correct parameter
        ]);
    
        // Get the model ID from the query parameter
        $modelId = $request->query('model_id'); 
    
        // Fetch all generations for the given model ID where is_active is 1
        $generations = Generation::where('model_id', $modelId)
                                  ->where('is_active', 1)  // Filter generations by active status
                                  ->get(['id', 'name', 'is_active']);
    
        // Return response
        return response()->json($generations);
    }
    
    public function store(Request $request)
{
    // Validate that the generation name and model ID are provided
    $request->validate([
        'generation_name' => 'required|string',  // Validate generation name
        'model_id' => 'required|exists:models,id', // Validate that the model exists in the models table
    ]);

    // Retrieve the model based on the model_id
    $model = VehicleModel::findOrFail($request->model_id);

    // Create the generation
    $generation = Generation::create([
        'model_id' => $model->id,  // The ID of the model
        'name' => $request->generation_name,  // Generation name from the request
        'is_active' => true,  // Set default as active
    ]);

    // Return success response with created generation
    return response()->json([
        'message' => 'Generation created successfully',
        'data' => $generation
    ], 201);
}

public function toggleActiveStatus($id)
    {
        $generation = Generation::findOrFail($id);
        $generation->is_active = !$generation->is_active; // Toggle active status
        $generation->save();

        // Return the updated generation and all generations
        return response()->json([
            'updated_generation' => $generation,
        ]);
    }

}
