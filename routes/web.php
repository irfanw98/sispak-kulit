<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::view('/', 'welcome');

Auth::routes();

Route::get('/logout', ['App\Http\Controllers\LogoutController', 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/dashboard-admin', [App\Http\Controllers\Admin\DashboardAdminController::class, 'index'])->name('dashboard-admin');
    Route::get('/akun-admin/sampah', [App\Http\Controllers\Admin\AdminController::class, 'sampah']);
    Route::get('/akun-admin/sampah/pulihkan/{id?}', [App\Http\Controllers\Admin\AdminController::class, 'pulihkan']);
    Route::delete('/akun-admin/sampah/hapus/{id?}', [App\Http\Controllers\Admin\AdminController::class, 'hapus'])->name('hapus');
    Route::resource('/akun-admin', App\Http\Controllers\Admin\AdminController::class)->only(['index','store','destroy']);
    Route::get('/akun-dokter/sampah', [App\Http\Controllers\Admin\DokterController::class, 'sampah']);
    Route::get('/akun-dokter/sampah/pulihkan/{id?}', [App\Http\Controllers\Admin\DokterController::class, 'pulihkan']);
    Route::delete('/akun-dokter/sampah/hapus/{id?}', [App\Http\Controllers\Admin\DokterController::class, 'hapus']);
    Route::resource('/akun-dokter', App\Http\Controllers\Admin\DokterController::class);
    Route::get('/akun-user/sampah', [App\Http\Controllers\Admin\UserController::class, 'sampah']);
    Route::get('/akun-user/sampah/pulihkan/{id?}', [App\Http\Controllers\Admin\UserController::class, 'pulihkan']);
    Route::delete('/akun-user/sampah/hapus/{id?}', [App\Http\Controllers\Admin\UserController::class, 'hapus']);
    Route::resource('/akun-user', App\Http\Controllers\Admin\UserController::class)->only(['index', 'destroy']);
    Route::resource('/laporan-konsultasi', App\Http\Controllers\Admin\LaporanController::class)->only(['index', 'destroy']);
});

Route::group(['middleware' => ['auth', 'role:dokter']], function() {
     Route::get('/dashboard-dokter', [App\Http\Controllers\Dokter\DashboardDokterController::class, 'index'])->name('dashboard-dokter');
});
Route::group(['middleware' => ['auth', 'role:user']], function() {
     Route::get('/dashboard-user', [App\Http\Controllers\User\DashboardUserController::class, 'index'])->name('dashboard-user');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');