<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/dashboard-admin', [App\Http\Controllers\Admin\DashboardAdminController::class, 'index'])->name('dashboard-admin');
    Route::resource('/akun-admin', [App\Http\Controllers\Admin\AdminController::class]);
});
Route::group(['middleware' => ['auth', 'role:dokter']], function() {
     Route::get('/dashboard-dokter', [App\Http\Controllers\Dokter\DashboardDokterController::class, 'index'])->name('dashboard-dokter');
});
Route::group(['middleware' => ['auth', 'role:user']], function() {
     Route::get('/dashboard-user', [App\Http\Controllers\User\DashboardUserController::class, 'index'])->name('dashboard-user');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');