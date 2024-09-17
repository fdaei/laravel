<?php

namespace App\Http\Controllers\Backend;

use App\Models\FuelType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FuelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fuelTypes = FuelType::paginate(10);
        return view('backend.fuel_types.index', compact('fuelTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.fuel_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|integer',
        ]);

        FuelType::create($validatedData);

        return redirect()->route('fuel_types.index')->with('success', __('messages.fuel_type_created_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fuelType = FuelType::findOrFail($id);
        return view('backend.fuel_types.edit', compact('fuelType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $service = FuelType::find($id);

        if (!$service) {
            return redirect()->route('fuel_types.index')->with('error', __('messages.fuel_type_not_found'));
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|integer',
        ]);

        $service->update($validatedData);

        return redirect()->route('fuel_types.index')->with('success', __('messages.fuel_type_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fuelType = FuelType::findOrFail($id);
        $fuelType->delete();

        return redirect()->route('fuel_types.index')->with('success', __('messages.fuel_type_deleted_successfully'));
    }
}





