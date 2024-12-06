<?php

namespace App\Http\Controllers;

use App\Models\ecus;
use Illuminate\Http\Request;

class EcusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ecu_name' => 'required|string|max:255',
        ]);

        ecus::create(['ecu_name' => $validated['ecu_name']]);

        return response()->json(['message' => 'ECU Added'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ecus $ecus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ecus $ecus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ecus $ecus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ecus $ecus)
    {
        //
    }
}
