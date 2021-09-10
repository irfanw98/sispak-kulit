<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
     LogoutController,
     PasswordController
};
use App\Http\Controllers\Admin\{
     DashboardAdminController,
     AdminController,
     DokterController,
     UserController,
     LaporanController
};
use App\Http\Controllers\Dokter\{
     DashboardDokterController,
     GejalaController,
     PenyakitController,
     AturanController
};


Auth::routes();
Route::view('/', 'welcome');

Route::group(['middleware' => ['auth', 'role:admin|dokter|user']], function() {
     Route::resource('/ubah-password', PasswordController::class)->only(['index','store']);
     Route::get('/logout', [LogoutController::class,'logout'])->name('logout');
});

Route::group(['middleware' => ['auth', 'role:admin']], function() {
     Route::get('/dashboard-admin', [DashboardAdminController::class,'index'])->name('dashboard-admin');
     Route::group(['prefix' => '/akun-admin/sampah'], function() {
          Route::get('/', [AdminController::class,'sampah'])->name('sampah-admin');
          Route::get('/pulihkan/{id?}', [AdminController::class,'pulihkan'])->name('pulihkan-admin');
          Route::delete('/hapus/{id?}', [AdminController::class,'hapus'])->name('hapus-admin');
     });
     Route::resource('/akun-admin', AdminController::class)->only(['index','store','destroy']);
     Route::group(['prefix' => '/akun-dokter/sampah'], function() {
          Route::get('/', [DokterController::class,'sampah'])->name('sampah-dokter');
          Route::get('/pulihkan/{id?}', [DokterController::class,'pulihkan'])->name('pulihkan-dokter');
          Route::delete('/hapus/{id?}', [DokterController::class,'hapus'])->name('hapus-dokter');
     });
     Route::resource('/akun-dokter', DokterController::class);
     Route::group(['prefix' => '/akun-user/sampah'], function() {
          Route::get('/', [UserController::class,'sampah'])->name('sampah-user');
          Route::get('/pulihkan/{id?}', [UserController::class,'pulihkan'])->name('pulihkan-user');
          Route::delete('/hapus/{id?}', [UserController::class,'hapus'])->name('hapus-user');
     });
     Route::resource('/akun-user', UserController::class)->only(['index', 'destroy']);
     Route::resource('/laporan-konsultasi', LaporanController::class)->only(['index', 'destroy']);
});

Route::group(['middleware' => ['auth', 'role:dokter']], function() {
     Route::get('/dashboard-dokter', [DashboardDokterController::class, 'index'])->name('dashboard-dokter');
     Route::delete('/gejala/hapus',  [GejalaController::class, 'hapus']);
     Route::resource('/gejala', GejalaController::class);
     Route::delete('/penyakit/hapus',  [PenyakitController::class, 'hapus']);
     Route::resource('/penyakit', PenyakitController::class);
     Route::resource('/aturan',  AturanController::class);
});
Route::group(['middleware' => ['auth', 'role:user']], function() {
     Route::get('/dashboard-user', [App\Http\Controllers\User\DashboardUserController::class, 'index'])->name('dashboard-user');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
