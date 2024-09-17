<?php

namespace App\Http\Controllers\API;

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
        $fuelTypes = FuelType::all();
        return response()->json([
            'success' => true,
            'data' => $fuelTypes
        ],200);
    }
}


