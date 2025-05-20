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
    Route::resource('dashboard', DashboardController::class);
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });


    // CRUD untuk Estimasi Biaya
    Route::resource('estimasibiayas', EstimasiBiayaController::class);
    // Routes untuk Estimasi Biaya secara terperinci
    Route::prefix('estimasibiayas')->name('estimasibiayas.')->group(function () {
        Route::get('/', [EstimasiBiayaController::class, 'index'])->name('index');
        Route::get('/{estimasiBiaya}', [EstimasiBiayaController::class, 'show'])->name('show');
        Route::get('/{id_estimasi}/export-pdf', [EstimasiBiayaController::class, 'exportPdf'])->name('export-pdf');

    });

    Route::middleware(['check.role:Service Advisor 1,Service Advisor 2,Service Advisor 3'])->group(function () {
        // CRUD untuk Part
        Route::resource('parts', PartController::class);
        Route::prefix('parts')->name('parts.')->group(function () {
            Route::get('/', [PartController::class, 'index'])->name('index');
            Route::get('/create', [PartController::class, 'create'])->name('create');
            Route::post('/', [PartController::class, 'store'])->name('store');
            Route::get('/{part}', [PartController::class, 'show'])->name('show');
            Route::get('/{part}/edit', [PartController::class, 'edit'])->name('edit');
            Route::put('/{part}', [PartController::class, 'update'])->name('update');
            Route::delete('/{part}', [PartController::class, 'destroy'])->name('destroy');
        });

        // CRUD untuk Material
        Route::resource('materials', MaterialController::class);
        Route::prefix('materials')->name('materials.')->group(function () {
            Route::get('/', [MaterialController::class, 'index'])->name('index');
            Route::get('/create', [MaterialController::class, 'create'])->name('create');
            Route::post('/', [MaterialController::class, 'store'])->name('store');
            Route::get('/{material}', [MaterialController::class, 'show'])->name('show');
            Route::get('/{material}/edit', [MaterialController::class, 'edit'])->name('edit');
            Route::put('/{material}', [MaterialController::class, 'update'])->name('update');
            Route::delete('/{material}', [MaterialController::class, 'destroy'])->name('destroy');
        });

        // CRUD untuk Jasa Vendor
        Route::resource('jasavendors', JasaVendorController::class);
        Route::prefix('jasavendors')->name('jasavendors.')->group(function () {
            Route::get('/', [JasaVendorController::class, 'index'])->name('index');
            Route::get('/create', [JasaVendorController::class, 'create'])->name('create');
            Route::post('/', [JasaVendorController::class, 'store'])->name('store');
            Route::get('/{jasaVendor}', [JasaVendorController::class, 'show'])->name('show');
            Route::get('/{jasaVendor}/edit', [JasaVendorController::class, 'edit'])->name('edit');
            Route::put('/{jasaVendor}', [JasaVendorController::class, 'update'])->name('update');
            Route::delete('/{jasaVendor}', [JasaVendorController::class, 'destroy'])->name('destroy');
        });

        // CRUD untuk Jasa Berkala
        Route::resource('jasaberkalas', JasaBerkalaController::class);
        Route::prefix('jasaberkalas')->name('jasaberkalas.')->group(function () {
            Route::get('/', [JasaBerkalaController::class, 'index'])->name('index');
            Route::get('/create', [JasaBerkalaController::class, 'create'])->name('create');
            Route::post('/', [JasaBerkalaController::class, 'store'])->name('store');
            Route::get('/{jasaBerkala}', [JasaBerkalaController::class, 'show'])->name('show');
            Route::get('/{jasaBerkala}/edit', [JasaBerkalaController::class, 'edit'])->name('edit');
            Route::put('/{jasaBerkala}', [JasaBerkalaController::class, 'update'])->name('update');
            Route::delete('/{jasaBerkala}', [JasaBerkalaController::class, 'destroy'])->name('destroy');
        });

        // Routes untuk Estimasi Biaya secara terperinci
        Route::prefix('estimasibiayas')->name('estimasibiayas.')->group(function () {
            Route::get('/create', [EstimasiBiayaController::class, 'create'])->name('create');
            Route::post('/', [EstimasiBiayaController::class, 'store'])->name('store');
            Route::get('/{estimasiBiaya}/edit', [EstimasiBiayaController::class, 'edit'])->name('edit');
            Route::put('/{estimasiBiaya}', [EstimasiBiayaController::class, 'update'])->name('update');
            Route::delete('/{estimasiBiaya}', [EstimasiBiayaController::class, 'destroy'])->name('destroy');
        });
    });
});
