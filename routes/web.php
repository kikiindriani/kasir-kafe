<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ReportController;
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

// route auth login, logout 
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login-process', [AuthController::class, 'loginProcess'])->name('login-process');
Route::get('/logout', [AuthController::class, 'logoutProcess'])->name('logout-process');

// route dashboard template
// Route::get('/dashboard', function () {
//     return view('layouts.app');
// });

// route pegawai
Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::post('/add-pegawai', [PegawaiController::class, 'store'])->name('pegawai.add');
Route::put('/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
Route::delete('/pegawai/delete/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.delete');

// route menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::post('/add-menu', [MenuController::class, 'store'])->name('menu.add');
route::put('/menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
route::delete('/menu/delete/{id}', [MenuController::class, 'destroy'])->name('menu.delete');

// route order 
Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('/add-order', [OrderController::class, 'store'])->name('order.add');

// route laporan
Route::get('/laporan', [ReportController::class, 'report'])->name('report.report');
