<?php

namespace App\Livewire\Superadmin\Dashboard;

use Livewire\Component;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public function render()
    {
        // Total Omzet (semua transaksi)
        $totalOmzet = Transaksi::sum('total');

        // Total Piutang (transaksi belum lunas)
        $totalPiutang = Transaksi::where('status', '!=', 'lunas')
            ->get()
            ->sum(function($t) {
                return $t->sisaPembayaran();
            });

        // Transaksi Bulan Ini
        $transaksiBulanIni = Transaksi::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Untung Bersih (total pembayaran yang sudah masuk)
        $untungBersih = Pembayaran::sum('jumlah_bayar');

        return view('livewire.superadmin.dashboard.index', [
            'title' => 'Dashboard',
            'totalOmzet' => $totalOmzet,
            'totalPiutang' => $totalPiutang,
            'transaksiBulanIni' => $transaksiBulanIni,
            'untungBersih' => $untungBersih,
        ]);
    }
}