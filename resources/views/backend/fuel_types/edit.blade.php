@extends('layouts.app')

@section('content')
    <div class="container text-right" style="direction: rtl;">
        <h1 class="mb-4">{{ __('messages.edit_fuel_type') }}</h1>

        <form action="{{ route('fuel_types.update', $fuelType->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <x-form.input
                        type="text"
                        id="name"
                        name="name"
                        :value="old('name', $fuelType->name)"
                        label="{{ __('messages.name') }}"
                        required="true"
                        class="form-control-sm"
                    />
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">{{ __('messages.status') }}</label>
                        <select id="status" name="status" class="form-control form-control-sm">
                            <option value="" disabled>{{ __('messages.select_status') }}</option>
                            @foreach (\App\Models\FuelType::statusOptions() as $key => $value)
                                <option value="{{ $key }}" {{ old('status', $fuelType->status) == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <x-button.button type="submit" style="success">
                {{ __('messages.update') }}
            </x-button.button>
        </form>
    </div>
@endsection
