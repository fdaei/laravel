@extends('layouts.app')

@section('content')
    <div class="container text-right" style="direction: rtl;">
        <h1 class="mb-4">{{ __('messages.edit_price') }}</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('carwash_prices.update', $price->id) }}" method="POST">
            @csrf
            @method('PUT')

            <x-form.select
                id="service_id"
                name="service_id"
                :options="$services->pluck('name', 'id')->toArray()"
                label="{{ __('messages.service') }}"
                :selected="$price->service_id"
                required="true"
            />

            <x-form.select
                id="car_id"
                name="car_id"
                :options="$cars->pluck('model', 'id')->toArray()"
                label="{{ __('messages.car') }}"
                :selected="$price->car_id"
                required="true"
            />

            <x-form.input
                type="text"
                id="amount"
                name="amount"
                :value="number_format($price->amount, 0, '.', ',')"
                label="{{ __('messages.amount') }}"
                required="true"
            />


            <x-button.button type="submit" style="primary">
                {{ __('messages.update') }}
            </x-button.button>
        </form>
    </div>

    <script>
        const amountInput = document.getElementById('amount');

        amountInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/,/g, '');
            if (!isNaN(value) && value !== '') {
                e.target.value = parseFloat(value).toLocaleString('en-IN');
            }
        });
    </script>
@endsection
