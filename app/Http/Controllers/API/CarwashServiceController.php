<?php

namespace App\Http\Controllers\API;

use App\Models\CarwashService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CarwashServiceController extends Controller
{
    public function index()
    {
        $services = CarwashService::where(['status' => CarwashService::STATUS_ACTIVE])->select('name', 'description')->get();
        return response()->json([
            'success' => true,
            'data' => $services
        ], 200);
    }

}


