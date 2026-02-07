<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('superadmin/toko/index', 'superadmin.toko.index')->name('superadmin.toko.index');
Route::view('superadmin/transaksi/index', 'superadmin.transaksi.index')->name('superadmin.transaksi.index');
Route::view('superadmin/pembayaran/index', 'superadmin.pembayaran.index')->name('superadmin.pembayaran.index');
Route::view('superadmin/laporan/index', 'superadmin.laporan.index')->name('superadmin.laporan.index');
Route::view('superadmin/pengaturan/index', 'superadmin.pengaturan.index')->name('superadmin.pengaturan.index');
