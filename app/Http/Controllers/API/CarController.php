<?php

namespace App\Http\Controllers\API;

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
        $cars = Car::all();
        return response()->json([
            'success' => true,
            'data' => $cars
        ],200);
    }
}

