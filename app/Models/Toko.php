<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Toko extends Model
{
    protected $fillable = [
        'user_id',
        'nama_toko',
        'alamat',
        'patokan',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
