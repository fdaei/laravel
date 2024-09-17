@extends('layouts.app')

@section('content')
    <div class="container  text-right" style="direction: rtl;">
        <h1 class="mb-4">{{ __('messages.cars') }}</h1>
        <a href="{{ route('cars.create') }}" class="btn btn-primary mb-3">{{ __('messages.add_new_car') }}</a>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <table class="table table-striped table-bordered text-right">
            <thead class="thead-light">
            <tr>
                <th>{{ __('messages.id') }}</th>
                <th>{{ __('messages.model') }}</th>
                <th>{{ __('messages.make') }}</th>
                <th>{{ __('messages.series') }}</th>
                <th>{{ __('messages.type') }}</th>
                <th>{{ __('messages.status') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cars as $index=>$car)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->make }}</td>
                    <td>
                        <div class="badge badge-info">{{ $car->series }}</div>
                    </td>
                    <td>
                        {!! $car->get_type !!}
                    </td>
                    <td>
                        {!! $car->get_status !!}
                    </td>
                    <td>
                        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-outline-warning btn-sm"
                           title="{{ __('messages.edit') }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline;">
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
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $cars->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
