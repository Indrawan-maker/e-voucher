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
                <div class="row">
                    <label for="nama_toko" class="form-label">Nama Toko</label>
                    <span class="text-danger">*</span>
                    <input wire:model="nama_toko" type="text" class="form-control @error('nama_toko') is-invalid @enderror"
                        placeholder="Masukkan Nama Toko">
                    @error('nama_toko')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row mt-2">
                    <label for="email" class="form-label">Email</label>
                    <span class="text-danger">*</span>

                    <input wire:model="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Masukkan Email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row mt-2">
                    <label for="alamat" class="form-label">Alamat</label>
                    <span class="text-danger">*</span>

                    <input wire:model="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                        placeholder="Masukkan Alamat">
                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row mt-2">
                    <label for="patokan" class="form-label">Patokan</label>
                    <span class="text-danger">*</span>

                    <input wire:model="patokan" type="text" class="form-control @error('patokan') is-invalid @enderror"
                        placeholder="Masukkan Patokan">
                    @error('patokan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row mt-2" x-data="{ show: false }">
                    <label for="password" class="form-label">Password</label>
                    <span class="text-danger">*</span>

                    <input wire:model="password" :type="show ? 'text' : 'password'"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan Password">
                    <button type="button" class="btn btn-sm text-secondary" @click="show = !show">
                        <span x-text="show ? 'hide password' : 'show password'"></span>
                    </button>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row mt-2" x-data="{ show: false }">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <span class="text-danger">*</span>
                    <input wire:model="password_confirmation" :type="show ? 'text' : 'password'"
                        class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Masukkan Password Konfirmasi">
                    <button type="button" class="btn btn-sm text-secondary" @click="show = !show">
                        <span x-text="show ? 'hide password' : 'show password'"></span>
                    </button>
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i
                        class="fas fa-times mr-1"></i>Tutup</button>
                <button wire:click="update({{ $toko_id }})" type="button" class="btn btn-warning btn-sm"><i
                        class="fas fa-edit mr-1"></i>Update</button>
            </div>
        </div>
    </div>
</div>
