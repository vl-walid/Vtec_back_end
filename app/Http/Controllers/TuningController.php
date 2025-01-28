<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Tuning;
use App\Models\Vehicle;
use App\Models\VehicleTuning;

class TuningController extends Controller
{
    public function index()
    {
        $tunings = Tuning::all();
        return response()->json($tunings);
    }

    // Store a new tuning
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tuning = new Tuning();
        $tuning->name = $request->name;
        $tuning->save();

        return response()->json(['message' => 'Tuning added successfully!', 'tuning' => $tuning], 201);
    }


    public function addTuning(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'tunings' => 'required|array', // Validate tunings as an array
            'tunings.*.tuning_id' => 'required|exists:tunings,id', // Validate each tuning
            'tunings.*.difference_power' => 'required|integer',
            'tunings.*.difference_torque' => 'required|integer',
            'tunings.*.max_power' => 'nullable|integer',
            'tunings.*.max_torque' => 'nullable|integer',
            'tunings.*.power_chart' => 'required|string',
            'tunings.*.torque_chart' => 'required|string',
            'tunings.*.tuning_stage' => 'required|string',
            'tunings.*.price' => 'nullable', // Validate price as numeric, optional
        ]);
    
        // Extract tunings and vehicle_id
        $tunings = $validatedData['tunings'];
        $vehicle_id = $validatedData['vehicle_id'];
    
        $createdTunings = [];
        foreach ($tunings as $tuningData) {
            // Convert price to a number (float) if it's provided
            if (isset($tuningData['price'])) {
                $tuningData['price'] = (float)$tuningData['price']; // or you can use `floatval($tuningData['price'])`
            }
    
            // Attach vehicle ID to each tuning
            $tuningData['vehicle_id'] = $vehicle_id;
    
            // Create and save the tuning
            $createdTunings[] = VehicleTuning::create($tuningData);
        }
    
        // Return response with the created tunings
        return response()->json([
            'message' => 'Tunings added successfully',
            'tunings' => $createdTunings,
            'tuningsprice' => $validatedData['tunings'],
        ], 201);
    }
    
    public function getTuningByVehicle(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'vehicle_id' => 'required', // Ensure vehicle_id exists in the vehicles table
            ]);
    
            // Fetch the vehicle_id from the request
            $carId = $request->query('vehicle_id');
    
            // Get the tunings for the specific vehicle_id
            $tunings = VehicleTuning::where('vehicle_id', $carId)->get();
    
            // Check if there are tunings found for the vehicle_id
            if ($tunings->isEmpty()) {
                return response()->json([
                    'message' => 'No tunings found for this vehicle.',
                ], 404);
            }
    
            // Return tunings in the response
            return response()->json($tunings, 200);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation error response
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json([
                'error' => 'An unexpected error occurred',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function getVehicleAndTuningDetails(Request $request)
    {
        // Validate the input parameters to ensure both vehicle_id and tuning_id are present
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id', // Ensure vehicle_id exists in the vehicles table
            'tuning_id' => 'required', // Ensure tuning_id exists in the vehicle_tunings table
        ]);

        // Retrieve vehicle details by vehicle_id
        $vehicle = Vehicle::find($request->vehicle_id);

        // Retrieve vehicle tuning details by tuning_id
        $tuning = VehicleTuning::find($request->tuning_id);

        // Check if both vehicle and tuning exist
        if (!$vehicle || !$tuning) {
            return response()->json([
                'error' => 'Vehicle or Tuning not found.',
            ], 404);
        }

        // Return the vehicle full_name and tuning stage as response
        return response()->json([
                'full_name' => $vehicle->full_name, // Send full_name of the vehicle
                'stage' => $tuning->tuning_stage, // Send stage of the tuning
        ]);
    }
    
}
