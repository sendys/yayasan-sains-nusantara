@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Manage Data Gudang';
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

                    <h4 class="header-title">Manage Data Gudang</h4>
                    <p class="sub-header">
                        <code style="font-weight: bold; font-size: 15px;">Data Gudang</code> <span
                            style="font-weight: bold; font-size: 12px;">adalah data yang berisi informasi tentang
                            gudang.</span>
                    </p>

                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <form method="GET" action="{{ route('gudang.index') }}"
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
                                        <select class="form-select my-1 my-lg-0 ps-4" id="sort" name="sort"
                                            onchange="this.form.submit()">
                                            <option value="asc" {{ request('sort', 'asc') == 'asc' ? 'selected' : '' }}>
                                                Asc</option>
                                            <option value="desc"
                                                {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>
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
                                <a href="{{ route('gudang.bulk-import') }}"
                                    class="btn btn-success waves-effect waves-light mb-2 me-1" title="Bulk Import dari CSV">
                                    <i class="mdi mdi-upload me-1"></i>Import CSV
                                </a>
                                <a href="{{ route('gudang.create') }}"
                                    class="btn btn-primary waves-effect waves-light mb-2"><i
                                        class="mdi mdi-plus me-1"></i>Add Data Gudang</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <br>

                    @if (isset($gudangs) && $gudangs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover table-sm mb-0" id="rolesTable">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">No.</th>
                                        <th style="width: 200px;">Kode</th>
                                        <th>Nama</th>
                                        <th style="width: 300px;">Update</th>
                                        <th style="width: 100px;"></th>
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

                                    @foreach ($gudangs as $gudang)
                                        <tr class="data-row d-none">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $gudang->kode }}</td>
                                            <td>{{ $gudang->nama }}</td>
                                            <td>{{ $gudang->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('gudang.edit', $gudang->uuid) }}" class="action-icon">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>
                                                <form action="{{ route('gudang.destroy', $gudang->uuid) }}" method="POST"
                                                    class="delete-role-form" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="action-icon btn-delete-role"
                                                        data-role-name="{{ $gudang->name }}" title="Hapus gudang"
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
                            {!! $gudangs->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('pagination::bootstrap-5') !!}

                        </div>
                    @else
                        <div class="text-center p-4">
                            <img src="{{ asset('assets/images/empty.png') }}" height="150" alt="No data">
                            <h4 class="text-muted mt-3">No Records Found</h4>
                            <p class="text-muted">We couldn't find any gudang records. Try adding some new gudangs.</p>
                            <a href="{{ route('gudang.create') }}" class="btn btn-primary btn-sm mt-2">
                                <i class="mdi mdi-plus me-1"></i> Add New Gudang
                            </a>
                        </div>
                    @endif


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>

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
                        html: `Nama Gudang "${roleName}"<br>will be permanently deleted.`,
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
                    position: 'top-right',
                    hideAfter: 3000
                });
            });
        </script>
    @endif
@endsection
