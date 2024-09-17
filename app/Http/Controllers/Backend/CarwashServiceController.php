<?php

namespace App\Http\Controllers\Backend;

use App\Models\CarwashService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CarwashServiceController extends Controller
{
    public function index()
    {
        $services = CarwashService::paginate(10);
        return view('backend.carwash_services.index', compact('services'));
    }

    public function create()
    {
        return view('backend.carwash_services.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|integer',
        ]);

        CarwashService::create($validatedData);


        return redirect()->route('carwash_service.index')->with('success', __('messages.service_created'));
    }

    public function show($id)
    {
        $service = CarwashService::find($id);

        if (!$service) {
            return redirect()->route('carwash_service.index')->with('error', __('messages.service_not_found'));
        }

        return view('backend.carwash_services.show', compact('service'));
    }

    public function edit($id)
    {
        $service = CarwashService::find($id);

        if (!$service) {
            return redirect()->route('carwash_service.index')->with('error', __('messages.service_not_found'));
        }

        return view('backend.carwash_services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = CarwashService::find($id);

        if (!$service) {
            return redirect()->route('carwash_service.index')->with('error', __('messages.service_not_found'));
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|integer',
        ]);

        $service->update($validatedData);

        return redirect()->route('carwash_service.index')->with('success', __('messages.service_updated'));
    }

    public function destroy($id)
    {
        $service = CarwashService::find($id);

        if (!$service) {
            return redirect()->route('carwash_service.index')->with('error', __('messages.service.error.not_found'));
        }

        $service->delete();

        return redirect()->route('carwash_service.index')->with('success', __('messages.service_deleted'));
    }
}


