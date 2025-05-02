<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MutasiController;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // User routes
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Barang routes
    Route::apiResource('barang', BarangController::class);

    // Mutasi routes
    Route::apiResource('mutasi', MutasiController::class);
    Route::get('/mutasi/barang/{barang}', [MutasiController::class, 'historyByBarang']);
    Route::get('/mutasi/user/history', [MutasiController::class, 'historyByUser']);
});