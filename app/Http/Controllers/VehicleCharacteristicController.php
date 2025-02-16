<?php

namespace App\Http\Controllers;

use App\Models\VehicleCharacteristic;
use App\Models\Characteristic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class VehicleCharacteristicController extends Controller
{


    public function index()
    {
        $characteristics = Characteristic::all();
        
        return response()->json($characteristics);
    }


    public function NewCharacteristic(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'max:255',  // Expect the image name as a string
            'code' => 'required|string|max:255',
        ]);
    
        // Create a new characteristic record with 'name', 'code', and 'image'
        $characteristic = Characteristic::create([
            'name' => $request->name,
            'code' => $request->code,
            'image' => $request->image, // Save the image name
        ]);
    
        return response()->json($characteristic, 201); // Return the created characteristic
    }

    public function getCharacteristics(Request $request)
    {
        // Get vehicle_id from the request
        $vehicle_id = $request->input('vehicle_id');

        // Get vehicle_tuning_ids from the request (assumed to be passed as an array)
        $vehicle_tuning_ids = $request->input('vehicle_tuning_ids');

        // Validate vehicle_id
        if (empty($vehicle_id)) {
            return response()->json(['error' => 'vehicle_id is required.'], 400);
        }

        // Validate vehicle_tuning_ids
        if (!is_array($vehicle_tuning_ids) || count($vehicle_tuning_ids) == 0) {
            return response()->json(['error' => 'vehicle_tuning_ids must be an array and cannot be empty.'], 400);
        }

        $response = [];

        // Loop through each vehicle_tuning_id
        foreach ($vehicle_tuning_ids as $vehicle_tuning_id) {
            // Fetch characteristics for the current vehicle_tuning_id
            $vehicleCharacteristics = VehicleCharacteristic::where('vehicle_id', $vehicle_id)
                ->where('vehicle_tuning_id', $vehicle_tuning_id)
                ->get();

            // Initialize a structure to hold characteristic details
            $characteristicsDetails = [];

            // Loop through each characteristic to fetch additional details
            foreach ($vehicleCharacteristics as $characteristic) {
                // Get the additional option details
                // Use first() instead of get() to get a single characteristic
                $additionalDetail = Characteristic::find($characteristic->characteristic_id);
                
                // Check if the additionalDetail is found
                if ($additionalDetail) {
                    $characteristicsDetails[] = $additionalDetail; // Add the characteristic details to the array
                }
            }

            // Store the response for the current vehicle_tuning_id
            $response[] = [
                'vehicle_tuning_id' => $vehicle_tuning_id,
                'characteristics' => $characteristicsDetails // Use characteristicsDetails instead of additionalDetail
            ];
        }

        return response()->json($response);
    }


    public function CharacteristicByTuningAndCarID(Request $request)
    {
        $vehicle_id = $request->input('vehicle_id');
        $tuning_id = $request->input('tuning_id');
    
        if (!$vehicle_id || !$tuning_id) {
            return response()->json(['error' => 'Vehicle ID and Tuning ID are required.'], 400);
        }
    
        try {
            $vehicleCharacteristics = VehicleCharacteristic::where('vehicle_tuning_id', $tuning_id)
                ->where('vehicle_id', $vehicle_id)
                ->get();
    
            if ($vehicleCharacteristics->isEmpty()) {
                return response()->json(['error' => 'No characteristics found for the given vehicle and tuning.'], 404);
            }
    
            $characteristicIds = $vehicleCharacteristics->pluck('characteristic_id');
            $characteristicsDetails = Characteristic::whereIn('id', $characteristicIds)->get();
    
            return response()->json($characteristicsDetails, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    
    public function store(Request $request)
    {
        // Get data from the body
        $vehicle_id = $request->input('vehicle_id');
        $tuning_id = $request->input('tuning_id');
        $characteristic_id = $request->input('characteristic_id');
    
        // Validate inputs
        if (!$vehicle_id || !$tuning_id || !$characteristic_id) {
            return response()->json(['error' => 'Vehicle ID, Tuning ID, and Characteristic ID are required.'], 400);
        }
    
        // Check if the characteristic is already added
        $exists = VehicleCharacteristic::where('vehicle_id', $vehicle_id)
            ->where('vehicle_tuning_id', $tuning_id)
            ->where('characteristic_id', $characteristic_id)
            ->exists();
    
        if ($exists) {
            return response()->json(['error' => 'This characteristic is already added to the vehicle.'], 400);
        }
    
        // Create a new characteristic entry
        $vehicleCharacteristic = VehicleCharacteristic::create([
            'vehicle_id' => $vehicle_id,
            'vehicle_tuning_id' => $tuning_id,
            'characteristic_id' => $characteristic_id,
        ]);
    
        // Return the added characteristic details
        return response()->json($vehicleCharacteristic, 201);
    }
    public function removeCharacteristic(Request $request)
    {
        // Get the required parameters from the request
        $vehicle_id = $request->input('vehicle_id');
        $tuning_id = $request->input('tuning_id');
        $characteristic_id = $request->input('characteristic_id');
    
        // Validate inputs
        if (!$vehicle_id || !$tuning_id || !$characteristic_id) {
            return response()->json(['error' => 'Vehicle ID, Tuning ID, and Characteristic ID are required.'], 400);
        }
    
        // Find the record to delete
        $vehicleCharacteristic = VehicleCharacteristic::where('vehicle_id', $vehicle_id)
            ->where('vehicle_tuning_id', $tuning_id)
            ->where('characteristic_id', $characteristic_id)
            ->first();
    
        // Check if the characteristic exists
        if (!$vehicleCharacteristic) {
            return response()->json(['error' => 'Characteristic not found for this vehicle and tuning.'], 404);
        }
    
        // Delete the record
        $vehicleCharacteristic->delete();
    
        // Return success response
        return response()->json(['message' => 'Characteristic removed successfully.'], 200);
    }
        
        public function updateImages(Request $request)
        {
            // Validate the request
            $request->validate([
                '*.name' => 'required|string|exists:characteristics,name',
               '*.image' => 'nullable|string'
            ]);
    
            $updatedCharacteristics = [];
    
            foreach ($request->all() as $item) {
                $characteristic = Characteristic::where('name', $item['name'])->first();
    
                if ($characteristic) {
                    $characteristic->image = $item['image'];
                    $characteristic->save();
                    $updatedCharacteristics[] = $characteristic;
                }
            }
    
            return response()->json(['message' => 'Images updated successfully', 'characteristics' => $updatedCharacteristics], 200);
        }
    




}
