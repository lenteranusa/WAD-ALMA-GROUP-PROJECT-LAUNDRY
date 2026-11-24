<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MaterialController;

// Public: login only (there is no public registration)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Gate 1: must be logged in (and the account must still be active)
Route::middleware(['auth', 'active'])->group(function () {

    Route::view('/', 'index')->name('home');

    // ---- Machinery & Equipment ----
    Route::middleware('role:admin,staff')->group(function () {
        Route::get('/machines', [MachineController::class, 'index'])->name('machines.index');
        Route::put('/machines/{machine}', [MachineController::class, 'update'])->name('machines.update');
    });

    // ---- Service & Rate: admin and staff view, admin manages ----
    Route::middleware('role:admin,staff')->group(function () {
        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    });

    // ---- Customer Data: admin and staff view/add/update ----
    Route::middleware('role:admin,staff')->group(function () {
        Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
        Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
        Route::put('/pelanggan/{pelanggan}', [PelangganController::class, 'update'])->name('pelanggan.update');
    });

    // ---- Cleaning Material: admin and staff view/update stock ----
    Route::middleware('role:admin,staff')->group(function () {
        Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
        Route::put('/materials/{material}', [MaterialController::class, 'update'])->name('materials.update');
    });

    // Gate 2: admin only
    Route::middleware('role:admin')->group(function () {
        // Machinery
        Route::post('/machines', [MachineController::class, 'store'])->name('machines.store');
        Route::delete('/machines/{machine}', [MachineController::class, 'destroy'])->name('machines.destroy');

        // Service & Rate
        Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

        // Customer Data
        Route::delete('/pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

        // Cleaning Material
        Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
        Route::delete('/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');

        // Register new users: admin only
        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register']);
    });
});
