<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login_proses']);
Route::get('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register_proses']);
Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
Route::get('profile', [\App\Http\Controllers\AuthController::class, 'profile']);
Route::post('profile', [\App\Http\Controllers\AuthController::class, 'profile_proses']);

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index']);
    Route::resource('petugas', \App\Http\Controllers\Petugas\HomeController::class);
});

Route::middleware('pengguna')->prefix('pengguna')->group(function () {
    Route::get('/', [\App\Http\Controllers\Pengguna\HomeController::class, 'index']);
    Route::resource('pengaduan', \App\Http\Controllers\Pengguna\PengaduanController::class);
    Route::resource('list-pengaduan', \App\Http\Controllers\Pengguna\ListPengaduanController::class);
});