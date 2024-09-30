<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:api')->group(function () {
    Route::get('/disposisi/{disposisi_id}/transaksi', [TransaksiController::class, 'index']);
    Route::post('/disposisi/{disposisi_id}/transaksi', [TransaksiController::class, 'store']);
});
