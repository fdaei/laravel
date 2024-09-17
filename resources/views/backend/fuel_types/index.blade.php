@extends('layouts.app')

@section('content')
    <div class="container text-right" style="direction: rtl;">
        <h1 class="mb-4">{{ __('messages.fuel_types') }}</h1>
        <a href="{{ route('fuel_types.create') }}" class="btn btn-primary mb-3">{{ __('messages.add_new_fuel_type') }}</a>

        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
            <x-alert type="danger" :message="session('error')" />
        @endif

        <x-table>
            <x-slot name="header">
                <tr>
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @foreach($fuelTypes as $fuelType)
                    <tr>
                        <td>{{ $fuelType->id }}</td>
                        <td>{{ $fuelType->name }}</td>
                        <td>{!! $fuelType->status !!}</td>
                        <td>
                            <a href="{{ route('fuel_types.edit', $fuelType->id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('fuel_types.destroy', $fuelType->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                        title="{{ __('messages.delete') }}" onclick="return confirm('{{ __('messages.confirm_delete') }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>

        <div class="d-flex justify-content-center mt-3">
            {{ $fuelTypes->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
