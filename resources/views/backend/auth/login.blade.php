@extends('layouts.auth')

@section('title', __('auth.login_title'))

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg border-0 rounded" style="max-width: 400px; width: 100%;">
            <div class="card-header bg-primary text-white text-center rounded-top">
                <h4>{{ __('auth.login_title') }}</h4>
            </div>
            <div class="card-body text-right">
                <form action="{{ route('backend.auth.sendVerificationCode') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="mobile" class="form-label">{{ __('auth.mobile_label') }}</label>
                        <div class="input-group">
                            <input type="tel" id="mobile" name="mobile"
                                   class="form-control @error('mobile') is-invalid @enderror" placeholder="{{ __('auth.mobile_placeholder') }}"
                                   value="{{ old('mobile') }}" required autofocus dir="rtl"
                                   style="text-align: right;" maxlength="11"
                                   pattern="09[0-9]{9}" title="{{ __('auth.mobile_pattern') }}">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </span>
                            </div>
                            @error('mobile')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('auth.login_button') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
