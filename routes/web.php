<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\JasaVendorController;
use App\Http\Controllers\JasaBerkalaController;
use App\Http\Controllers\EstimasiBiayaController;
use App\Http\Controllers\DetailEstimasiBiayaController;

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

// Rute untuk halaman utama
Route::get('/', function () {
    return redirect('/login');
});

// Rute Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');

// Rute dengan middleware auth
Route::middleware(['check.login'])->group(function () {
    // Dashboard
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // CRUD untuk Part
    Route::resource('parts', PartController::class);
    
    // CRUD untuk Material
    Route::resource('materials', MaterialController::class);
    
    // CRUD untuk Jasa Vendor
    Route::resource('jasa-vendors', JasaVendorController::class);
    
    // CRUD untuk Jasa Berkala
    Route::resource('jasa-berkalas', JasaBerkalaController::class);
    
    // CRUD untuk Estimasi Biaya
    Route::resource('estimasi-biaya', EstimasiBiayaController::class);
    
    // CRUD untuk Detail Estimasi Biaya
    Route::resource('detail-estimasi', DetailEstimasiBiayaController::class);
});