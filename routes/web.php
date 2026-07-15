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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::post('/kunjungan', [App\Http\Controllers\HomeController::class, 'kunjungan'])->name('kunjungan');


Route::get('login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('login', [App\Http\Controllers\LoginController::class, 'login'])->name('login.action');
Route::get('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('get-member', [App\Http\Controllers\HomeController::class, 'getmember'])->name('getmember');

Route::middleware(['auth'])->group(function () {
    Route::resource('/dashboard', \App\Http\Controllers\DashboardController::class)->only(['index']);
    Route::resource('/admin', \App\Http\Controllers\AdminController::class);
    Route::resource('/anggota', \App\Http\Controllers\AnggotaController::class);
    Route::post('/anggota/import', [\App\Http\Controllers\AnggotaController::class, 'import'])->name('anggota.import');
    Route::resource('/buku', \App\Http\Controllers\BukuController::class);
    Route::resource('/eksemplar', \App\Http\Controllers\EksemplarController::class);
    Route::resource('/peminjaman', \App\Http\Controllers\PeminjamanController::class);
    Route::resource('/pengunjung', \App\Http\Controllers\PengunjungController::class);
});
