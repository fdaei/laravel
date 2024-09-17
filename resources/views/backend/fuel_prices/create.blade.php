@extends('layouts.app')

@section('content')
    <div class="container text-right" style="direction: rtl;">
        <h1 class="mb-4">{{ __('messages.add_new_fuel_price') }}</h1>

        <form action="{{ route('fuel_prices.store') }}" method="POST">
            @csrf

            <x-form.select
                id="fuel_type_id"
                name="fuel_type_id"
                label="{{ __('messages.fuel_type') }}"
                :options="$fuelTypes->pluck('name', 'id')"
                :selected="old('fuel_type_id')"
                required="true"
            />

            <x-form.input
                type="text"
                id="price_per_unit"
                name="price_per_unit"
                :value="old('price_per_unit')"
                label="{{ __('messages.price_per_unit') }}"
                step="0.01"
                required="true"
            />

            <x-form.input
                type="text"
                id="main_price"
                name="main_price"
                :value="old('main_price')"
                label="Main Price"
                required="true"
                readonly="true"
            />

            <x-form.input
                type="text"
                id="quantity"
                name="quantity"
                :value="old('quantity')"
                label="{{ __('messages.quantity') }}"
                step="0.01"
                required="true"
            />

            <div class="form-group">
                <label for="status">{{ __('messages.status') }}</label>
                <select id="status" name="status" class="form-control form-control-sm">
                    <option value="" disabled selected>{{ __('messages.select_status') }}</option>
                    @foreach (\App\Models\FuelType::statusOptions() as $key => $value)
                        <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-button.button type="submit" style="success">
                {{ __('messages.save') }}
            </x-button.button>
        </form>
    </div>
    <script>

        function addCommas(value) {
            console.log('addCommas called with value:', value);

            value = value.replace(/[^0-9.]/g, '');


            const parts = value.split('.');
            const integerPart = parts[0];
            const decimalPart = parts.length > 1 ? '.' + parts[1] : '';


            const formattedIntegerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            console.log('Formatted integer part:', formattedIntegerPart);

            return formattedIntegerPart + decimalPart;
        }


        function calculateMainPrice() {
            console.log('calculateMainPrice called');
            const pricePerUnit = parseFloat(document.getElementById('price_per_unit').value.replace(/,/g, '')) || 0;
            const quantity = parseFloat(document.getElementById('quantity').value) || 0; // No need to replace commas for quantity
            const mainPrice = pricePerUnit * quantity;
            document.getElementById('main_price').value = addCommas(mainPrice.toFixed());
        }


        window.addEventListener('DOMContentLoaded', function() {
            console.log('DOM fully loaded');
            const pricePerUnitInput = document.getElementById('price_per_unit');
            const quantityInput = document.getElementById('quantity');


            quantityInput.disabled = true;

            if (pricePerUnitInput && quantityInput) {
                pricePerUnitInput.addEventListener('input', function(e) {
                    console.log('pricePerUnitInput input event triggered');
                    let value = e.target.value;
                    e.target.value = addCommas(value);


                    if (e.target.value.trim() !== '') {
                        quantityInput.disabled = false;
                    } else {
                        quantityInput.disabled = true;
                        quantityInput.value = '';
                        document.getElementById('main_price').value = '';
                    }


                    calculateMainPrice();
                });

                quantityInput.addEventListener('input', function(e) {
                    console.log('quantityInput input event triggered');
                    let value = e.target.value;
                    if (isNaN(value)) {
                        e.target.value = '';
                    }
                    calculateMainPrice();
                });


                pricePerUnitInput.addEventListener('change', function(e) {
                    console.log('pricePerUnitInput change event triggered');
                    e.target.value = addCommas(e.target.value);
                });

                console.log('Initial calculation triggered');
                calculateMainPrice();
            } else {
                console.log('pricePerUnitInput or quantityInput not found');
            }
        });
    </script>

@endsection
