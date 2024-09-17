@extends('layouts.app')

@section('content')
    <div class="container text-right" dir="rtl">
        <h1>{{ __('messages.add_new_car') }}</h1>

        <form action="{{ route('cars.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <x-form.input
                        type="text"
                        id="make"
                        name="make"
                        :value="old('make')"
                        label="{{ __('messages.make') }}"
                        required="true"
                        class="form-control-sm"
                    />
                </div>

                <div class="col-md-6">
                    <x-form.input
                        type="text"
                        id="model"
                        name="model"
                        :value="old('model')"
                        label="{{ __('messages.model') }}"
                        required="true"
                        class="form-control-sm"
                    />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <x-form.input
                        type="text"
                        id="color"
                        name="color"
                        :value="old('color')"
                        label="{{ __('messages.color') }}"
                        required="false"
                        class="form-control-sm"
                    />
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="type">{{ __('messages.type') }}</label>
                        <select id="type" name="type" class="form-control form-control-sm">
                            <option value="" disabled selected>{{ __('messages.select_type') }}</option>
                            @foreach (\App\Models\Car::typeOptions() as $key => $value)
                                <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">{{ __('messages.status') }}</label>
                        <select id="status" name="status" class="form-control form-control-sm">
                            <option value="" disabled selected>{{ __('messages.select_status') }}</option>
                            @foreach (\App\Models\Car::statusOptions() as $key => $value)
                                <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="series">{{ __('messages.series') }}</label>
                        <select id="series" name="series" class="form-control form-control-sm">
                            <option value="" disabled selected>{{ __('messages.select_series') }}</option>
                            @foreach (\App\Models\Car::seriesOptions() as $key => $value)
                                <option value="{{ $key }}" {{ old('series') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <x-button.button type="submit" style="primary">
                {{ __('messages.save') }}
            </x-button.button>
        </form>
    </div>
@endsection
