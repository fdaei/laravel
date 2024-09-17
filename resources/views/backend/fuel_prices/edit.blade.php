@extends('layouts.app')

@section('content')
    <div class="container text-right" style="direction: rtl;">
        <h1 class="mb-4">{{ __('messages.edit_fuel_price') }}</h1>

        <form action="{{ route('fuel_prices.update', $fuelPrice->id) }}" method="POST">
            @csrf
            @method('PUT')

            <x-form.select
                id="fuel_type_id"
                name="fuel_type_id"
                label="{{ __('messages.fuel_type') }}"
                :options="$fuelTypes->pluck('name', 'id')"
                :selected="old('fuel_type_id', $fuelPrice->fuel_type_id)"
                required="true"
            />

            <x-form.input
                type="text"
                id="price_per_unit"
                name="price_per_unit"
                :value="old('price_per_unit', number_format($fuelPrice->price_per_unit))"
                label="{{ __('messages.price_per_unit') }}"
                step="0.01"
                required="true"
            />

            <x-form.input
                type="text"
                id="main_price"
                name="main_price"
                :value="old('main_price', number_format($fuelPrice->main_price))"
                label="{{ __('messages.main_price') }}"
                required="true"
                readonly="true"
            />

            <x-form.input
                type="text"
                id="quantity"
                name="quantity"
                :value="old('quantity', number_format($fuelPrice->quantity))"
                label="{{ __('messages.quantity') }}"
                step="0.01"
                required="true"
            />

            <div class="form-group">
                <label for="status">{{ __('messages.status') }}</label>
                <select id="status" name="status" class="form-control form-control-sm">
                    <option value="" disabled>{{ __('messages.select_status') }}</option>
                    @foreach (\App\Models\FuelPrice::statusOptions() as $key => $value)
                        <option value="{{ $key }}" {{ old('status', $fuelPrice->status) == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-button.button type="submit" style="success">
                {{ __('messages.update') }}
            </x-button.button>
        </form>
    </div>
    <script>
        // Function to add commas for thousands separators
        function addCommas(value) {
            console.log('addCommas called with value:', value);
            value = value.replace(/[^0-9.]/g, '');
            const parts = value.split('.');
            const integerPart = parts[0];
            const decimalPart = parts.length > 1 ? '.' + parts[1] : '';
            const formattedIntegerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return formattedIntegerPart + decimalPart;
        }

        // Function to calculate the main price
        function calculateMainPrice() {
            const pricePerUnit = parseFloat(document.getElementById('price_per_unit').value.replace(/,/g, '')) || 0;
            const quantity = parseFloat(document.getElementById('quantity').value.replace(/,/g, '')) || 0;
            const mainPrice = pricePerUnit * quantity;
            document.getElementById('main_price').value = addCommas(mainPrice.toFixed(2));
        }

        // Ensure the DOM is fully loaded before adding event listeners
        window.addEventListener('DOMContentLoaded', function() {
            const pricePerUnitInput = document.getElementById('price_per_unit');
            const quantityInput = document.getElementById('quantity');

            pricePerUnitInput.addEventListener('input', function(e) {
                let value = e.target.value;
                e.target.value = addCommas(value);
                calculateMainPrice();
            });

            quantityInput.addEventListener('input', function(e) {
                let value = e.target.value;
                e.target.value = addCommas(value);
                calculateMainPrice();
            });

            // Initial calculation in case there are pre-filled values
            calculateMainPrice();
        });
    </script>
@endsection


