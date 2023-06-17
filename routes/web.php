<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DaftarPemesananController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\PemesananController;
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

Route::controller(PemesananController::class)->name('pemesanan.')->group(function () {
    Route::get('/', [PemesananController::class, 'index'])->name('index');
    Route::get('/pemesanan/list-kelas/{id}', [PemesananController::class, 'listkelas'])->name('listkelas');
    Route::post('/pemesanan', [PemesananController::class, 'submitPemesanan'])->name('submitPemesanan');
});


Route::group(['prefix'=>'admin'], function() {

    Route::get('/auth', [AuthController::class, 'index'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

    Route::group(['middleware' => 'auth'],function(){
        Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
        Route::get('/', [HomeController::class, 'index'])->name('home.index');
    });

    Route::controller(UsersController::class)->prefix('users')->name('users.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('/list', [UsersController::class, 'list'])->name('list');
    });

    Route::controller(DaftarPemesananController::class)->prefix('pemesanan')->name('pemesanan.')->group(function () {
        Route::get('/', [DaftarPemesananController::class, 'index'])->name('index');
        Route::get('/list', [DaftarPemesananController::class, 'list'])->name('list');
    });
});
