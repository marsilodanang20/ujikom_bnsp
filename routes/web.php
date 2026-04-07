<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AuthController;

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginAction']);
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerAction']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Default redirect after login based on role, handled by / route
    Route::get('/', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('dashboard');
        }
        return redirect()->route('pendaftaran.index');
    });

    // Admin Routes (Admin memilliki full access)
    Route::middleware('role:admin')->group(function () {
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::resource('jurusan', JurusanController::class)->except(['show']);
        Route::resource('peserta', PesertaController::class)->except(['show']);
        // Walaupun admin punya full access, pendaftaran tetap diakses melalui PendaftaranController
        Route::patch('pendaftaran/{id}/status', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
    });

    // Route Pendaftaran (Bisa diakses oleh admin dan users karena di RoleMiddleware admin memiliki pass)
    Route::middleware('role:users')->group(function () {
        Route::resource('pendaftaran', PendaftaranController::class)->except(['show']);
    });
});
