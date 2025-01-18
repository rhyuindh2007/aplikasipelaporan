<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;


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

Route::get('/',function(){
    return view('welcome');
});
    Route::middleware('auth')->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
Route::resource('laporan',LaporanController::class)->middleware('auth');
Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
Route::get('/laporan/view/{filename}', [LaporanController::class, 'view'])->name('laporan.view');
Route::get('/laporan/view/{filename}', [LaporanController::class, 'viewPdf'])->name('laporan.view');
Route::get('/laporan/download/{filename}', [LaporanController::class, 'downloadPdf'])->name('laporan.download');


Route::resource('kategori', KategoriController::class)->middleware('auth');
Route::resource('user', UserController::class)->middleware('auth');





Route::get('login', [LoginController::class, 'loginView'])->name('login');
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

