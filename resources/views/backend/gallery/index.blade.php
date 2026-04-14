@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Manage Data Galeri';
    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Manage Data Galeri</h4>
                    <p class="sub-header">
                        Kelola data galeri dengan mudah
                    </p>

                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <form method="GET" action="{{ route('admin.gallery.index') }}"
                                class="d-flex flex-wrap align-items-center">
                                <label for="status-select" class="me-1">Showing</label>
                                <div class="me-1">
                                    <select class="form-select my-1 my-lg-0" name="per_page" onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                    </select>
                                </div>

                                <label for="kategori-select" class="me-1">Kategori</label>
                                <div class="me-1">
                                    <select class="form-select my-1 my-lg-0" name="kategori" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        @foreach (\App\Models\Gallery::getKategoriList() as $key => $label)
                                            <option value="{{ $key }}" {{ request('kategori') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="me-1">
                                    <select class="form-select my-1 my-lg-0" name="is_active" onchange="this.form.submit()">
                                        <option value="">Semua Status</option>
                                        <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Nonaktif</option>
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
                                <a href="{{ route('admin.gallery.create') }}"
                                    class="btn btn-primary waves-effect waves-light mb-2">
                                    <i class="mdi mdi-plus me-1"></i>Tambah Galeri
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>

                    @if (isset($galleries) && $galleries->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover table-sm mb-0" id="galleriesTable">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">No.</th>
                                        <th style="width: 100px;">Gambar</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 120px;">Kategori</th>
                                        <th style="width: 100px;">Status</th>
                                        <th style="width: 150px;">Dibuat</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="data-tbody">
                                    <tr id="loading-row">
                                        <td colspan="8" class="text-center">
                                            <div class="spinner-border text-primary m-2" role="status"></div>
                                            <br>Sedang memuat data...</br>
                                        </td>
                                    </tr>

                                    @foreach ($galleries as $gallery)
                                        <tr class="data-row d-none">
                                            <td>{{ $loop->iteration + ($galleries->currentPage() - 1) * $galleries->perPage() }}</td>
                                            <td>
                                                @if ($gallery->image)
                                                    <img src="{{ asset('storage/' . $gallery->image) }}"
                                                        alt="{{ $gallery->title }}" class="rounded"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('assets/images/placeholder.jpg') }}"
                                                        alt="No Image" class="rounded"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td style="max-width:250px; white-space:normal; word-break:break-word;">
                                                {{ $gallery->title }}
                                            </td>
                                            <td style="max-width:250px; white-space:normal; word-break:break-word;">
                                                {{ Str::limit($gallery->deskripsi, 50) }}
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ \App\Models\Gallery::getKategoriList()[$gallery->kategori] ?? $gallery->kategori }}</span>
                                            </td>
                                            <td>
                                                @if ($gallery->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>{{ $gallery->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.gallery.show', $gallery->uuid) }}"
                                                    class="btn btn-sm btn-info me-1" title="Lihat">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>

                                                <a href="{{ route('admin.gallery.edit', $gallery->uuid) }}"
                                                    class="btn btn-sm btn-warning me-1" title="Edit">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>

                                                <form action="{{ route('admin.gallery.destroy', $gallery->uuid) }}"
                                                    method="POST" class="delete-gallery-form d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete-gallery"
                                                        data-gallery-title="{{ $gallery->title }}" title="Hapus">
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
                            {!! $galleries->appends(request()->query())->links('pagination::bootstrap-5') !!}
                        </div>
                    @else
                        <div class="text-center p-4">
                            <img src="{{ asset('assets/images/empty.png') }}" height="150" alt="No data">
                            <h4 class="text-muted mt-3">No Records Found</h4>
                            <p class="text-muted">We couldn't find any gallery records. Try adding some new galleries.</p>
                            <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary btn-sm mt-2">
                                <i class="mdi mdi-plus me-1"></i> Tambah Galeri
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Hide spinner, show data rows
        document.addEventListener("DOMContentLoaded", function() {
            const loadingRow = document.getElementById('loading-row');
            const dataRows = document.querySelectorAll('.data-row');

            setTimeout(() => {
                if (loadingRow) loadingRow.remove();
                dataRows.forEach(row => row.classList.remove('d-none'));
            }, 500);
        });

        // Delete Gallery
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete-gallery');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    const galleryTitle = this.getAttribute('data-gallery-title');
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        html: `Galeri "${galleryTitle}" akan dihapus.`,
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
                Swal.fire('Berhasil', '{{ session('success') }}', 'success');
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