<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'transaksi_id',
        'jumlah_bayar'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}

