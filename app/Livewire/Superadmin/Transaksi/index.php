<?php 

namespace App\Livewire\Superadmin\Transaksi;

use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\Toko;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search   = '';
    public $transaksi_id;
    public $toko_id;
    public $status = 'belum_lunas';
    public $items = [];

    public function mount()
    {
        $this->resetItems();
    }

    public function render()
    {
        return view('livewire.superadmin.transaksi.index', [
            'title'      => 'Data Transaksi',
            'transaksi'  => Transaksi::with('toko')
                ->whereHas('toko', function($q) {
                    $q->where('nama_toko', 'like', '%'.$this->search.'%');
                })
                ->latest()
                ->paginate($this->paginate),
            'tokos'      => Toko::all(),
            'vouchers'   => Voucher::all(),
        ]);
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset(['transaksi_id', 'toko_id', 'status']);
        $this->status = 'belum_lunas';
        $this->resetItems();
    }

    public function resetItems()
    {
        $this->items = [
            [
                'voucher_id' => '',
                'qty'        => 1,
                'harga'      => 0,
                'subtotal'   => 0,
            ]
        ];
    }

    public function addItem()
    {
        $this->items[] = [
            'voucher_id' => '',
            'qty'        => 1,
            'harga'      => 0,
            'subtotal'   => 0,
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function updatedItems($value, $key)
    {
        $parts = explode('.', $key);
        $index = $parts[0];
        $field = $parts[1];

        if ($field == 'voucher_id' && $value) {
            $voucher = Voucher::find($value);
            if ($voucher) {
                $this->items[$index]['harga'] = $voucher->harga;
                $this->items[$index]['subtotal'] = $voucher->harga * $this->items[$index]['qty'];
            }
        }

        if ($field == 'qty') {
            $this->items[$index]['subtotal'] = $this->items[$index]['harga'] * $value;
        }
    }

    public function getTotal()
    {
        return collect($this->items)->sum('subtotal');
    }

    public function store()
    {
        $this->validate([
            'toko_id'              => 'required|exists:tokos,id',
            'status'               => 'required|in:belum_lunas,dp,lunas',
            'items'                => 'required|array|min:1',
            'items.*.voucher_id'   => 'required|exists:vouchers,id',
            'items.*.qty'          => 'required|integer|min:1',
        ], [
            'toko_id.required'            => 'Toko harus dipilih',
            'status.required'             => 'Status harus dipilih',
            'items.required'              => 'Minimal 1 item harus diisi',
            'items.*.voucher_id.required' => 'Voucher harus dipilih',
            'items.*.qty.required'        => 'Qty harus diisi',
            'items.*.qty.min'             => 'Qty minimal 1',
        ]);

        DB::beginTransaction();
        try {
            $total = $this->getTotal();

            $transaksi = Transaksi::create([
                'toko_id' => $this->toko_id,
                'total'   => $total,
                'status'  => $this->status,
            ]);

            foreach ($this->items as $item) {
                TransaksiItem::create([
                    'transaksi_id' => $transaksi->id,
                    'voucher_id'   => $item['voucher_id'],
                    'qty'          => $item['qty'],
                    'harga'        => $item['harga'],
                    'subtotal'     => $item['subtotal']
                ]);
            }

            DB::commit();
            $this->dispatch('closeCreateModal');
            
        } catch (\Exception $e) {
            DB::rollback();
            $this->dispatch('errorWhenCreateUser');
        }
    }

    public function edit($id)
    {
        $this->resetValidation();
        $transaksi = Transaksi::with('items')->findOrFail($id);

        $this->transaksi_id = $transaksi->id;
        $this->toko_id      = $transaksi->toko_id;
        $this->status       = $transaksi->status;
        
        $this->items = [];
        foreach ($transaksi->items as $item) {
            $this->items[] = [
                'voucher_id' => $item->voucher_id,
                'qty'        => $item->qty,
                'harga'      => $item->harga,
                'subtotal'   => $item->subtotal,
            ];
        }
    }

    public function update()
{
    $this->validate([
        'toko_id'              => 'required|exists:tokos,id',
        'status'               => 'required|in:belum_lunas,dp,lunas',
        'items'                => 'required|array|min:1',
        'items.*.voucher_id'   => 'required|exists:vouchers,id',
        'items.*.qty'          => 'required|integer|min:1',
    ]);

    DB::beginTransaction();
    try {
        $transaksi = Transaksi::findOrFail($this->transaksi_id);
        $total = $this->getTotal();

        // Update transaksi
        $transaksi->update([
            'toko_id' => $this->toko_id,
            'total'   => $total,
            'status'  => $this->status,
        ]);

        // Hapus items lama, buat items baru
        $transaksi->items()->delete();

        foreach ($this->items as $item) {
            TransaksiItem::create([
                'transaksi_id' => $transaksi->id,
                'voucher_id'   => $item['voucher_id'],
                'qty'          => $item['qty'],
                'harga'        => $item['harga'],
                'subtotal'     => $item['subtotal']
            ]);
        }

        // PERBAIKAN: Recalculate status berdasarkan pembayaran
        $transaksi->refresh();
        $totalDibayar = $transaksi->totalPembayaran();
        
        if ($totalDibayar >= $transaksi->total) {
            $transaksi->update(['status' => 'lunas']);
        } elseif ($totalDibayar > 0) {
            $transaksi->update(['status' => 'dp']);
        } else {
            $transaksi->update(['status' => 'belum_lunas']);
        }

        DB::commit();
        $this->dispatch('closeEditModal');
        
    } catch (\Exception $e) {
        DB::rollback();
        $this->dispatch('errorWhenEditUser');
    }
}

    public function confirm($id)
    {
        $transaksi = Transaksi::with('toko')->findOrFail($id);

        $this->transaksi_id = $transaksi->id;
        $this->toko_id      = $transaksi->toko->nama_toko;
    }
public function destroy()
{
    $transaksi = Transaksi::findOrFail($this->transaksi_id);
     if ($transaksi->status == 'lunas') {
        session()->flash('error', 'Transaksi yang sudah lunas tidak bisa dihapus!');
        $this->dispatch('errorWhenDeleteTransaksi');
        return;
    }
    $transaksi->pembayarans()->delete();

    
    $transaksi->items()->delete();
    
    $transaksi->delete();

    $this->dispatch('closeDeleteModal');
}
}