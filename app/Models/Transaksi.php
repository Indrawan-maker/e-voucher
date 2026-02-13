<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['toko_id', 'total', 'status'];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    public function items()
    {
        return $this->hasMany(TransaksiItem::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }

    // Helper: total yang sudah dibayar
    public function totalPembayaran()
    {
        return $this->pembayarans()->sum('jumlah_bayar');
    }

    // Helper: sisa yang belum dibayar
    public function sisaPembayaran()
    {
        return $this->total - $this->totalPembayaran();
    }
}