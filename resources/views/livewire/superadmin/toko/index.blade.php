<div>
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-store mr-1"></i>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="fas fa-home mr-1"></i>Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <i class="fas fa-store mr-1"></i>{{ $title }}
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
                                    <th>Nama Toko</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Patokan</th>
                                    <th><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($toko as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_toko }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->patokan }}</td>
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
                                @endforeach
                            </tbody>
                        </table>

                        {{ $toko->links() }}
                    </div>
                </div>
            </div>
        </section>

        {{-- CREATE MODAL --}}
        @include('livewire.superadmin.toko.create')

        {{-- EDIT MODAL --}}
        @include('livewire.superadmin.toko.edit')

        {{-- DELETE MODAL --}}
        @include('livewire.superadmin.toko.delete')

        {{-- SCRIPT --}}
        @script
        <script>
            // CREATE
            $wire.on('closeCreateModal', () => {
                $('#createModal').modal('hide');
                Swal.fire("Sukses!", "Data Berhasil Ditambah!", "success");
            });

            $wire.on('errorWhenCreateUser', () => {
                $('#createModal').modal('hide');
                Swal.fire("Gagal!", "Terjadi kesalahan saat menyimpan data!", "error");
            });

            // EDIT
            $wire.on('closeEditModal', () => {
                $('#editModal').modal('hide');
                Swal.fire("Sukses!", "Data Berhasil Diupdate!", "success");
            });

            $wire.on('errorWhenEditUser', () => {
                $('#editModal').modal('hide');
                Swal.fire("Gagal!", "Terjadi kesalahan saat mengupdate data!", "error");
            });

            // DELETE
            $wire.on('closeDeleteModal', () => {
                $('#deleteModal').modal('hide');
                Swal.fire("Sukses!", "Data Berhasil Dihapus!", "success");
            });
        </script>
        @endscript

    </div>
</div>
