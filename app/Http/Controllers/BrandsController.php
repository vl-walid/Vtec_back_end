<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\brands;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BrandsController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        return view("brands.index");
    }

    public function getBrands() {

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
            "brand_name" => "required|string|max:255"
        ]);

        brands::create([
            "brand_name" => $validated["brand_name"]
        ]);

        return response()->json(['message' => 'Brand created successfully!'], 201);
    }


        //
    /**
     * Display the specified resource.
     */
    public function show(brands $brands)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(brands $brands)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, brands $brands)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(brands $brands)
    {
        //
    }
}
