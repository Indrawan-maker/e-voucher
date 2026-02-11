<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus mr-1"></i>Tambah {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-2">
                    <label class="form-label">Nama Toko <span class="text-danger">*</span></label>
                    <input wire:model="nama_toko" type="text" 
                        class="form-control @error('nama_toko') is-invalid @enderror"
                        placeholder="Masukkan Nama Toko">
                    @error('nama_toko')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row mt-2">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input wire:model="email" type="email" 
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Masukkan Email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row mt-2">
                    <label class="form-label">Alamat <span class="text-danger">*</span></label>
                    <input wire:model="alamat" type="text" 
                        class="form-control @error('alamat') is-invalid @enderror"
                        placeholder="Masukkan Alamat">
                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row mt-2">
                    <label class="form-label">Patokan</label>
                    <input wire:model="patokan" type="text" 
                        class="form-control @error('patokan') is-invalid @enderror"
                        placeholder="Masukkan Patokan">
                    @error('patokan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row mt-2" x-data="{ show: false }">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <input wire:model="password" :type="show ? 'text' : 'password'"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan Password">
                    <button type="button" class="btn btn-sm text-secondary" @click="show = !show">
                        <span x-text="show ? 'Sembunyikan' : 'Tampilkan'"></span>
                    </button>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row mt-2" x-data="{ show: false }">
                    <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                    <input wire:model="password_confirmation" :type="show ? 'text' : 'password'"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="Masukkan Konfirmasi Password">
                    <button type="button" class="btn btn-sm text-secondary" @click="show = !show">
                        <span x-text="show ? 'Sembunyikan' : 'Tampilkan'"></span>
                    </button>
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
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