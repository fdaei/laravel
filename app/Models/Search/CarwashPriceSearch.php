<?php
namespace App\Models\Search;

use App\Models\CarwashPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarwashPriceSearch
{
    public static function apply(Request $request)
    {

        $query = CarwashPrice::with('service', 'car');

        // Handle car_id as an integer
        if ($request->filled('car_id')) {
            $query->where('car_id', $request->input('car_id'));
        }

        // Handle service_id as an integer
        if ($request->filled('service_id')) {
            $query->where('service_id', $request->input('service_id'));
        }

        // Remove commas and handle min_price
        if ($request->filled('min_price')) {
            $minPrice = str_replace(',', '', $request->input('min_price'));
            $query->where('amount', '>=', $minPrice);
        }

        // Remove commas and handle max_price
        if ($request->filled('max_price')) {
            $maxPrice = str_replace(',', '', $request->input('max_price'));
            $query->where('amount', '<=', $maxPrice);
        }

        return $query->paginate(10);
    }
}

