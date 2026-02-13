<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('superadmin/toko', 'superadmin.toko.index')->name('superadmin.toko.index');
Route::view('superadmin/transaksi', 'superadmin.transaksi.index')->name('superadmin.transaksi.index');
Route::view('superadmin/pembayaran', 'superadmin.pembayaran.index')->name('superadmin.pembayaran.index');
Route::view('superadmin/voucher', 'superadmin.voucher.index')->name('superadmin.voucher.index');
Route::view('superadmin/riwayat', 'superadmin.riwayat.index')->name('superadmin.riwayat.index');
