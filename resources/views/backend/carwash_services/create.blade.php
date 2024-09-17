@extends('layouts.app')

@section('content')
    <div class="container text-right" style="direction: rtl;">
        <h1 class="mb-4">{{ __('messages.add_new_service') }}</h1>

        <form action="{{ route('carwash_service.store') }}" method="POST">
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
                    <div class="form-group">
                        <label for="status">{{ __('messages.status') }}</label>
                        <select id="status" name="status" class="form-control form-control-sm">
                            <option value="" disabled selected>{{ __('messages.select_status') }}</option>
                            @foreach (\App\Models\CarwashService::statusOptions() as $key => $value)
                                <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <x-form.textarea
                    id="description"
                    name="description"
                    label="{{ __('messages.description') }}"
                    :value="old('description')"
                    class="form-control-sm"
                />
            </div>
            <x-button.button type="submit" style="success">
                {{ __('messages.save') }}
            </x-button.button>
        </form>
    </div>
@endsection
