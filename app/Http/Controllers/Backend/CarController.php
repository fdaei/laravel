<?php

namespace App\Http\Controllers\Backend;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::paginate(10);
        return view('backend.cars.index', compact('cars'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'color' => 'nullable|string|max:255',
            'type' => 'nullable|integer',
            'status' => 'nullable|integer',
            'series'=>'nullable|integer'
        ]);

        Car::create($validatedData);

        return redirect()->route('cars.index')->with('success', __('messages.car_created_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = Car::findOrFail($id);
        return view('backend.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $car = Car::findOrFail($id);

        $validatedData = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'color' => 'nullable|string|max:255',
            'type' => 'nullable|integer',
            'status' => 'nullable|integer',
            'series'=>'nullable|integer'
        ]);

        $car->update($validatedData);

        return redirect()->route('cars.index')->with('success', __('messages.car_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('cars.index')->with('success', __('messages.car_deleted_successfully'));
    }
}

