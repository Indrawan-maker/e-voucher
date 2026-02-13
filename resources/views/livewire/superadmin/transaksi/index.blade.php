<div>
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-exchange-alt mr-1"></i>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="fas fa-home mr-1"></i>Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <i class="fas fa-exchange-alt mr-1"></i>{{ $title }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button wire:click="create" class="btn btn-sm btn-primary"
                                data-toggle="modal" data-target="#createModal">
                                <i class="fas fa-plus mr-1"></i>Tambah Data
                            </button>
                        </div>
                        <div class="btn-group dropleft">
                            <button type="button" class="btn btn-warning btn-sm dropdown-toggle"
                                data-toggle="dropdown">
                                <i class="fas fa-print mr-1"></i>Cetak
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item text-success" href="#">
                                    <i class="fas fa-file-excel mr-1"></i>Excel
                                </a>
                                <a class="dropdown-item text-danger" href="#">
                                    <i class="fas fa-file-pdf mr-1"></i>PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3 d-flex justify-content-between">
                        <div class="col-2">
                            <select wire:model.live="paginate" class="form-control">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input wire:model.live="search" type="text"
                                class="form-control" placeholder="Pencarian...">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Toko</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->toko->nama_toko }}</td>
                                        <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                        <td>
                                            @if($item->status == 'lunas')
                                                <span class="badge badge-success">LUNAS</span>
                                            @elseif($item->status == 'dp')
                                                <span class="badge badge-info">DP</span>
                                            @else
                                                <span class="badge badge-warning">BELUM LUNAS</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <button wire:click="edit({{ $item->id }})"
                                                data-toggle="modal" data-target="#editModal"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button wire:click="confirm({{ $item->id }})"
                                                data-toggle="modal" data-target="#deleteModal"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $transaksi->links() }}
                    </div>
                </div>
            </div>
        </section>

        {{-- CREATE MODAL --}}
        @include('livewire.superadmin.transaksi.create')

        {{-- EDIT MODAL --}}
        @include('livewire.superadmin.transaksi.edit')

        {{-- DELETE MODAL --}}
        @include('livewire.superadmin.transaksi.delete')

        {{-- SCRIPT --}}
        @script
        <script>
            // CREATE
            $wire.on('closeCreateModal', () => {
                $('#createModal').modal('hide');
                Swal.fire("Sukses!", "Transaksi Berhasil Ditambah!", "success");
            });

            $wire.on('errorWhenCreateUser', () => {
                $('#createModal').modal('hide');
                Swal.fire("Gagal!", "Terjadi kesalahan saat menyimpan transaksi!", "error");
            });

            // EDIT
            $wire.on('closeEditModal', () => {
                $('#editModal').modal('hide');
                Swal.fire("Sukses!", "Transaksi Berhasil Diupdate!", "success");
            });

            $wire.on('errorWhenEditUser', () => {
                $('#editModal').modal('hide');
                Swal.fire("Gagal!", "Terjadi kesalahan saat mengupdate transaksi!", "error");
            });

            // DELETE
            $wire.on('closeDeleteModal', () => {
                $('#deleteModal').modal('hide');
                Swal.fire("Sukses!", "Transaksi Berhasil Dihapus!", "success");
            });
        </script>
        @endscript

    </div>
</div>