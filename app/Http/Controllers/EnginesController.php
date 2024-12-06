<?php

namespace App\Http\Controllers;

use App\Models\engines;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EnginesController extends Controller
{
    //

    public function index () {

        $engines = engines::all();

        return response()->json($engines);

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'engine_name' => 'required|string|max:255',
        ]);

        engines::create(['engine_name' => $validated['engine_name']]);

        return response()->json(['message' => 'Engine Added'], 201);
    }
    public function search(Request $request) {

        $data = $request->header("engine_name");

        $res = engines::where("engine_name", $data)->first();

        return response()->json($res);

    }

}
