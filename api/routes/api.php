<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

Route::middleware('auth:api')->group(function () {
    Route::get('/disposisi/{disposisi_id}/transaksi', [TransaksiController::class, 'index']);
    Route::post('/disposisi/{disposisi_id}/transaksi', [TransaksiController::class, 'store']);
});
