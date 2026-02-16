<?php

namespace App\Livewire\Admin\Transaksi;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaksi as TransaksiModel;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search = '';
    public $transaksi_id;

    public function render()
    {
        $user = Auth::user();
        if (!$user) abort(403);
        
        $toko = $user->toko;
        
        return view('livewire.admin.transaksi.index', [
            'title' => 'Transaksi',
            'transaksis' => TransaksiModel::where('toko_id', $toko->id)
                ->with('items.voucher')
                ->latest()
                ->paginate($this->paginate),
        ]);
    }

    public function detail($id)
    {
        $this->transaksi_id = $id;
    }
}