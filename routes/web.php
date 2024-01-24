<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PelangganController;

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
    return view('index');
});
Route::group(['middleware' => 'auth'], function () {
    Route::controller(PenggunaController::class)->group(function(){
        Route::get('/dashboard','dashboard')->name('dashboard');
        Route::get('/pengguna','index')->name('pengguna');
        Route::post('/tambahpengguna','create')->name('tambahpengguna');
        Route::delete('/delete/{id}','destroy')->name('delete');
        Route::get('/editpengguna/{id}', 'edit')->name('editpengguna');
        Route::put('/updatepengguna/{id}','update')->name('updatepengguna');
        Route::get('/resetpassword/{id}','reset')->name('resetpassword');
        Route::get('/login','auth')->name('login');
    });

    Route::controller(ProdukController::class)->group(function(){
        Route::get('/produk','index')->name('produk');
        Route::post('/tambahproduk','store')->name('tambahproduk');
        Route::delete('/delete_product/{ProdukID}','destroy')->name('delete_product');
    });

    Route::controller(PelangganController::class)->group(function(){
        Route::get('/pelanggan','index')->name('pelanggan');
        Route::post('/tambahpelanggan','store')->name('tambahpelanggan');
        Route::delete('/delete_pelanggan/{PelangganID}','destroy')->name('delete_pelanggan');
    });
    
});

Route::controller(AuthController::class)->group(function(){
 
    Route::get('/login','showLogin')->name('login');
    Route::post('/login','login');
    Route::get('/logout','logout')->name('logout');
});
