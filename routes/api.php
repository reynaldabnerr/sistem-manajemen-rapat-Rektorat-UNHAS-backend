<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);

use App\Http\Controllers\Api\RapatController;
use App\Http\Controllers\Api\AbsensiController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/rapat', [RapatController::class, 'index']);
    Route::post('/rapat', [RapatController::class, 'store']);
    Route::get('/rapat/{id}', [RapatController::class, 'show']);
});
Route::post('/absensi', [AbsensiController::class, 'store']);
Route::get('/rapat/{id}/rekap', [RapatController::class, 'rekap']);
Route::get('/rapat/{id}/absensi', [RapatController::class, 'absensi']);
Route::put('/rapat/{id}', [RapatController::class, 'update']);
Route::delete('/rapat/{id}', [RapatController::class, 'destroy']);
Route::put('/absensi/{id}', [AbsensiController::class, 'update']);
Route::delete('/absensi/{id}', [AbsensiController::class, 'destroy']);
Route::get('/absensi/{id}', [AbsensiController::class, 'show']);

use App\Http\Controllers\Api\AbsensiPublicController;

Route::get('/absensi-link/{link_absensi}', [AbsensiPublicController::class, 'getRapatByLink']);
Route::post('/absensi-link/{link_absensi}', [AbsensiPublicController::class, 'submitAbsensi']);







