<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * TUGAS PERTEMUAN 4
 * Menghubungkan URL dengan ProductController
 */

// Menampilkan semua data (READ) 
Route::get('/products', [ProductController::class, 'index']);

// Menambah data baru (CREATE) 
Route::post('/products', [ProductController::class, 'store']);

// Mengubah data (UPDATE) 
Route::put('/products/{id}', [ProductController::class, 'update']);

// Menghapus data (DELETE) 
Route::delete('/products/{id}', [ProductController::class, 'destroy']);