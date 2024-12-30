<?php
use App\Http\Controllers\Maintener\JadwalController;
use Illuminate\Support\Facades\Route;

Route::get('/maintener/riwayat', [JadwalController::class,'riwayat'])->middleware(['auth'])->name('maintener-riwayat');
Route::resource('/maintener/jadwal',JadwalController::class)->middleware(['auth'])->names('maintener-jadwal');