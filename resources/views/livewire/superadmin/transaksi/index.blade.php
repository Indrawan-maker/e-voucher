<div>
    <h3>Buat Transaksi</h3>

    <div>
        <label>Toko</label>
        <select wire:model="toko_id">
            <option value="">-- pilih toko --</option>
            @foreach ($tokos as $toko)
                <option value="{{ $toko->id }}">
                    {{ $toko->nama_toko }}
                </option>
            @endforeach
        </select>
    </div>

    <hr>

    <h4>Voucher</h4>
    @foreach ($vouchers as $voucher)
        <div>
            <label>
                {{ $voucher->nama }} (Rp {{ number_format($voucher->harga) }})
            </label>
            <input 
                type="number" 
                min="0"
                wire:model="qty.{{ $voucher->id }}">
        </div>
    @endforeach

    <hr>

    <div>
        <label>DP</label>
        <input type="number" wire:model="dp">
    </div>

    <button wire:click="store">
        Simpan Transaksi
    </button>

    <script>
        Livewire.on('success', () => {
            alert('Transaksi berhasil disimpan');
        });
    </script>
</div>
