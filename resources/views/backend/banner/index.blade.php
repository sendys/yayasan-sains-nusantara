@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Manage Data Banner';
    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Manage Data Banner</h4>
                    <p class="sub-header">
                        Kelola data banner dengan mudah
                    </p>

                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <form method="GET" action="{{ route('admin.banner.index') }}"
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

                                <div class="me-1">
                                    <select class="form-select my-1 my-lg-0" name="is_active" onchange="this.form.submit()">
                                        <option value="">Semua Status</option>
                                        <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Nonaktif
                                        </option>
                                    </select>
                                </div>

                                <div class="me-1">
                                    <div class="position-relative">
                                        <i class="mdi mdi-magnify position-absolute ms-2"
                                            style="top: 50%; transform: translateY(-50%);"></i>
                                        <input type="search" name="search" class="form-control my-1 my-lg-0 ps-4"
                                            placeholder="Search..." value="{{ request('search') }}"
                                            onkeyup="if(this.value.length === 0) this.form.submit()" autofocus>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <div class="text-lg-end my-1 my-lg-0">
                                <a href="{{ route('admin.banner.create') }}"
                                    class="btn btn-primary waves-effect waves-light mb-2">
                                    <i class="mdi mdi-plus me-1"></i>Tambah Banner
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>

                    @if (isset($banners) && $banners->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover table-sm mb-0" id="bannersTable">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">No.</th>
                                        <th style="width: 150px;">Gambar</th>
                                        <th style="width: 100px;">Status</th>
                                        <th style="width: 150px;">Dibuat</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="data-tbody">
                                    <tr id="loading-row">
                                        <td colspan="5" class="text-center">
                                            <div class="spinner-border text-primary m-2" role="status"></div>
                                            <br>Sedang memuat data...</br>
                                        </td>
                                    </tr>

                                    @foreach ($banners as $banner)
                                        <tr class="data-row d-none">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($banner->image)
                                                    <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner"
                                                        class="rounded"
                                                        style="width: 100px; height: 60px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('assets/images/placeholder.jpg') }}" alt="No Image"
                                                        class="rounded"
                                                        style="width: 100px; height: 60px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($banner->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>{{ $banner->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if (!$banner->is_active)
                                                    <form action="{{ route('admin.banner.toggle', $banner) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="button"
                                                            class="btn btn-sm btn-success btn-toggle-banner me-1"
                                                            data-banner-id="{{ $banner->id }}" title="Aktifkan">
                                                            <i class="mdi mdi-check-circle"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                <form action="{{ route('admin.banner.destroy', $banner) }}" method="POST"
                                                    class="delete-banner-form d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete-banner"
                                                        title="Hapus">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                {{-- Pagination if needed --}}
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info" role="alert">
                            <i class="mdi mdi-information me-2"></i>
                            Belum ada data banner. <a href="{{ route('admin.banner.create') }}">Buat banner baru</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show data rows and hide loading row
            setTimeout(function() {
                document.getElementById('loading-row').classList.add('d-none');
                document.querySelectorAll('.data-row').forEach(row => {
                    row.classList.remove('d-none');
                });
            }, 300);

            // Handle toggle banner activation
            document.querySelectorAll('.btn-toggle-banner').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Aktifkan Banner?',
                        text: 'Banner lain akan dinonaktifkan',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Aktifkan!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Handle delete banner
            document.querySelectorAll('.btn-delete-banner').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Hapus Banner?',
                        text: 'Tindakan ini tidak dapat dibatalkan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Hapus!',
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
                Swal.fire('Sukses', '{{ session('success') }}', 'success');
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire('Error', '{{ session('error') }}', 'error');
            });
        </script>
    @endif
@endsection
