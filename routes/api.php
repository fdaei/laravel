<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CarController;
use App\Http\Controllers\API\CarwashApiController;
use App\Http\Controllers\API\CarwashServiceController;
use App\Http\Controllers\API\FuelPriceController;
use App\Http\Controllers\API\FuelTypeController;
use Illuminate\Support\Facades\Route;


Route::post('send-registration-verification-code', [AuthController::class, 'sendRegistrationVerificationCode']);
Route::post('complete-registration', [AuthController::class, 'completeRegistration']);
Route::post('send-verification-code', [AuthController::class, 'sendVerificationCode']);
Route::post('verify-code-and-login', [AuthController::class, 'verifyCodeAndLogin']);
Route::middleware('auth:api')->post('logout', [AuthController::class, 'logout']);
Route::post('/refresh-token', [AuthController::class, 'refreshToken']);
Route::get('/carwash-prices', [CarwashApiController::class, 'index']);
Route::get('/cars', [CarController::class, 'index']);
Route::get('/carwash-services', [CarwashServiceController::class, 'index']);
Route::get('/fuel-types', [FuelTypeController::class, 'index']);
Route::get('/fuel-price', [FuelPriceController::class, 'index']);
