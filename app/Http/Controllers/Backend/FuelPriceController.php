<?php

namespace App\Http\Controllers\Backend;

use App\Models\FuelPrice;
use App\Models\FuelType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class FuelPriceController extends Controller
{

    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'min_price' => 'nullable|numeric',
            'max_price' => 'nullable|numeric',
        ]);

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $minPrice = str_replace(',', '', $request->input('min_price'));
            $maxPrice = str_replace(',', '', $request->input('max_price'));

            if ($minPrice > $maxPrice) {
                return redirect()->route('fuel_prices.index')
                    ->withErrors(['min_price' => __('messages.min_price_greater_than_max')])
                    ->withInput();
            }
        }

        $fuelTypes = FuelType::all();
        $query = FuelPrice::with('fuelType');


        if ($request->filled('fuel_type_id')) {
            $query->where('fuel_type_id', $request->fuel_type_id);
        }


        if ($request->filled('min_price')) {
            $query->where('price_per_unit', '>=', str_replace(',', '', $request->min_price));
        }

        if ($request->filled('max_price')) {
            $query->where('price_per_unit', '<=', str_replace(',', '', $request->max_price));
        }

        $fuelPrices = $query->paginate(10);

        return view('backend.fuel_prices.index', compact('fuelPrices', 'fuelTypes'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $fuelTypes = FuelType::all();
        return view('backend.fuel_prices.create', compact('fuelTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'price_per_unit' => 'required|string',
            'main_price' => 'required|string',
            'quantity' => 'required|numeric',
            'status' => 'nullable|integer',
        ]);

        // Remove commas from the price fields before storing them
        $pricePerUnit = str_replace(',', '', $validatedData['price_per_unit']);
        $mainPrice = str_replace(',', '', $validatedData['main_price']);

        // Create a new FuelPrice record in the database
        FuelPrice::create([
            'fuel_type_id' => $validatedData['fuel_type_id'],
            'price_per_unit' => $pricePerUnit,
            'main_price' => $mainPrice,
            'quantity' => $validatedData['quantity'],
            'status' => $validatedData['status'],
        ]);

        // Redirect back to the index page with a success message
        return redirect()->route('fuel_prices.index')->with('success', __('messages.fuel_price_created_successfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FuelPrice  $fuelPrice
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(FuelPrice $fuelPrice)
    {
        return view('backend.fuel_prices.show', compact('fuelPrice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FuelPrice  $fuelPrice
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        try {
            $fuelPrice = FuelPrice::findOrFail($id);
            $fuelTypes = FuelType::all();
        } catch (ModelNotFoundException $e) {
            return redirect()->route('fuel_prices.index')->with('error', __('messages.price_not_found'));
        }

        // Pass the fuelPrice, fuelTypes, and optionally other data to the view
        return view('backend.fuel_prices.edit', compact('fuelPrice', 'fuelTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FuelPrice  $fuelPrice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $fuelPrice = FuelPrice::findOrFail($id);
        // Validate the incoming request data
        $validatedData = $request->validate([
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'price_per_unit' => 'required|string',
            'main_price' => 'required|string',
            'quantity' => 'required|string',
            'status' => 'nullable|integer',
        ]);


        $pricePerUnit = str_replace(',', '', $validatedData['price_per_unit']);
        $mainPrice = str_replace(',', '', $validatedData['main_price']);
        $quantity = str_replace(',', '', $validatedData['quantity']);

        // Update the FuelPrice record in the database
        $fuelPrice->update([
            'fuel_type_id' => $validatedData['fuel_type_id'],
            'price_per_unit' => $pricePerUnit,
            'main_price' => $mainPrice,
            'quantity' => $quantity,
            'status' => $validatedData['status'],
        ]);

        // Redirect back to the index page with a success message
        return redirect()->route('fuel_prices.index')->with('success', __('messages.fuel_price_updated_successfully'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FuelPrice  $fuelPrice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $fuelPrice = FuelPrice::findOrFail($id);
        $fuelPrice->delete();
        return redirect()->route('fuel_prices.index')->with('success', __('messages.fuel_price_deleted_successfully'));
    }
}
