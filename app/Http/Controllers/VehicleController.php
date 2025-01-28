<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleTuning;
use App\Models\Engine;;
class VehicleController extends Controller
{
    public function getEcusByEngineId(Request $request)
    {
        // Validate engine_id
        $request->validate([
            'engine_id' => 'required|integer',
        ]);

        // Get the engine_id from the request
        $engineId = $request->input('engine_id');

        // Fetch vehicles based on the engine_id
        $vehicles = Vehicle::where('engine_id', $engineId)
            ->get(['id', 'full_name', 'ecu']); // Select only the fields we need

        // Return response as JSON
        return response()->json($vehicles);
    }

    public function getActivatedEcusByEngineId(Request $request)
{
    // Validate engine_id
    $request->validate([
        'engine_id' => 'required|integer',
    ]);

    // Get the engine_id from the request
    $engineId = $request->input('engine_id');

    // Fetch vehicles based on the engine_id where is_active is 1
    $vehicles = Vehicle::where('engine_id', $engineId)
                       ->where('is_active', 1)  // Filter vehicles by active status
                       ->get(['id', 'full_name', 'ecu']); // Select only the fields we need

    // Return response as JSON
    return response()->json($vehicles);
}



    public function getVehicleDetails(Request $request)
    {
        $vehicleId = $request->input('vehicle_id');
    
        if (!$vehicleId) {
            return response()->json(['error' => 'Vehicle ID is required.'], 400);
        }
    
        // Fetch the vehicle details
        $vehicle = Vehicle::find($vehicleId);
    
        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle not found.'], 404);
        }
    
        // Fetch all tuning details for the vehicle
        $vehicleTuning = VehicleTuning::where('vehicle_id', $vehicleId)->get();
    
        return response()->json([
            'vehicle' => $vehicle,
            'tuning' => $vehicleTuning,
        ]);
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'engine_id' => 'required|exists:engines,id', // Validate that the engine exists in the engines table
                'full_name' => 'required|string|max:255',
                'standard_power' => 'required|numeric',
                'standard_torque' => 'required|numeric',
                'fuel' => 'required|string|max:50',
                'ecu' => 'required|string|max:100',
                'rpm' => 'required', // Added max length
                'oem_power_chart' => 'required', // Added max length
                'oem_torque_chart' => 'required', // Added max length
            ]);
    
            $vehicle = Vehicle::create([
                'engine_id' => $request->engine_id,
                'full_name' => $request->full_name,
                'standard_power' => $request->standard_power,
                'standard_torque' => $request->standard_torque,
                'fuel' => $request->fuel,
                'ecu' => $request->ecu,
                'rpm' => $request->rpm,
                'oem_power_chart' => $request->oem_power_chart,
                'oem_torque_chart' => $request->oem_torque_chart,
                'is_active' => true,
            ]);
    
            return response()->json([
                'message' => 'Vehicle created successfully',
                'data' => $vehicle,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422); // Debug validation errors
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Debug any other errors
        }
    }
    

    public function search(Request $request)
    {
        // Retrieve 'full_name' from query parameters
        $fullName = $request->query('full_name'); // Same as $request->input('full_name');
    
        // Validate the parameter
        $request->validate([
            'full_name' => 'required|string|min:1',
        ]);
    
        // Perform the search
        $vehicles = Vehicle::where('full_name', 'LIKE', '%' . $fullName . '%')->get();
    
        // Return the response as JSON
        return response()->json($vehicles, 200);
    }
    

    public function toggleActive($vehicleId, Request $request)
    {
        // Validate incoming data
        $request->validate([
            'is_active' => 'required|boolean',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        // Find the vehicle by ID
        $vehicle = Vehicle::findOrFail($vehicleId);

        // Update the vehicle's is_active status
        $vehicle->is_active = $request->input('is_active');
        $vehicle->save();

        // Return a response (optional)
        return response()->json([
            'message' => 'Vehicle status updated successfully.',
            'vehicle' => $vehicle,
        ]);
    }
}
