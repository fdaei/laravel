<?php

namespace App\Http\Controllers\API;

use App\Models\FuelPrice;
use App\Models\FuelType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class FuelPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'min_price' => 'nullable|numeric',
            'max_price' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Check if min_price > max_price
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $minPrice = str_replace(',', '', $request->input('min_price'));
            $maxPrice = str_replace(',', '', $request->input('max_price'));

            if ($minPrice > $maxPrice) {
                return response()->json([
                    'success' => false,
                    'errors' => ['min_price' => __('messages.min_price_greater_than_max')],
                ], 400);
            }
        }


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


        return response()->json([
            'success' => true,
            'fuelPrices' => $fuelPrices,
        ], 200);
    }
}
