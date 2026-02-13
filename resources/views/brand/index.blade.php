@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Manage Data Brand';
    ?>
    @include('layouts.partials.page-title')

    <style>
        .root-row {
            background-color: #e6f0ff;
            font-weight: 600;
            font-weight: bold;
        }
    </style>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Manage Data Brand</h4>
                    <p class="sub-header">
                        Kelola data brand dengan mudah termasuk upload logo dan import CSV
                    </p>

                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <form method="GET" action="{{ route('brand.index') }}"
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

                                <label for="status-select" class="me-1">Status</label>
                                <div class="me-1">
                                    <select class="form-select my-1 my-lg-0" name="is_active" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Tidak
                                            Aktif</option>
                                    </select>
                                </div>

                                <div class="me-1">
                                    <div class="position-relative">
                                        <i class="mdi mdi-filter position-absolute ms-2"
                                            style="top: 50%; transform: translateY(-50%);"></i>
                                        <select class="form-select my-1 my-lg-0 ps-4" name="sort_dir"
                                            onchange="this.form.submit()">
                                            <option value="asc" {{ request('sort_dir') == 'asc' ? 'selected' : '' }}>Asc
                                            </option>
                                            <option value="desc" {{ request('sort_dir') == 'desc' ? 'selected' : '' }}>
                                                Desc</option>
                                        </select>
                                    </div>
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
                                <button class="btn btn-success waves-effect waves-light mb-2 me-1" data-bs-toggle="modal"
                                    data-bs-target="#bulkImportModal">
                                    <i class="mdi mdi-upload me-1"></i>Import CSV
                                </button>
                                <button class="btn btn-primary waves-effect waves-light mb-2" data-bs-toggle="modal"
                                    data-bs-target="#addBrandModal">
                                    <i class="mdi mdi-plus me-1"></i>Add Data Brand
                                </button>
                            </div>
                        </div>
                    </div>
                    <br>

                    @if (isset($brands) && $brands->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover table-sm mb-0" id="brandsTable">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">No.</th>
                                        <th style="width: 100px;">Logo</th>
                                        <th>Nama Brand</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 100px;">Status</th>
                                        <th style="width: 200px;">Pembaharuan</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="data-tbody">
                                    <tr id="loading-row">
                                        <td colspan="7" class="text-center">
                                            <div class="spinner-border text-success m-2" role="status"></div>
                                            <br class="mt-2">Sedang memuat data...</br>
                                        </td>
                                    </tr>

                                    @foreach ($brands as $brand)
                                        <tr class="data-row d-none">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                               {{-- {{ dd($brand->logo_url) }} --}}
                                                <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->nama }}>
                                                    class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                            </td>
                                            <td>{{ $brand->nama }}</td>
                                            <td>{{ Str::limit($brand->deskripsi, 50) }}</td>
                                            <td>
                                                <span class="badge {{ $brand->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $brand->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                                </span>
                                            </td>
                                            <td>{{ $brand->updated_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-info me-1"
                                                    onclick="uploadImage('{{ $brand->uuid }}')" data-bs-toggle="modal"
                                                    data-bs-target="#uploadImageModal" title="Upload Logo">
                                                    <i class="mdi mdi-camera"></i>
                                                </button>

                                                <button class="btn btn-sm btn-warning me-1"
                                                    onclick="editBrand('{{ $brand->uuid }}')" data-bs-toggle="modal"
                                                    data-bs-target="#editBrandModal" title="Edit Brand">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </button>

                                                <form action="{{ route('brand.destroy', $brand->uuid) }}" method="POST"
                                                    class="delete-brand-form d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete-brand"
                                                        data-brand-name="{{ $brand->nama }}" title="Hapus Brand">
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
                            {!! $brands->appends(request()->query())->links('pagination::bootstrap-5') !!}
                        </div>
                    @else
                        <div class="text-center p-4">
                            <img src="{{ asset('assets/images/empty.png') }}" height="150" alt="No data">
                            <h4 class="text-muted mt-3">No Records Found</h4>
                            <p class="text-muted">We couldn't find any brand records. Try adding some new brands.</p>
                            <button class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal"
                                data-bs-target="#addBrandModal">
                                <i class="mdi mdi-plus me-1"></i> Add New Brand
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Brand -->
    <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBrandModalLabel">Tambah Data Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addBrandForm">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Brand</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" id="isActive" name="is_active"
                                    value="1">
                                <label class="form-check-label" for="isActive">
                                    Status Aktif
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="submitAddForm()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Brand -->
    <div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBrandModalLabel">Edit Data Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBrandForm">
                        <input type="hidden" id="editBrandUuid" name="uuid">

                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama Brand</label>
                            <input type="text" class="form-control" id="editNama" name="nama" required>
                        </div>

                        <div class="mb-3">
                            <label for="editDeskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="editDeskripsi" name="deskripsi"></textarea>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="editIsActive" name="is_active">
                            <label class="form-check-label" for="editIsActive">Aktif</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="submitEditForm()">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Upload Image -->
    <div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadImageModalLabel">Upload Logo Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="uploadImageForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="uploadBrandUuid">
                        <div class="mb-3">
                            <label for="logo" class="form-label">Pilih Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*"
                                required>
                            <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB.</div>
                        </div>
                        <div class="mb-3">
                            <img id="imagePreview" src="#" alt="Preview"
                                style="max-width: 200px; display: none;" class="img-thumbnail">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="submitUploadForm()">Upload</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Bulk Import -->
    <div class="modal fade" id="bulkImportModal" tabindex="-1" aria-labelledby="bulkImportModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bulkImportModalLabel">Import Data Brand dari CSV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bulkImportForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="csv_file" class="form-label">Pilih File CSV</label>
                            <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv"
                                required>
                            <div class="form-text">Format: CSV. Maksimal 2MB.</div>
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('brand.download-template') }}" class="btn btn-outline-info btn-sm">
                                <i class="mdi mdi-download"></i> Download Template CSV
                            </a>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="submitBulkImportForm()">Import</button>
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
            }, 1000);
        });

        // Add Brand Form
        function submitAddForm() {
            const form = document.getElementById('addBrandForm');
            const formData = new FormData(form);

            fetch('{{ route('brand.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json', // Pastikan server tahu kita mengharapkan JSON
                        'X-Requested-With': 'XMLHttpRequest' // Menandai sebagai AJAX request
                    }
                })
                .then(response => {
                    // Log response untuk debugging
                    console.log('Response status:', response.status);
                    console.log('Response headers:', response.headers.get('content-type'));

                    // Cek apakah response adalah JSON
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        // Jika bukan JSON, ambil sebagai text untuk debugging
                        return response.text().then(text => {
                            console.error('Server returned non-JSON response:', text);
                            throw new Error('Server mengembalikan response yang tidak valid');
                        });
                    }

                    if (!response.ok) {
                        return response.json().then(err => Promise.reject(err));
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire('Berhasil', data.message, 'success').then(() => {
                            location.reload();
                        });
                        bootstrap.Modal.getInstance(document.getElementById('addBrandModal')).hide();
                    }
                })
                .catch(error => {
                    console.error('Error details:', error);
                    if (error.errors) {
                        let errorMessage = '';
                        Object.values(error.errors).forEach(messages => {
                            messages.forEach(message => {
                                errorMessage += message + '\n';
                            });
                        });
                        Swal.fire('Error Validasi', errorMessage, 'error');
                    } else {
                        Swal.fire('Error', error.message || 'Terjadi kesalahan pada server', 'error');
                    }
                });
        }

        // Edit Brand
        function editBrand(uuid) {
            document.getElementById('editBrandUuid').value = uuid;

            fetch(`/brand/${uuid}`)
                .then(response => response.json())
                .then(brand => {
                    document.getElementById('editNama').value = brand.nama;
                    document.getElementById('editDeskripsi').value = brand.deskripsi || '';
                    document.getElementById('editIsActive').checked = brand.is_active;
                })
                .catch(error => {
                    Swal.fire('Error', 'Gagal memuat data brand', 'error');
                });
        }

        function submitEditForm() {
            const uuid = document.getElementById('editBrandUuid').value;
            const form = document.getElementById('editBrandForm');
            const formData = new FormData(form);

            // Debug: Log data yang akan dikirim
            console.log('UUID:', uuid);
            console.log('Form data:', Object.fromEntries(formData));

            // Tambahkan method _method untuk Laravel mengenali sebagai PUT request
            formData.append('_method', 'PUT');

            fetch(`/brand/${uuid}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest', // Penting untuk deteksi AJAX
                        'Accept': 'application/json' // Meminta response JSON
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    console.log('Response headers:', response.headers);

                    // Periksa apakah response adalah JSON
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        return response.text().then(text => {
                            console.error('Non-JSON response:', text);
                            throw new Error('Server mengembalikan response non-JSON. Response: ' + text
                                .substring(0, 200));
                        });
                    }

                    if (!response.ok) {
                        return response.json().then(data => {
                            throw new Error(data.message || 'HTTP Error: ' + response.status);
                        });
                    }

                    return response.json();
                })
                .then(data => {
                    console.log('Success response:', data);
                    if (data.status === 'success') {
                        Swal.fire('Berhasil', data.message, 'success').then(() => {
                            location.reload();
                        });
                        bootstrap.Modal.getInstance(document.getElementById('editBrandModal')).hide();
                    } else if (data.status === 'error') {
                        Swal.fire('Error', data.message, 'error');
                    } else {
                        Swal.fire('Warning', 'Response tidak dikenali: ' + JSON.stringify(data), 'warning');
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    Swal.fire('Error', 'Error: ' + error.message, 'error');
                });
        }

        // Upload Image
        function uploadImage(uuid) {
            document.getElementById('uploadBrandUuid').value = uuid;
        }

        // Preview image before upload
        document.getElementById('logo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        function submitUploadForm() {
            const uuid = document.getElementById('uploadBrandUuid').value;
            const form = document.getElementById('uploadImageForm');
            const formData = new FormData(form);

            fetch(`/brand/${uuid}/upload-image`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        Swal.fire('Berhasil', data.message, 'success').then(() => {
                            location.reload();
                        });
                        bootstrap.Modal.getInstance(document.getElementById('uploadImageModal')).hide();
                    }
                })
                .catch(error => {
                    Swal.fire('Error', 'Terjadi kesalahan saat upload', 'error');
                });
        }

        // Bulk Import
        function submitBulkImportForm() {
            const form = document.getElementById('bulkImportForm');
            const formData = new FormData(form);

            fetch('{{ route('brand.process-bulk-import') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire('Berhasil', data.message, 'success').then(() => {
                            location.reload();
                        });
                        bootstrap.Modal.getInstance(document.getElementById('bulkImportModal')).hide();
                    }
                })
                .catch(error => {
                    Swal.fire('Error', 'Terjadi kesalahan saat import', 'error');
                });
        }

        // Delete Brand
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete-brand');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    const brandName = this.getAttribute('data-brand-name');
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        html: `Brand "${brandName}" akan dihapus.`,
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
