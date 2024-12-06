<?php

namespace App\Http\Controllers;

use App\Models\vehicle_data_chart;
use Illuminate\Http\Request;

class VehicleDataChartController extends Controller
{
    //
    public function index() {
        $vehicles_data = vehicle_data_chart::all();

        return response()->json($vehicles_data);

    }

}
