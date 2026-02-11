<!-- Modal -->
<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel"><i class="fas fa-trash mr-1"></i>HAPUS {{ $title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        Jenis
                    </div>
                    <div class="col-8">
                        : {{ $jenis }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Harga
                    </div>
                    <div class="col-8">
                        : {{ $harga }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i
                        class="fas fa-times mr-1"></i>Tutup</button>
                <button wire:click="destroy({{ $voucher_id }})" type="button" class="btn btn-danger btn-sm"><i
                        class="fas fa-trash mr-1"></i>HAPUS</button>
            </div>
        </div>
    </div>
</div>
