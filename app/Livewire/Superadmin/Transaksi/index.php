namespace App\Livewire\Superadmin\Transaksi;

use Livewire\Component;
use App\Models\Toko;
use App\Models\Voucher;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public $toko_id;
    public $dp = 0;
    public $qty = []; // array: voucher_id => qty

    public function render()
    {
        return view('livewire.superadmin.transaksi.index', [
            'tokos' => Toko::all(),
            'vouchers' => Voucher::all(),
        ]);
    }

    public function store()
    {
        DB::transaction(function () {

            $total = 0;

            $transaksi = Transaksi::create([
                'toko_id' => $this->toko_id,
                'total' => 0,
                'dp' => $this->dp,
                'status_pembayaran' => $this->dp > 0 ? 'dp' : 'belum_lunas'
            ]);

            foreach ($this->qty as $voucherId => $qty) {
                if ($qty > 0) {
                    $voucher = Voucher::find($voucherId);
                    $subtotal = $voucher->harga * $qty;
                    $total += $subtotal;

                    TransaksiItem::create([
                        'transaksi_id' => $transaksi->id,
                        'voucher_id' => $voucherId,
                        'qty' => $qty,
                        'harga' => $voucher->harga,
                        'subtotal' => $subtotal,
                    ]);
                }
            }

            $transaksi->update(['total' => $total]);

            if ($this->dp > 0) {
                Pembayaran::create([
                    'transaksi_id' => $transaksi->id,
                    'jumlah_bayar' => $this->dp
                ]);
            }
        });

        $this->reset();
        $this->dispatch('success');
    }
}
