<?php

use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KeluhanController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\TeknisiController;
use App\Http\Controllers\Admin\UserController;
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
    return redirect('login');
});

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function() {
    Route::middleware('isAdmin')->name('admin.')->prefix('admin')->group(function() {
        Route::get('dashboard', [RouteController::class, 'dashboardAdmin'])->name('dashboard');
        Route::resource('user', UserController::class);
        Route::resource('wilayah', WilayahController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('teknisi', TeknisiController::class);
        Route::resource('pelanggan', PelangganController::class); 
        Route::get('keluhan', [RouteController::class, 'keluhan'])->name('keluhan');
    });

    Route::middleware('isTeknisi')->name('teknisi.')->prefix('teknisi')->group(function() {
        Route::get('dashboard', [RouteController::class, 'dashboardTeknisi'])->name('dashboard');
        Route::get('keluhan', [RouteController::class, 'keluhan'])->name('keluhan');
    });

    Route::get('keluhan', [KeluhanController::class, 'index'])->name('keluhan.load');
    Route::get('keluhan/create', [KeluhanController::class, 'create'])->name('keluhan.create');
    Route::post('keluhan', [KeluhanController::class, 'store'])->name('keluhan.store');
    Route::get('keluhan/{keluhan}/edit', [KeluhanController::class, 'edit'])->name('keluhan.edit');
    Route::put('keluhan/{keluhan}', [KeluhanController::class, 'update'])->name('keluhan.update');
    Route::delete('keluhan/{keluhan}', [KeluhanController::class, 'destroy'])->name('keluhan.destroy');

    Route::post('keluhan/{id}/send', [KeluhanController::class, 'send'])->name('keluhan.send');
    Route::get('keluhan/activity-update', [KeluhanController::class, 'updatedActivity'])->name('keluhan.process');
});

Route::get('keluhan/test', [KeluhanController::class, 'test']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::view('/bot', 'botman');

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
