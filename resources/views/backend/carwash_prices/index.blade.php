@extends('layouts.app')

@section('content')
    <div class="container text-right" style="direction: rtl;">
        <h1>{{ __('messages.carwash_prices') }}</h1>
        <a href="{{ route('carwash_prices.create') }}"
           class="btn btn-primary mb-3">{{ __('messages.create_new_price') }}</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="GET" action="{{ route('carwash_prices.index') }}" class="mb-3">
            <div class="form-row">
                <div class="col-md-3">
                    <select name="car_id" class="form-control js-example-basic-single">
                        <option value="">{{ __('messages.select_car') }}</option>
                        @foreach($cars as $car)
                            <option value="{{ $car->id }}" {{ request('car_id') == $car->id ? 'selected' : '' }}>
                                {{ $car->model }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="service_id" class="form-control js-example-basic-single">
                        <option value="">{{ __('messages.select_service') }}</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
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


        <!-- Table -->
        <x-table>
            <x-slot name="header">
                <tr>
                    <th>#</th>
                    <th>{{ __('messages.service') }}</th>
                    <th>{{ __('messages.car') }}</th>
                    <th>{{ __('messages.amount') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @foreach($prices as $index => $price)
                    <tr>
                        <td>{{ (int)$index + 1 }}</td>
                        <td>{{ $price->service->name }}</td>
                        <td>{{ $price->car?->model }}</td>
                        <td>{{ number_format($price->amount) }}</td>
                        <td>
                            <a href="{{ route('carwash_prices.edit', $price->id) }}"
                               class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('carwash_prices.destroy', $price->id) }}" method="POST"
                                  style="display:inline-block;">
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
            {{ $prices->appends(request()->input())->links('pagination::bootstrap-4') }}
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
