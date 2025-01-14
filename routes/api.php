<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DevicesController;
use App\Http\Controllers\RentalsController;

Route::post('register', [App\Http\Controllers\RegisterController::class, 'register']);
Route::post('login', [App\Http\Controllers\RegisterController::class, 'login']);


// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/user', function (Request $request) {
//         return $request->user();
//     })->middleware('auth:sanctum');

    Route::get('/devices/{id}', [App\Http\Controllers\DevicesController::class, 'show'])->name('devices.show');
    Route::get('/rentals/{id}', [App\Http\Controllers\RentalsController::class, 'show'])->name('rentals.show');

    Route::get('/devices', [App\Http\Controllers\DevicesController::class, 'index'])->name('devices.index');
    Route::post('/devices', [App\Http\Controllers\DevicesController::class, 'store'])->name('devices.store');
    Route::patch('/devices/{id}', [App\Http\Controllers\DevicesController::class, 'update'])->name('devices.update');
    Route::delete('/devices/{id}', [App\Http\Controllers\DevicesController::class, 'destroy'])->name('devices.destroy');

    Route::get('/rentals', [App\Http\Controllers\RentalsController::class, 'index'])->name('rentals.index');
    Route::post('/rentals', [App\Http\Controllers\RentalsController::class, 'store'])->name('rentals.store');
    Route::patch('/rentals/{id}', [App\Http\Controllers\RentalsController::class, 'update'])->name('rentals.update');
    Route::delete('/rentals/{id}', [App\Http\Controllers\RentalsController::class, 'destroy'])->name('rentals.destroy');
// });


