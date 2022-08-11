<?php

use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\TeknisiCotroller;
use App\Http\Controllers\Admin\WilayahController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Route\RouteController;
use App\Http\Controllers\BotManController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function() {
    Route::middleware('isAdmin')->name('admin.')->prefix('admin')->group(function() {
        Route::get('dashboard', [RouteController::class, 'dashboardAdmin'])->name('dashboard');
        Route::resource('wilayah', WilayahController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('teknisi', TeknisiCotroller::class);
        Route::resource('pelanggan', PelangganController::class); 
        Route::get('keluhan', [RouteController::class, 'keluhan'])->name('keluhan');
    });

    Route::middleware('isTeknisi')->name('teknisi.')->prefix('teknisi')->group(function() {
        Route::get('dashboard', [RouteController::class, 'dashboardTeknisi'])->name('dashboard');
        Route::get('keluhan', [RouteController::class, 'keluhan'])->name('keluhan');
    });
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::view('/bot', 'botman');

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
