<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public function render()
    {
        $user = Auth::user();
        if (!$user) abort(403);
        
        $toko = $user->toko;
        
        $totalTransaksi = Transaksi::where('toko_id', $toko->id)->count();
        $totalPembayaran = Pembayaran::whereHas('transaksi', function($q) use ($toko) {
            $q->where('toko_id', $toko->id);
        })->sum('jumlah_bayar');
        $totalOmzet = Transaksi::where('toko_id', $toko->id)->sum('total');
        $transaksiLunas = Transaksi::where('toko_id', $toko->id)->where('status', 'lunas')->count();

        return view('livewire.admin.dashboard.index', [
            'title' => 'Dashboard',
            'totalTransaksi' => $totalTransaksi,
            'totalPembayaran' => $totalPembayaran,
            'totalOmzet' => $totalOmzet,
            'transaksiLunas' => $transaksiLunas,
        ]);
    }
}