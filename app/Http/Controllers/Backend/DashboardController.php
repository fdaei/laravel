<?php
namespace App\Http\Controllers\Backend;
use App\Models\Car;
use App\Models\CarwashService;
use App\Models\FuelType;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $numberOfCars = Car::where('status', Car::STATUS_ACTIVE)->count();
        $numberOfServices = CarwashService::where('status', CarwashService::STATUS_ACTIVE)->count();
        $numberOfFuel = FuelType::where('status', FuelType::STATUS_ACTIVE)->count();

        return view('backend.dashboard', compact('numberOfCars', 'numberOfServices', 'numberOfFuel'));
    }
}
