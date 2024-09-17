@extends('layouts.app')

@section('content')
    <div class="container text-right text-dark" style="direction: rtl;">
        <h1 class="mb-4">{{ __('messages.create_new_price') }}</h1>

        <form action="{{ route('carwash_prices.store') }}" method="POST">
            @csrf

            <label for="service_id">{{ __('messages.service') }}</label>
            <select id="service_id" name="service_id[]" class="form-control js-example-basic-multiple" multiple="multiple" required>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>


            <label for="car_id" class="mt-3">{{ __('messages.car') }}</label>
            <select id="car_id" name="car_id[]" class="form-control js-example-basic-multiple" multiple="multiple" required>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->model }}</option>
                @endforeach
            </select>


            <label for="amount" class="mt-3">{{ __('messages.amount') }}</label>
            <input type="text" id="amount" name="amount" class="form-control" value="{{ old('amount') }}" required>


            <button type="submit" class="btn btn-primary mt-4">
                {{ __('messages.save') }}
            </button>
        </form>
    </div>

    @push('js')
        <script>
            $(document).ready(function() {

                $('.js-example-basic-multiple').select2();


                function addCommas(value) {
                    value = value.replace(/[^0-9.]/g, '');
                    const [integerPart, decimalPart] = value.split('.');
                    const formattedIntegerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    return decimalPart ? `${formattedIntegerPart}.${decimalPart}` : formattedIntegerPart;
                }


                const amountInput = document.getElementById('amount');
                amountInput.addEventListener('input', function (e) {
                    let value = e.target.value;
                    e.target.value = addCommas(value);
                });
            });
        </script>
    @endpush
@endsection
