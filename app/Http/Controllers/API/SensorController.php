<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SensorDatas;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function storeSensorData(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'cycle_id' => 'required',
                'ph_level' => 'required',
                'dissolved_oxygen' => 'required',
                'alkalinity_level' => 'required',
                'water_temperature' => 'required',
                'reading_date' => 'required|date',
            ]);
    
            // Create reading
            $reading = SensorDatas::create($validatedData);
    
            // Return success response
            return response()->json([
                'message' => 'Reading created successfully',
                'data' => $reading
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
