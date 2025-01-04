<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LaporanContoller;
use App\Http\Controllers\PaymentContoller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AkunpenggunaController;
use App\Http\Controllers\PenjualanContoller;

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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    return "Cache cleared successfully";
});
Route::get('/not-found', function () {
    return view('not-found');
});

Route::get('/', function () {
    return redirect('login');
});

Route::get('/perbarui-password', [HomeController::class,'perbarui_password'])->middleware(['auth'])->name('perbarui_password');
Route::post('/perbarui-password/updatepw', [HomeController::class,'updatepw'])->middleware(['auth'])->name('perbaruipassword_new');

Route::resource('/dashboard', HomeController::class)->middleware(['auth'])->names('home');
Route::resource('/akun', AkunpenggunaController::class)->middleware(['auth'])->names('user');
Route::resource('/category',CategoryController::class)->middleware(['auth'])->names('category');
Route::resource('/product',ProductController::class)->middleware(['auth'])->names('product');
Route::resource('/rent',RentController::class)->middleware(['auth'])->names('rent');
Route::resource('/penjualan',PenjualanContoller::class)->middleware(['auth'])->names('penjualan');
Route::resource('/payment',PaymentContoller::class)->middleware(['auth'])->names('payment');
Route::resource('/laporan',LaporanContoller::class)->middleware(['auth'])->names('laporan');
require __DIR__.'/auth.php';
