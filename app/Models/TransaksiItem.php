<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    protected $fillable = ['transaksi_id', 'voucher_id', 'qty', 'harga', 'subtotal'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}