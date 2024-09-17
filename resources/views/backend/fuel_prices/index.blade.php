@extends('layouts.app')

@section('content')
    <div class="container text-right" style="direction: rtl;">
        <h1 class="mb-4">{{ __('messages.fuel_prices') }}</h1>
        <a href="{{ route('fuel_prices.create') }}" class="btn btn-primary mb-3">{{ __('messages.add_new_fuel_price') }}</a>

        @if(session('success'))
            <x-alert type="success" :message="session('success')"/>
        @endif

        @if(session('error'))
            <x-alert type="danger" :message="session('error')"/>
        @endif


        <form method="GET" action="{{ route('fuel_prices.index') }}" class="mb-3">
            <div class="form-row">

                <div class="col-md-3">
                    <select name="fuel_type_id" class="form-control js-example-basic-single">
                        <option value="">{{ __('messages.select_fuel_type') }}</option>
                        @foreach($fuelTypes as $fuelType)
                            <option value="{{ $fuelType->id }}" {{ request('fuel_type_id') == $fuelType->id ? 'selected' : '' }}>
                                {{ $fuelType->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- فیلتر قیمت‌ها -->
                <div class="col-md-2">
                    <input type="text" name="min_price" id="min_price" class="form-control @error('min_price') is-invalid @enderror"
                           placeholder="{{ __('messages.min_price') }}" value="{{ request('min_price') }}">
                    @error('min_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <input type="text" name="max_price" id="max_price" class="form-control @error('max_price') is-invalid @enderror"
                           placeholder="{{ __('messages.max_price') }}" value="{{ request('max_price') }}">
                    @error('max_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">{{ __('messages.search') }}</button>
                </div>
            </div>
        </form>

        <!-- جدول نمایش قیمت‌های سوخت -->
        <x-table>
            <x-slot name="header">
                <tr>
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.fuel_type') }}</th>
                    <th>{{ __('messages.price_per_unit') }}</th>
                    <th>{{ __('messages.main_price') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @foreach($fuelPrices as $fuelPrice)
                    <tr>
                        <td>{{ $fuelPrice->id }}</td>
                        <td>{{ $fuelPrice->fuelType->name }}</td>
                        <td>{{ number_format($fuelPrice->price_per_unit)}}</td>
                        <td>{{ number_format($fuelPrice->main_price)}}</td>
                        <td>{{ $fuelPrice->quantity }}</td>
                        <td>{!! $fuelPrice->status !!}</td>
                        <td>
                            <a href="{{ route('fuel_prices.edit', $fuelPrice->id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('fuel_prices.destroy', $fuelPrice->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('{{ __('messages.confirm_delete') }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>

        <div class="d-flex justify-content-center">
            {{ $fuelPrices->appends(request()->input())->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {

            function addCommas(value) {
                value = value.replace(/[^0-9.]/g, '');
                const [integerPart, decimalPart] = value.split('.');
                const formattedIntegerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                return decimalPart ? `${formattedIntegerPart}.${decimalPart}` : formattedIntegerPart;
            }

            const minPriceInput = document.getElementById('min_price');
            const maxPriceInput = document.getElementById('max_price');

            minPriceInput.addEventListener('input', function (e) {
                e.target.value = addCommas(e.target.value);
            });

            maxPriceInput.addEventListener('input', function (e) {
                e.target.value = addCommas(e.target.value);
            });
        });
    </script>
@endpush
