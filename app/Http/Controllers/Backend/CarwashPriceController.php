<?php

namespace App\Http\Controllers\Backend;

use App\Models\CarwashPrice;
use App\Models\CarwashService;
use App\Models\Car;
use App\Models\Search\CarwashPriceSearch;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CarwashPriceController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'min_price' => 'nullable|numeric',
            'max_price' => 'nullable|numeric',
        ]);

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $minPrice = str_replace(',', '', $request->input('min_price'));
            $maxPrice = str_replace(',', '', $request->input('max_price'));

            if ($minPrice > $maxPrice) {
                return redirect()->route('carwash_prices.index')
                    ->withErrors(['min_price' => __('messages.min_price_greater_than_max')])
                    ->withInput();
            }
        }

        $cars = Car::all();
        $services = CarwashService::all();
        $prices = CarwashPriceSearch::apply($request);

        return view('backend.carwash_prices.index', compact('prices', 'cars', 'services'));
    }



    public function create()
    {
        $services = CarwashService::all();
        $cars = Car::all();
        return view('backend.carwash_prices.create', compact('services', 'cars'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'service_id' => 'required|array',
            'service_id.*' => 'exists:carwash_services,id',
            'car_id' => 'required|array',
            'car_id.*' => 'exists:cars,id',
            'amount' => 'required|string',
        ]);

        $amount = str_replace(',', '', $validatedData['amount']);

        DB::beginTransaction();
        $success = true;

        try {
            foreach ($validatedData['service_id'] as $serviceId) {
                foreach ($validatedData['car_id'] as $carId) {
                    $created = CarwashPrice::create([
                        'service_id' => $serviceId,
                        'car_id' => $carId,
                        'amount' => $amount,
                    ]);

                    if (!$created) {
                        $success = false;
                        break;
                    }
                }
            }


            if ($success) {
                DB::commit();
                return redirect()->route('carwash_prices.index')->with('success', __('messages.price_created'));
            } else {
                DB::rollBack();
                return redirect()->route('carwash_prices.create')->with('error', __('messages.error_occurred'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('carwash_prices.create')->with('error', __('messages.error_occurred'));
        }
    }

    public function edit($id)
    {
        try {
            $price = CarwashPrice::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('carwash_prices.index')->with('error', __('messages.price_not_found'));
        }

        $services = CarwashService::all();
        $cars = Car::all();

        return view('backend.carwash_prices.edit', compact('price', 'services', 'cars'));
    }

    public function update(Request $request, $id)
    {
        try {
            $price = CarwashPrice::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('carwash_prices.index')->with('error', __('messages.price_not_found'));
        }

        $validatedData = $request->validate([
            'service_id' => 'required|exists:carwash_services,id',
            'car_id' => 'required|exists:cars,id',
            'amount' => 'required|string',
        ]);

        $amount = str_replace(',', '', $validatedData['amount']);

        $price->update([
            'service_id' => $validatedData['service_id'],
            'car_id' => $validatedData['car_id'],
            'amount' => $amount,
        ]);

        return redirect()->route('carwash_prices.index')->with('success', __('messages.price_updated'));
    }

    public function destroy($id)
    {
        try {
            $price = CarwashPrice::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('carwash_prices.index')->with('error', __('messages.price_not_found'));
        }

        $price->delete();

        return redirect()->route('carwash_prices.index')->with('success', __('messages.price_deleted'));
    }
}
