@extends('layouts.app')

@section('title', __('messages.dashboard'))

@section('content')
    <div class="container" dir="rtl">
        <div class="row">
            <div class="col-md-4 mt-5">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header text-right">{{ __('messages.cars') }}</div>
                    <div class="card-body">
                        <h5 class="card-text text-right">{{ __('messages.total_cars') }}</h5>
                        <p class="card-title text-right">{{ __('messages.car_count', ['count' => $numberOfCars]) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-5">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header text-right">{{ __('messages.services') }}</div>
                    <div class="card-body">
                        <h5 class="card-text text-right">{{ __('messages.total_services') }}</h5>
                        <p class="card-title text-right">{{ __('messages.service_count', ['count' => $numberOfServices]) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-5">
                <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header text-right">{{ __('messages.fuel') }}</div>
                    <div class="card-body">
                        <h5 class="card-text text-right">{{ __('messages.total_fuel') }}</h5>
                        <p class="card-title text-right">{{ __('messages.fuel_count', ['count' => $numberOfFuel]) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
