<!-- Modal -->
<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i class="fas fa-edit mr-1"></i> Edit {{ $title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Info Transaksi (Read Only) --}}
                <div class="row">
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

                {{-- Jumlah Pembayaran --}}
                <div class="row mt-2">
                    <div class="col-12">
                        <label for="jumlah_bayar" class="form-label">Jumlah Bayar <span class="text-danger">*</span></label>
                        <input wire:model="jumlah_bayar" type="number" 
                               class="form-control @error('jumlah_bayar') is-invalid @enderror"
                               placeholder="Masukkan jumlah bayar"
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
                <button wire:click="update" type="button" class="btn btn-warning btn-sm">
                    <i class="fas fa-save mr-1"></i>Update
                </button>
            </div>
        </div>
    </div>
</div>