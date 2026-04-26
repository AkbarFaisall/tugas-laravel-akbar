<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

// Rute Publik
Route::post('/login', [AuthController::class, 'login']);

// Rute Terproteksi Autentikasi
Route::middleware('auth:sanctum')->group(function () {
    
    // Semua user login bisa melihat data
    Route::get('/products', [ProductController::class, 'index']);

    // Rute Terproteksi Otoritas/Role
    Route::middleware('role:admin')->group(function () {
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        
        // HANYA ADMIN yang bisa akses rute hapus
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});