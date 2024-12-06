<?php

namespace App\Http\Controllers;

use App\Models\characteristics;
use Illuminate\Http\Request;

class CharacteristicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getVehiclesCharacteristics()
    {

        $characteristics=characteristics::all();



        return response()->json( [  "characteristics"=>$characteristics])  ;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(characteristics $characteristics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(characteristics $characteristics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, characteristics $characteristics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(characteristics $characteristics)
    {
        //
    }
}
