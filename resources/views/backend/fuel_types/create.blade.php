@extends('layouts.app')

@section('content')
    <div class="container text-right" style="direction: rtl;">
        <h1 class="mb-4">{{ __('messages.add_new_fuel_type') }}</h1>

        <form action="{{ route('fuel_types.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-form.input
                        type="text"
                        id="name"
                        name="name"
                        :value="old('name')"
                        label="{{ __('messages.name') }}"
                        required="true"
                        class="form-control-sm"
                    />
                </div>
                <div class="col-md-6">
                    <x-form.select
                        id="status"
                        name="status"
                        label="{{ __('messages.status') }}"
                        :options="\App\Models\FuelType::statusOptions()"
                        :selected="old('status')"
                        required="true"
                        class="form-control-sm"
                    />
                </div>
            </div>
            <x-button.button type="submit" style="success">
                {{ __('messages.save') }}
            </x-button.button>
        </form>
    </div>
@endsection
