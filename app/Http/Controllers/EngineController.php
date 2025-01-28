<?php

namespace App\Http\Controllers;

use App\Models\Engine;
use Illuminate\Http\Request;
use App\Models\Generation;


class EngineController extends Controller
{
    public function getEnginesByGeneration(Request $request)
    {
        // Validate brand_id
        $request->validate([
            'generation_id' => 'required|integer', // Ensure this is the correct parameter
        ]);
    
        // Get the brand ID from the query parameter
        $modelId = $request->query('generation_id'); // Change 'barnd_id' to 'brand_id'
    
        // Fetch all models for the given brand ID
        $engines = Engine::where('generation_id', $modelId)->get(['id', 'name' ,'is_active']); // Use 'brand_id'
    
        // Return response (adjust as needed)
        return response()->json($engines);
    }

    public function getActivatedEnginesByGeneration(Request $request)
    {
        // Validate generation_id
        $request->validate([
            'generation_id' => 'required|integer', // Ensure this is the correct parameter
        ]);
    
        // Get the generation ID from the query parameter
        $generationId = $request->query('generation_id'); 
    
        // Fetch all engines for the given generation ID where is_active is 1
        $engines = Engine::where('generation_id', $generationId)
                         ->where('is_active', 1)  // Filter engines by active status
                         ->get(['id', 'name', 'is_active']);
    
        // Return response
        return response()->json($engines);
    }
    
    public function store(Request $request)
    {
        // Validate that the engine name and generation ID are provided
        $request->validate([
            'engine_name' => 'required|string',  // Validate engine name
            'generation_id' => 'required|exists:generations,id', // Validate that the generation exists in the generations table
        ]);
    
        // Retrieve the generation based on the generation_id
        $generation = Generation::findOrFail($request->generation_id);
    
        // Create the engine
        $engine = Engine::create([
            'generation_id' => $generation->id,  // The ID of the generation
            'name' => $request->engine_name,  // Engine name from the request
            'is_active' => true,  // Set default as active
        ]);
    
        // Return success response with created engine
        return response()->json([
            'message' => 'Engine created successfully',
            'data' => $engine
        ], 201);
    }
    public function toggleActiveStatus($id)
    {
        $engine = Engine::findOrFail($id);
        $engine->is_active = !$engine->is_active; // Toggle active status
        $engine->save();

        // Return the updated engine and all engines
        return response()->json([
            'updated_engine' => $engine,
        ]);
    }
    
}
