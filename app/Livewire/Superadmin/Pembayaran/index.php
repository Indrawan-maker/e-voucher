<?php 

namespace App\Livewire\Superadmin\Pembayaran;

use App\Models\Pembayaran;
use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search   = '';
    public $pembayaran_id;
    public $transaksi_id;
    public $jumlah_bayar;
    
    // Untuk display di modal
    public $selected_transaksi;
    public $total_transaksi = 0;
    public $total_dibayar = 0;
    public $sisa_pembayaran = 0;

    public function render()
    {
        return view('livewire.superadmin.pembayaran.index', [
            'title'       => 'Data Pembayaran',
            'pembayaran'  => Pembayaran::with('transaksi.toko')
                ->whereHas('transaksi.toko', function($q) {
                    $q->where('nama_toko', 'like', '%'.$this->search.'%');
                })
                ->latest()
                ->paginate($this->paginate),
           'transaksis'  => Transaksi::with('toko')
    ->whereIn('status', ['belum_lunas', 'dp'])
    ->orderBy('created_at', 'desc')
    ->get(),
        ]);
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset([
            'pembayaran_id', 
            'transaksi_id', 
            'jumlah_bayar',
            'selected_transaksi',
            'total_transaksi',
            'total_dibayar',
            'sisa_pembayaran'
        ]);
    }

    public function updatedTransaksiId($value)
    {
        if ($value) {
            $transaksi = Transaksi::with('toko', 'pembayarans')->find($value);
            
            if ($transaksi) {
                $this->selected_transaksi = $transaksi->toko->nama_toko;
                $this->total_transaksi    = $transaksi->total;
                $this->total_dibayar      = $transaksi->totalPembayaran();
                $this->sisa_pembayaran    = $transaksi->sisaPembayaran();
            }
        } else {
            $this->selected_transaksi = '';
            $this->total_transaksi    = 0;
            $this->total_dibayar      = 0;
            $this->sisa_pembayaran    = 0;
        }
    }
public function store()
{
    $this->validate([
        'transaksi_id' => 'required|exists:transaksis,id',
        'jumlah_bayar' => 'required|integer|min:1',
    ], [
        'transaksi_id.required' => 'Transaksi harus dipilih',
        'jumlah_bayar.required' => 'Jumlah bayar harus diisi',
        'jumlah_bayar.integer'  => 'Jumlah bayar harus berupa angka',
        'jumlah_bayar.min'      => 'Jumlah bayar minimal 1',
    ]);

    $transaksi = Transaksi::find($this->transaksi_id);
    
    if (!$transaksi) {
        $this->addError('transaksi_id', 'Transaksi tidak ditemukan!');
        return;
    }

    $sisaPembayaran = $transaksi->sisaPembayaran();

    // Validasi: pembayaran tidak boleh melebihi sisa
    if ($this->jumlah_bayar > $sisaPembayaran) {
        $this->addError('jumlah_bayar', 'Jumlah bayar melebihi sisa tagihan!');
        return;
    }

    // Simpan pembayaran
    Pembayaran::create([
        'transaksi_id' => $this->transaksi_id,
        'jumlah_bayar' => $this->jumlah_bayar
    ]);

    // PERBAIKAN: Refresh dulu sebelum ambil total
    $transaksi->refresh();
    $totalDibayar = $transaksi->totalPembayaran();  // ← Langsung ambil, JANGAN + $this->jumlah_bayar
    
    // Update status berdasarkan total yang sudah dibayar
    if ($totalDibayar >= $transaksi->total) {
        $transaksi->update(['status' => 'lunas']);
    } elseif ($totalDibayar > 0) {
        $transaksi->update(['status' => 'dp']);
    } else {
        $transaksi->update(['status' => 'belum_lunas']);
    }

    $this->dispatch('closeCreateModal');
}

    public function edit($id)
    {
        $this->resetValidation();
        $pembayaran = Pembayaran::with('transaksi.toko')->findOrFail($id);

        $this->pembayaran_id      = $pembayaran->id;
        $this->transaksi_id       = $pembayaran->transaksi_id;
        $this->jumlah_bayar       = $pembayaran->jumlah_bayar;
        
        // Info transaksi (hitung ulang sisa jika pembayaran ini dihapus)
        $transaksi = $pembayaran->transaksi;
        $this->selected_transaksi = $transaksi->toko->nama_toko;
        $this->total_transaksi    = $transaksi->total;
        $this->total_dibayar      = $transaksi->totalPembayaran();
        // Sisa sebelum edit = sisa sekarang + pembayaran yang sedang diedit
        $this->sisa_pembayaran    = $transaksi->sisaPembayaran() + $pembayaran->jumlah_bayar;
    }

    public function update()
    {
        $this->validate([
            'transaksi_id' => 'required|exists:transaksis,id',
            'jumlah_bayar' => 'required|integer|min:1',
        ]);

        $pembayaran = Pembayaran::findOrFail($this->pembayaran_id);
        $transaksi = $pembayaran->transaksi;
        
        // Hitung sisa setelah dikurangi pembayaran lama
        $sisaPembayaran = $transaksi->sisaPembayaran() + $pembayaran->jumlah_bayar;

        if ($this->jumlah_bayar > $sisaPembayaran) {
            $this->addError('jumlah_bayar', 'Jumlah bayar melebihi sisa tagihan!');
            return;
        }

        // Update pembayaran
        $pembayaran->update([
            'jumlah_bayar' => $this->jumlah_bayar
        ]);

        // PERBAIKAN: Refresh transaksi untuk dapat total pembayaran terbaru
        $transaksi->refresh();
        $totalDibayar = $transaksi->totalPembayaran();
        
        // Update status
        if ($totalDibayar >= $transaksi->total) {
            $transaksi->update(['status' => 'lunas']);
        } elseif ($totalDibayar > 0) {
            $transaksi->update(['status' => 'dp']);
        } else {
            $transaksi->update(['status' => 'belum_lunas']);
        }

        $this->dispatch('closeEditModal');
    }

    public function confirm($id)
    {
        $pembayaran = Pembayaran::with('transaksi.toko')->findOrFail($id);

        $this->pembayaran_id      = $pembayaran->id;
        $this->selected_transaksi = $pembayaran->transaksi->toko->nama_toko;
        $this->jumlah_bayar       = $pembayaran->jumlah_bayar;
    }

    public function destroy()
    {
        $pembayaran = Pembayaran::findOrFail($this->pembayaran_id);
        $transaksi = $pembayaran->transaksi;
        
        // Hapus pembayaran
        $pembayaran->delete();

        // PERBAIKAN: Refresh transaksi untuk dapat total pembayaran terbaru
        $transaksi->refresh();
        $totalDibayar = $transaksi->totalPembayaran();
        
        // Update status setelah hapus
        if ($totalDibayar >= $transaksi->total) {
            $transaksi->update(['status' => 'lunas']);
        } elseif ($totalDibayar > 0) {
            $transaksi->update(['status' => 'dp']);
        } else {
            $transaksi->update(['status' => 'belum_lunas']);
        }

        $this->dispatch('closeDeleteModal');
    }
}