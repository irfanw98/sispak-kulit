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
     Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});


Route::group(['middleware' => ['auth', 'role:admin']], function() {
     Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->name('dashboard-admin');
     Route::get('/akun-admin/sampah', [AdminController::class, 'sampah']);
     Route::get('/akun-admin/sampah/pulihkan/{id?}', [AdminController::class, 'pulihkan']);
     Route::delete('/akun-admin/sampah/hapus/{id?}', [AdminController::class, 'hapus'])->name('hapus');
     Route::resource('/akun-admin', AdminController::class)->only(['index','store','destroy']);
     Route::get('/akun-dokter/sampah', [DokterController::class, 'sampah']);
     Route::get('/akun-dokter/sampah/pulihkan/{id?}', [DokterController::class, 'pulihkan']);
     Route::delete('/akun-dokter/sampah/hapus/{id?}', [DokterController::class, 'hapus']);
     Route::resource('/akun-dokter', DokterController::class);
     Route::get('/akun-user/sampah', [UserController::class, 'sampah']);
     Route::get('/akun-user/sampah/pulihkan/{id?}', [UserController::class, 'pulihkan']);
     Route::delete('/akun-user/sampah/hapus/{id?}', [UserController::class, 'hapus']);
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
