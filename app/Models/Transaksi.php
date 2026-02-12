<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'toko_id',
        'total',
        'dp',
        'status_pembayaran'
    ];

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
}
