@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Manage Data Satuan';
    ?>
    @include('layouts.partials.page-title')

    <style>
        .root-row {
            background-color: #e6f0ff;
            /* biru muda */
            font-weight: 600;
            font-weight: bold;
        }
    </style>

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title">Manage Data Satuan</h4>
                    <p class="sub-header">
                        Easily extend form controls by adding text, buttons, or button groups on either side
                        of textual inputs, custom selects, and custom file inputs
                    </p>

                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <form method="GET" action="{{ route('satuan.index') }}"
                                class="d-flex flex-wrap align-items-center">
                                <label for="status-select" class="me-1">Showing</label>
                                <div class="me-1">
                                    <select class="form-select my-1 my-lg-0" name="per_page" onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                        </option>
                                    </select>
                                </div>

                                <label for="status-select"></label>
                                <div class="me-1">
                                    <div class="position-relative">
                                        <i class="mdi mdi-filter position-absolute ms-2"
                                            style="top: 50%; transform: translateY(-50%);"></i>
                                        <select class="form-select my-1 my-lg-0 ps-4" id="sort_dir-select" name="sort_dir"
                                            onchange="this.form.submit()">
                                            <option value="asc" {{ request('sort_dir') == 'asc' ? 'selected' : '' }}>Asc
                                            </option>
                                            <option value="desc" {{ request('sort_dir') == 'desc' ? 'selected' : '' }}>
                                                Desc</option>
                                        </select>
                                    </div>
                                </div>
                                <label for="inputPassword2" class="visually-hidden">Search</label>
                                <div class="me-1">
                                    <div class="position-relative">
                                        <i class="mdi mdi-magnify position-absolute ms-2"
                                            style="top: 50%; transform: translateY(-50%);"></i>
                                        <input type="search" id="search" name="search"
                                            class="form-control my-1 my-lg-0 ps-4" id="inputPassword2"
                                            placeholder="Search..." value="{{ request('search') }}"
                                            onkeyup="if(this.value.length === 0) this.form.submit()" autofocus>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <div class="text-lg-end my-1 my-lg-0">
                                {{--  <a href="{{ route('satuan.trashed') }}"
                                    class="btn btn-warning waves-effect waves-light mb-2 me-1" title="Lihat Data yang Dihapus">
                                    <i class="mdi mdi-delete me-1"></i>Trash
                                </a> --}}
                                <a href="{{ route('satuan.bulk-import') }}"
                                    class="btn btn-success waves-effect waves-light mb-2" title="Bulk Import dari CSV">
                                    <i class="mdi mdi-upload me-1"></i>Import CSV
                                </a>
                                {{--  <a href="{{ route('satuan.create') }}"
                                    class="btn btn-primary waves-effect waves-light mb-2"><i
                                        class="mdi mdi-plus me-1"></i>Add Data Satuan
                                </a> --}}
                                <button class="btn btn-primary waves-effect waves-light mb-2" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#formAddSatuan"
                                    aria-controls="offcanvasScrolling">
                                    <i class="mdi mdi-plus me-1"></i>Add Data Satuan
                                </button>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <br>

                    @if (isset($satuans) && $satuans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover table-sm mb-0" id="rolesTable">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">No.</th>
                                        <th style="width: 200px;">Kode</th>
                                        <th>Nama</th>
                                        <th style="width: 300px;">Pembaharuan</th>
                                        <th style="width: 100px;">Aksi</th>
                                    </tr>
                                </thead>

                                <!-- Satu tbody saja -->
                                <tbody id="data-tbody">
                                    <!-- Spinner loading -->
                                    <tr id="loading-row">
                                        <td colspan="5" class="text-center">
                                            <div class="spinner-border text-success m-2" role="status">
                                                {{-- <img src="{{ asset('assets/images/loading.gif') }}" alt="Loading..." style="width: 40px; height: 40px; margin: 20px auto; display: block;"> --}}
                                            </div>

                                            <br class="mt-2">Sedang memuat data...</br>
                                        </td>
                                    </tr>

                                    @foreach ($satuans as $satuan)
                                        <tr class="data-row d-none">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $satuan->kode }}</td>
                                            <td>{{ $satuan->nama }}</td>
                                            <td>{{ $satuan->updated_at }}</td>
                                            <td>
                                                {{-- <a href="{{ route('satuan.edit', $satuan->uuid) }}" class="action-icon">
                                                    <i class="ti-pencil-alt"></i>
                                                </a> --}}
                                                <a style="background: none; border: none; padding: 0; cursor: pointer; color: inherit;"
                                                    class="action-icon" onclick="editSatuan('{{ $satuan->uuid }}')"
                                                    data-bs-toggle="offcanvas" data-bs-target="#formEditSatuan"
                                                    aria-controls="offcanvasScrolling" title="Edit satuan">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>

                                                <form action="{{ route('satuan.destroy', $satuan->uuid) }}" method="POST"
                                                    class="delete-role-form" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="action-icon btn-delete-role"
                                                        data-role-name="{{ $satuan->nama }}" title="Hapus satuan"
                                                        style="background: none; border: none; padding: 0; cursor: pointer; color: inherit;">

                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            @if (request('per_page') < 10)
                                {!! $satuans->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}
                            @endif
                        </div>
                    @else
                        <div class="text-center p-4">
                            <img src="{{ asset('assets/images/empty.png') }}" height="150" alt="No data">
                            <h4 class="text-muted mt-3">No Records Found</h4>
                            <p class="text-muted">We couldn't find any satuan records. Try adding some new satuans.</p>
                            <a href="{{ route('satuan.create') }}" class="btn btn-primary btn-sm mt-2">
                                <i class="mdi mdi-plus me-1"></i> Add New Satuan
                            </a>
                        </div>
                    @endif


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div>

        <!-- Offcanvas Add Data Satuan-->
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1"
            id="formAddSatuan" aria-labelledby="formAddSatuanLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="formAddSatuanLabel">New Data Satuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <!-- Form inputan -->
                <form method="POST" id="formAddSatuanForm">
                    @csrf
                    <div class="mb-3">
                        <label for="inputNama" class="form-label">Kode</label>
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode"
                            name="kode" value="{{ old('kode') }}" required>
                        @error('kode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="inputNama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>

        <!-- OffCanvas Edit Data Satuan -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="formEditSatuan"
            aria-labelledby="formEditOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="formEditOffcanvasLabel">Edit Data Satuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form method="POST" id="formEditSatuanForm">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editKode" class="form-label">Kode</label>
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" id="editKode"
                            name="kode" readonly>
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="editNama"
                            name="nama" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success w-100">Update</button>
                </form>
            </div>
        </div>
        <!-- End OffCanvas Edit Data Satuan -->
    </div>

    <script>
        $(document).ready(function() {
            $('#formAddSatuanForm').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const url = form.attr('action');
                const formData = form.serialize();
                const submitBtn = form.find('button[type="submit"]');

                submitBtn.prop('disabled', true).text('Menyimpan...');

                $.post(url, formData)
                    .done(function(response) {
                        Swal.fire({
                            title: 'Berhasil',
                            icon: 'success',
                            text: response.message || 'Data berhasil disimpan.'
                        });

                        // Jangan tutup offcanvas, hanya reset form
                        form[0].reset();

                        // Optional: refresh data table atau livewire
                        // $('#datatable').DataTable().ajax.reload();
                        // Livewire.emit('refreshTable');
                    })
                    .fail(function(xhr) {
                        console.log(xhr.responseJSON);

                        let errorMsg = 'Terjadi kesalahan.';
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            const messages = Object.values(errors).map(msg => msg[0]);

                            if (messages.includes("Kode satuan sudah digunakan")) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Duplikat Data',
                                    text: 'Kode satuan sudah digunakan. Silakan gunakan kode lain.'
                                });
                            } else {
                                errorMsg = messages.map(msg => `<li>${msg}</li>`).join('');
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Menyimpan',
                                    html: `<ul class="text-start">${errorMsg}</ul>`
                                });
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan Server',
                                text: 'Terjadi kesalahan pada server.'
                            });
                        }
                    })
                    .always(function() {
                        submitBtn.prop('disabled', false).text('Simpan');
                    });
            });
        });
    </script>

    <!-- Script: Hide spinner, show data rows -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loadingRow = document.getElementById('loading-row');
            const dataRows = document.querySelectorAll('.data-row');

            setTimeout(() => {
                if (loadingRow) loadingRow.remove(); // Remove spinner row
                dataRows.forEach(row => row.classList.remove('d-none')); // Show data
            }, 1000);
        });
    </script>

    {{-- Fungsi Delete --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete-role');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    const roleName = this.getAttribute('data-role-name');
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        html: `Nama Satuan "${roleName}"<br>will be permanently deleted.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <script>
        function editSatuan(uuid) {
            console.log("UUID:", uuid);
            $('#editKode').val('...');
            $('#editNama').val('...');
            $('#formEditSatuanForm').attr('action', '/satuan/' + uuid);

            $.get('/satuan/' + uuid)

                .done(function(satuan) {
                    console.log("Data didapat:", satuan);

                    $('#editKode').val(satuan.kode);
                    $('#editNama').val(satuan.nama);

                    let offcanvas = bootstrap.Offcanvas.getOrCreateInstance('#formEditSatuan');
                    offcanvas.show();
                })
                .fail(function(xhr) {
                    const message = xhr.responseJSON?.message || 'Data tidak ditemukan!';
                    Swal.fire('Gagal', message, 'error');
                });
        }

        // AJAX submit form edit
        $('#formEditSatuanForm').submit(function(e) {
            e.preventDefault();
            const form = $(this);
            const actionUrl = form.attr('action');
            const formData = form.serialize();

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: formData,
                success: function(response) {
                    $('#formEditSatuan').offcanvas('hide');
                    Swal.fire('Berhasil', 'Data berhasil diperbarui.', 'success')
                        .then(() => location.reload()); // Refresh page
                },
                error: function(xhr) {
                    const res = xhr.responseJSON;
                    let errorMessage = 'Gagal memperbarui data.';
                    if (res?.errors) {
                        errorMessage = Object.values(res.errors).join('<br>');
                    }
                    Swal.fire('Gagal', errorMessage, 'error');
                }
            });
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $.toast({
                    heading: 'Success',
                    text: `{!! session('success') !!}`,
                    showHideTransition: 'slide up',
                    icon: 'success',
                    loader: true,
                    loaderBg: '#2ecc71',
                    position: 'top-right',
                    hideAfter: 3000
                });
            });
        </script>
    @endif

    @if (session('errors'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $.toast({
                    heading: 'Duplikat Data',
                    text: `{!! session('errors')->first() !!}`,
                    showHideTransition: 'slide up',
                    icon: 'danger',
                    loader: true,
                    loaderBg: '#e74c3c',
                    bgColor: '#dc3545', // Bootstrap danger color
                    textColor: '#FFFFFF', // White text
                    hideAfter: 4000,
                    position: 'top-right',
                    stack: 6
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $.toast({
                    heading: 'Gagal',
                    text: `{!! session('error') !!}`,
                    showHideTransition: 'slide up',
                    icon: 'danger',
                    loader: true,
                    loaderBg: '#e74c3c',
                    bgColor: '#dc3545', // Bootstrap danger color
                    textColor: '#FFFFFF', // White text
                    position: 'top-right',
                    hideAfter: 3000
                });
            });
        </script>
    @endif

@endsection
