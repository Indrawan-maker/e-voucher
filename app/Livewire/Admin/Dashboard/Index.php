<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use App\Models\TransaksiItem;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public function render()
    {
        $user = Auth::user();
        if (!$user) abort(403);
        
        $toko = $user->toko;
        
        // Total Hutang (sisa pembayaran)
        $totalHutang = Transaksi::where('toko_id', $toko->id)
            ->where('status', '!=', 'lunas')
            ->get()
            ->sum(function($t) {
                return $t->sisaPembayaran();
            });

        // Riwayat Voucher (total qty voucher yang sudah dibeli)
        $totalVoucher = TransaksiItem::whereHas('transaksi', function($q) use ($toko) {
            $q->where('toko_id', $toko->id);
        })->sum('qty');

        // Riwayat Pembayaran (total rupiah yang sudah dibayar)
        $totalPembayaran = Pembayaran::whereHas('transaksi', function($q) use ($toko) {
            $q->where('toko_id', $toko->id);
        })->sum('jumlah_bayar');

        // Status (Lunas vs Belum Lunas)
        $transaksiLunas = Transaksi::where('toko_id', $toko->id)
            ->where('status', 'lunas')
            ->count();
        $transaksiBelumLunas = Transaksi::where('toko_id', $toko->id)
            ->where('status', '!=', 'lunas')
            ->count();

        return view('livewire.admin.dashboard.index', [
            'title' => 'Dashboard',
            'totalHutang' => $totalHutang,
            'totalVoucher' => $totalVoucher,
            'totalPembayaran' => $totalPembayaran,
            'transaksiLunas' => $transaksiLunas,
            'transaksiBelumLunas' => $transaksiBelumLunas,
        ]);
    }
}