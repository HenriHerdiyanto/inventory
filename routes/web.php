<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::put('/profile/update/{id}', [App\Http\Controllers\HomeController::class, 'UpdateProfile'])->name('profile.update');
Route::post('/profile/destroy/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('profile.destroy');


Route::get('/Kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('kategori');
Route::post('/Kategori/store', [App\Http\Controllers\KategoriController::class, 'store'])->name('kategori.store');
Route::put('/Kategori/update/{id}', [App\Http\Controllers\KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/Kategori/{id}', [App\Http\Controllers\KategoriController::class, 'destroy'])->name('kategori.destroy');

Route::get('/produk.index', [App\Http\Controllers\ProdukController::class, 'index'])->name('produk.index');
Route::post('/produk/store', [App\Http\Controllers\ProdukController::class, 'store'])->name('produk.store');
Route::put('/produk/update/{id}', [App\Http\Controllers\ProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/{id}', [App\Http\Controllers\ProdukController::class, 'destroy'])->name('produk.destroy');

Route::get('/penjualan.index', [App\Http\Controllers\PenjualanController::class, 'index'])->name('penjualan.index');
Route::post('/penjualan.store', [App\Http\Controllers\PenjualanController::class, 'store'])->name('penjualan.store');
Route::put('/penjualan/update/{id}', [App\Http\Controllers\PenjualanController::class, 'update'])->name('penjualan.update');
Route::delete('/penjualan/{id}', [App\Http\Controllers\PenjualanController::class, 'destroy'])->name('penjualan.destroy');

Route::get('/export', [App\Http\Controllers\ExportController::class, 'export'])->name('export');
