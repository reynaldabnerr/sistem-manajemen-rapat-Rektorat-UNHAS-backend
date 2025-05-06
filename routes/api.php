<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RapatController;
use App\Http\Controllers\Api\AbsensiController;
use App\Http\Controllers\Api\AbsensiPublicController;
use App\Http\Controllers\Api\AdminController; // ✅ Tambahkan ini
use App\Http\Middleware\RoleMiddleware;

// Login
Route::post('/login', [AuthController::class, 'login']);

// Public Absensi
Route::get('/absensi-link/{link_absensi}', [AbsensiPublicController::class, 'getRapatByLink']);
Route::post('/absensi-link/{link_absensi}', [AbsensiPublicController::class, 'submitAbsensi']);

// Private API (Auth only)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/rapat', [RapatController::class, 'index']);
    Route::post('/rapat', [RapatController::class, 'store']);
    Route::get('/rapat/{id}', [RapatController::class, 'show']);
    Route::get('/rapat/{id}/rekap', [RapatController::class, 'rekap']);
    Route::get('/rapat/{id}/absensi', [RapatController::class, 'absensi']);
    Route::put('/rapat/{id}', [RapatController::class, 'update']);
    Route::delete('/rapat/{id}', [RapatController::class, 'destroy']);

    Route::post('/absensi', [AbsensiController::class, 'store']);
    Route::get('/absensi/{id}', [AbsensiController::class, 'show']);
    Route::put('/absensi/{id}', [AbsensiController::class, 'update']);
    Route::delete('/absensi/{id}', [AbsensiController::class, 'destroy']);

    // Superadmin Only
    Route::middleware([RoleMiddleware::class . ':superadmin'])->group(function () {
        Route::get('/admins', [AdminController::class, 'index']);
        Route::post('/admins', [AdminController::class, 'store']);
        Route::delete('/admins/{id}', [AdminController::class, 'destroy']);
        Route::put('/admins/{id}', [AdminController::class, 'update']);

    });
});
