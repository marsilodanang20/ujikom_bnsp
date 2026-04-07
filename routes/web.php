<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PendaftaranController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Jurusan
Route::resource('jurusan', JurusanController::class)->except(['show']);

// Peserta
Route::resource('peserta', PesertaController::class)->except(['show']);

// Pendaftaran
Route::resource('pendaftaran', PendaftaranController::class)->except(['show']);
Route::patch('pendaftaran/{id}/status', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
