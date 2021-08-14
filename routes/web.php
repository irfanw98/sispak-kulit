<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('/pesan', App\Http\Controllers\Admin\PesanController::class);
Route::get('/logout', ['App\Http\Controllers\LogoutController', 'logout'])->name('logout');

//ADMIN ROUTE
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/dashboard-admin', [App\Http\Controllers\Admin\DashboardAdminController::class, 'index'])->name('dashboard-admin');
    Route::resource('/admin', App\Http\Controllers\Admin\AdminController::class);
    Route::resource('/dokter', App\Http\Controllers\Admin\DokterController::class);
    Route::resource('/user', App\Http\Controllers\Admin\UserController::class)->only(['index', 'destroy']);
    Route::resource('/laporan', App\Http\Controllers\Admin\LaporanController::class)->only(['index', 'destroy']);
});

Route::group(['middleware' => ['auth', 'role:dokter']], function() {
     Route::get('/dashboard-dokter', [App\Http\Controllers\Dokter\DashboardDokterController::class, 'index'])->name('dashboard-dokter');
});
Route::group(['middleware' => ['auth', 'role:user']], function() {
     Route::get('/dashboard-user', [App\Http\Controllers\User\DashboardUserController::class, 'index'])->name('dashboard-user');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');