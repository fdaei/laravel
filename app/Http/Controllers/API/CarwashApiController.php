<?php

namespace App\Http\Controllers\API;

use App\Models\CarwashPrice;
use App\Models\Search\CarwashPriceSearch;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class CarwashApiController extends Controller
{
    /**
     * Display a listing of all carwash prices with related car and service information.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $prices = CarwashPriceSearch::apply($request);
        return response()->json([
            'success' => true,
            'data' => $prices
        ]);
    }

}
