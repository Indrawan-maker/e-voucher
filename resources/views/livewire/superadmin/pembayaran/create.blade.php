<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel"><i class="fas fa-plus mr-1"></i> Tambah {{ $title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Pilih Transaksi --}}
                <div class="row">
                    <div class="col-12">
                        <label for="transaksi_id" class="form-label">Pilih Transaksi <span class="text-danger">*</span></label>
                        <select wire:model.live="transaksi_id" class="form-control @error('transaksi_id') is-invalid @enderror">
                            <option value="">-- Pilih Transaksi --</option>
                            @foreach($transaksis as $transaksi)
                                <option value="{{ $transaksi->id }}">
                                    {{ $transaksi->toko->nama_toko }} - Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                                    @if($transaksi->status == 'dp')
                                        (DP)
                                    @elseif($transaksi->status == 'belum_lunas')
                                        (Belum Lunas)
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Jumlah transaksi belum lunas: {{ count($transaksis) }}</small>
                        @error('transaksi_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Info Transaksi --}}
                @if($transaksi_id)
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <h6 class="mb-2"><strong>Informasi Transaksi</strong></h6>
                            <p class="mb-1"><strong>Toko:</strong> {{ $selected_transaksi }}</p>
                            <p class="mb-1"><strong>Total Transaksi:</strong> Rp {{ number_format($total_transaksi, 0, ',', '.') }}</p>
                            <p class="mb-1"><strong>Sudah Dibayar:</strong> Rp {{ number_format($total_dibayar, 0, ',', '.') }}</p>
                            <p class="mb-0"><strong>Sisa:</strong> <span class="text-danger">Rp {{ number_format($sisa_pembayaran, 0, ',', '.') }}</span></p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Jumlah Pembayaran --}}
                <div class="row mt-2">
                    <div class="col-12">
                        <label for="jumlah" class="form-label">Jumlah Pembayaran <span class="text-danger">*</span></label>
                        <input wire:model="jumlah_bayar" type="number" 
                               class="form-control @error('jumlah') is-invalid @enderror"
                               placeholder="Masukkan jumlah pembayaran"
                               @if($sisa_pembayaran) max="{{ $sisa_pembayaran }}" @endif>
                        @error('jumlah_bayar')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        @if($sisa_pembayaran)
                            <small class="text-muted">Maksimal: Rp {{ number_format($sisa_pembayaran, 0, ',', '.') }}</small>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>Tutup
                </button>
                <button wire:click="store" type="button" class="btn btn-primary btn-sm">
                    <i class="fas fa-save mr-1"></i>Simpan
                </button>
            </div>
        </div>
    </div>
</div>