<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Redirect ke login
Route::get('/', function () {
    return redirect('/login');
});

// Halaman Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Proses Login
Route::post('/login', [AuthController::class, 'login']);
Route::get('/test-role', function () {
    return 'ok';
})->middleware('role:admin');

// Proses Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman yang butuh login
Route::middleware('auth')->group(function () {
    
    // Routes Superadmin (hanya role superadmin)
    Route::middleware('role:superadmin')->prefix('superadmin')->group(function () {
        Route::view('toko', 'superadmin.toko.index')->name('superadmin.toko.index');
        Route::view('voucher', 'superadmin.voucher.index')->name('superadmin.voucher.index');
        Route::view('transaksi', 'superadmin.transaksi.index')->name('superadmin.transaksi.index');
        Route::view('pembayaran', 'superadmin.pembayaran.index')->name('superadmin.pembayaran.index');
        Route::view('riwayat', 'superadmin.riwayat.index')->name('superadmin.riwayat.index');
    });

    // Routes Admin Toko (hanya role admin)
// Routes Admin Toko (hanya role admin)
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::view('dashboard', 'admin.dashboard.index')->name('admin.dashboard.index');
        Route::view('transaksi', 'admin.transaksi.index')->name('admin.transaksi.index');
        Route::view('pembayaran', 'admin.pembayaran.index')->name('admin.pembayaran.index');
        Route::view('voucher', 'admin.voucher.index')->name('admin.voucher.index');
    });
});