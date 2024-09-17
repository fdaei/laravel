@extends('layouts.app')

@section('content')
    <div class="container text-right" style="direction: rtl;">
        <h1 class="mb-4">{{ __('messages.carwash_services') }}</h1>
        <a href="{{ route('carwash_service.create') }}" class="btn btn-primary mb-3">{{ __('messages.add_new_service') }}</a>

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
                    <th>{{ __('messages.description') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </x-slot>

            <x-slot name="body">
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->description }}</td>
                        <td>{!! $service->status !!}</td>
                        <td>
                            <a href="{{ route('carwash_service.edit', $service->id) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('carwash_service.destroy', $service->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                        title="{{ __('messages.delete') }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>

        <div class="d-flex justify-content-center">
            {{ $services->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
