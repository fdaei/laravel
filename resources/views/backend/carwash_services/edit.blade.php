@extends('layouts.app')

@section('content')
    <div class="container text-right" style="direction: rtl;">
        <h1 class="mb-4">{{ __('messages.edit_service') }}</h1>

        <form action="{{ route('carwash_service.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <x-form.input
                        type="text"
                        id="name"
                        name="name"
                        :value="old('name', $service->name)"
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
                            @foreach (\App\Models\CarwashService::statusOptions() as $key => $value)
                                <option value="{{ $key }}" {{ old('status', $service->status) == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <x-form.textarea
                id="description"
                name="description"
                label="{{ __('messages.description') }}"
                :value="old('description', $service->description)"
                class="form-control-sm"
            />

            <x-button.button type="submit" style="success">
                {{ __('messages.update') }}
            </x-button.button>
        </form>
    </div>
@endsection
