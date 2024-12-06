<?php

namespace App\Http\Controllers;

use App\Models\tuning;
use Illuminate\Http\Request;

class TuningController extends Controller
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
            'tuning_name' => 'required|string|max:255',
        ]);

        tuning::create(['tuning_name' => $validated['tuning_name']]);

        return response()->json(['message' => 'Tuning Added'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(tuning $tuning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tuning $tuning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tuning $tuning)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tuning $tuning)
    {
        //
    }
}
