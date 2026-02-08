<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel"><i class="fas fa-plus mr-1"></i> Tambah {{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
                <label for="nama" class="from-label">Nama Toko</label>
                <input wire:model="nama" type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="fotocopy berkah selalu">
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="row mt-2">
                <label for="email" class="from-label">Email</label>
                <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="rezarahadian123@gmail.com">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Tutup</button>
        <button wire:click="store" type="button" class="btn btn-primary btn-sm"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>