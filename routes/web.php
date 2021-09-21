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
use App\Http\Controllers\User\{
     DashboardUserController,
     KonsultasiController,
     RiwayatDiagnosaController
};

Auth::routes();
Route::view('/', 'welcome');

Route::group(['middleware' => ['auth', 'role:admin|dokter|user']], function() {
     Route::resource('/ubah-password', PasswordController::class)->only(['index','store']);
     Route::get('/logout', [LogoutController::class,'logout'])->name('keluar');
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
     Route::group(['prefix' => '/laporan-konsultasi/sampah'], function() {
          Route::get('/', [LaporanController::class, 'sampah'])->name('sampah-laporan');
          Route::get('/pulihkan/{id?}', [LaporanController::class, 'pulihkan'])->name('pulihkan-laporan');
          Route::delete('/hapus/{id?}', [LaporanController::class, 'hapus'])->name('hapus-laporan');
     });
     Route::get('/laporan-konsultasi/cetak', [LaporanController::class, 'cetak'])->name('cetak-laporan');
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
     Route::get('/dashboard-user', [DashboardUserController::class, 'index'])->name('dashboard-user');
     Route::resource('/konsultasi', KonsultasiController::class);
     Route::get('/riwayat-diagnosa/pdf', [RiwayatDiagnosaController::class,'exportPdf'])->name('export-pdf');
     Route::resource('/riwayat-diagnosa', RiwayatDiagnosaController::class)->only(['index', 'show']);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
