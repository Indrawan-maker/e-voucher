<!-- Modal -->
<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i class="fas fa-edit mr-1"></i> Edit {{ $title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Toko --}}
                <div class="row">
                    <div class="col-12">
                        <label for="toko_id" class="form-label">Toko <span class="text-danger">*</span></label>
                        <select wire:model="toko_id" class="form-control @error('toko_id') is-invalid @enderror">
                            <option value="">-- Pilih Toko --</option>
                            @foreach($tokos as $toko)
                                <option value="{{ $toko->id }}">{{ $toko->nama_toko }} ({{ $toko->user->email }})</option>
                            @endforeach
                        </select>
                        @error('toko_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Status --}}
                <div class="row mt-2">
                    <div class="col-12">
                        <label for="status" class="form-label">Status Pembayaran <span class="text-danger">*</span></label>
                        <select wire:model="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="belum_lunas">Belum Lunas</option>
                            <option value="dp">DP (Down Payment)</option>
                            <option value="lunas">Lunas</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Items --}}
                <div class="row mt-3">
                    <div class="col-12">
                        <label class="form-label">Detail Items <span class="text-danger">*</span></label>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="30%">Voucher</th>
                                        <th width="20%">Harga</th>
                                        <th width="15%">Qty</th>
                                        <th width="20%">Subtotal</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <select wire:model.live="items.{{ $index }}.voucher_id" 
                                                    class="form-control form-control-sm @error('items.'.$index.'.voucher_id') is-invalid @enderror">
                                                <option value="">-- Pilih --</option>
                                                @foreach($vouchers as $voucher)
                                                    <option value="{{ $voucher->id }}">{{ $voucher->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('items.'.$index.'.voucher_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" 
                                                   value="Rp {{ number_format($item['harga'], 0, ',', '.') }}" 
                                                   class="form-control form-control-sm" 
                                                   readonly>
                                        </td>
                                        <td>
                                            <input wire:model.live="items.{{ $index }}.qty" 
                                                   type="number" 
                                                   min="1"
                                                   class="form-control form-control-sm @error('items.'.$index.'.qty') is-invalid @enderror">
                                            @error('items.'.$index.'.qty')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" 
                                                   value="Rp {{ number_format($item['subtotal'], 0, ',', '.') }}" 
                                                   class="form-control form-control-sm" 
                                                   readonly>
                                        </td>
                                        <td class="text-center">
                                            @if(count($items) > 1)
                                                <button wire:click="removeItem({{ $index }})" 
                                                        type="button" 
                                                        class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-light">
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>TOTAL</strong></td>
                                        <td colspan="2"><strong>Rp {{ number_format($this->getTotal(), 0, ',', '.') }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <button wire:click="addItem" type="button" class="btn btn-sm btn-info mt-2">
                            <i class="fas fa-plus mr-1"></i>Tambah Item
                        </button>
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