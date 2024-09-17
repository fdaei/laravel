<?php

use App\Http\Controllers\Backend\CarController;
use App\Http\Controllers\Backend\CarwashPriceController;
use App\Http\Controllers\Backend\CarwashServiceController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\FuelPriceController;
use App\Http\Controllers\Backend\FuelTypeController;

Route::get('login', [AuthController::class, 'Login'])->name('login');
Route::post('send-verification-code', [AuthController::class, 'sendVerificationCode'])->name('backend.auth.sendVerificationCode');
Route::get('verify', [AuthController::class, 'showVerificationForm'])->name('backend.auth.verifyForm');
Route::post('verify-code-and-login', [AuthController::class, 'verifyCodeAndLogin'])->name('backend.auth.verifyCodeAndLogin');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('backend.auth.logout');

    Route::get('cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('cars/{id}', [CarController::class, 'show'])->name('cars.show');
    Route::get('cars/{id}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('cars/{id}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('cars/{id}', [CarController::class, 'destroy'])->name('cars.destroy');

    Route::get('carwash_service', [CarwashServiceController::class, 'index'])->name('carwash_service.index');
    Route::get('carwash_service/create', [CarwashServiceController::class, 'create'])->name('carwash_service.create');
    Route::post('carwash_service', [CarwashServiceController::class, 'store'])->name('carwash_service.store');
    Route::get('carwash_service/{id}', [CarwashServiceController::class, 'show'])->name('carwash_service.show');
    Route::get('carwash_service/{id}/edit', [CarwashServiceController::class, 'edit'])->name('carwash_service.edit');
    Route::put('carwash_service/{id}', [CarwashServiceController::class, 'update'])->name('carwash_service.update');
    Route::delete('carwash_service/{id}', [CarwashServiceController::class, 'destroy'])->name('carwash_service.destroy');

    Route::get('carwash_prices', [CarwashPriceController::class, 'index'])->name('carwash_prices.index');
    Route::get('carwash_prices/create', [CarwashPriceController::class, 'create'])->name('carwash_prices.create');
    Route::post('carwash_prices', [CarwashPriceController::class, 'store'])->name('carwash_prices.store');
    Route::get('carwash_prices/{id}', [CarwashPriceController::class, 'show'])->name('carwash_prices.show');
    Route::get('carwash_prices/{id}/edit', [CarwashPriceController::class, 'edit'])->name('carwash_prices.edit');
    Route::put('carwash_prices/{id}', [CarwashPriceController::class, 'update'])->name('carwash_prices.update');
    Route::delete('carwash_prices/{id}', [CarwashPriceController::class, 'destroy'])->name('carwash_prices.destroy');

    // Routes for FuelPriceController
    Route::get('fuel_prices', [FuelPriceController::class, 'index'])->name('fuel_prices.index');
    Route::get('fuel_prices/create', [FuelPriceController::class, 'create'])->name('fuel_prices.create');
    Route::post('fuel_prices', [FuelPriceController::class, 'store'])->name('fuel_prices.store');
    Route::get('fuel_prices/{id}', [FuelPriceController::class, 'show'])->name('fuel_prices.show');
    Route::get('fuel_prices/{id}/edit', [FuelPriceController::class, 'edit'])->name('fuel_prices.edit');
    Route::put('fuel_prices/{id}', [FuelPriceController::class, 'update'])->name('fuel_prices.update');
    Route::delete('fuel_prices/{id}', [FuelPriceController::class, 'destroy'])->name('fuel_prices.destroy');

    // Routes for FuelTypeController
    Route::resource('fuel_types', FuelTypeController::class)->except(['show']);
});

Route::get('Locate/{lang}', [LocaleController::class, 'setLocate'])->name('locale.set');
