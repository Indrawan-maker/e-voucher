<?php

namespace App\Livewire\Admin\Pembayaran;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pembayaran as PembayaranModel;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search = '';

    public function render()
    {
        $user = Auth::user();
        if (!$user) abort(403);
        
        $toko = $user->toko;
        
        return view('livewire.admin.pembayaran.index', [
            'title' => 'Pembayaran',
            'pembayarans' => PembayaranModel::whereHas('transaksi', function($q) use ($toko) {
                $q->where('toko_id', $toko->id);
            })
            ->with('transaksi')
            ->latest()
            ->paginate($this->paginate),
        ]);
    }
}