<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('superadmin/toko', 'superadmin.toko.index')->name('superadmin.toko.index');
Route::view('superadmin/transaksi', 'superadmin.transaksi.index')->name('superadmin.transaksi.index');
Route::view('superadmin/pembayaran', 'superadmin.pembayaran.index')->name('superadmin.pembayaran.index');
Route::view('superadmin/laporan', 'superadmin.laporan.index')->name('superadmin.laporan.index');
Route::view('superadmin/pengaturan', 'superadmin.pengaturan.index')->name('superadmin.pengaturan.index');
