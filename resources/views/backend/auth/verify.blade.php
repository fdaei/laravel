@extends('layouts.auth')

@section('title', __('messages.verify_mobile'))

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg border-0 rounded" style="max-width: 400px; width: 100%;">
            <div class="card-header bg-primary text-white text-center rounded-top">
                <h4>{{ __('messages.verify_mobile') }}</h4>
            </div>
            <div class="card-body text-right">
                <form action="{{ route('backend.auth.verifyCodeAndLogin') }}" method="post">
                    @csrf
                    <!-- Pass the mobile number using a hidden input field -->
                    <input type="hidden" name="mobile" value="{{ $mobile }}">

                    <!-- Verification Code Field -->
                    <div class="form-group">
                        <label for="verification_code">{{ __('messages.verification_code') }}</label>
                        <input type="text" name="verification_code" id="verification_code"
                               class="form-control @error('verification_code') is-invalid @enderror"
                               placeholder="{{ __('messages.verification_code') }}"
                               value="{{ old('verification_code') }}" required autofocus dir="rtl"
                               style="text-align: right;">
                        @error('verification_code')
                        <div class="invalid-feedback" style="text-align: right;">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password">{{ __('messages.password') }}</label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="{{ __('messages.password') }}" required dir="rtl"
                               style="text-align: right;">
                        @error('password')
                        <div class="invalid-feedback" style="text-align: right;">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <!-- Success Message -->
                    @if(session('message'))
                        <div class="form-group text-center">
                            <p class="text-success">{{ session('message') }}</p>
                        </div>
                    @endif

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="form-group text-center">
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('messages.confirm_and_login') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
