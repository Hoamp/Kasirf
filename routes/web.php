<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaController;

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




Route::controller(PenggunaController::class)->group(function(){
    Route::get('/pengguna','index')->name('pengguna');
    Route::post('/tambahpengguna','create')->name('tambahpengguna');
    Route::delete('/delete/{id}','destroy')->name('delete');
});
