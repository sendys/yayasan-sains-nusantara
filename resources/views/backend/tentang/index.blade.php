@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tentang Kami';
    $title = 'Kelola Data Tentang Kami';
    ?>

    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14">
                        Halaman ini digunakan untuk mengelola data Tentang Kami yang ditampilkan di halaman frontend. <br>
                        Data ini mencakup Logo, Deskripsi, Visi, dan Misi organisasi.
                    </p>
                    <hr class="my-1">
                    <br>

                    <form id="tentangForm"
                        action="{{ isset($tentang) ? route('admin.tentang.update', $tentang->id) : route('admin.tentang.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($tentang))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <!-- Logo Section -->
                            <div class="col-md-4 mb-4">
                                <div class="card border-light">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="mdi mdi-image me-2"></i>Logo Organisasi</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            @if (isset($tentang) && $tentang->logo)
                                                <img id="logoPreview" src="{{ asset('storage/' . $tentang->logo) }}"
                                                    alt="Logo" class="img-fluid rounded" style="max-height: 200px;">
                                            @else
                                                <img id="logoPreview" src="{{ asset('assets/fe/images/about/logo.png') }}"
                                                    alt="Preview" class="img-fluid rounded d-none"
                                                    style="max-height: 200px;">
                                                <div id="logoPlaceholder"
                                                    class="border rounded d-flex align-items-center justify-content-center"
                                                    style="height: 200px; background-color: #f8f9fa;">
                                                    <span class="text-muted">Tidak ada logo</span>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                            id="logo" name="logo" accept="image/jpeg,image/png,image/jpg,image/gif">
                                        <small class="text-muted">Format: JPG, PNG, GIF. Maks: 2MB</small>
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Form Fields Section -->
                            <div class="col-md-8 mb-4">
                                <div class="card border-light">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="mdi mdi-information me-2"></i>Informasi Organisasi</h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Deskripsi -->
                                        <div class="mb-4">
                                            <label for="deskripsi" class="form-label fw-semibold">
                                                <i class="mdi mdi-text me-1"></i>Deskripsi
                                            </label>
                                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4"
                                                placeholder="Masukkan deskripsi organisasi...">{{ old('deskripsi', isset($tentang) ? $tentang->deskripsi : '') }}</textarea>
                                            @error('deskripsi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Visi -->
                                        <div class="mb-4">
                                            <label for="visi" class="form-label fw-semibold">
                                                <i class="mdi mdi-eye me-1"></i>Visi
                                            </label>
                                            <textarea class="form-control @error('visi') is-invalid @enderror" id="visi" name="visi" rows="3"
                                                placeholder="Masukkan visi organisasi...">{{ old('visi', isset($tentang) ? $tentang->visi : '') }}</textarea>
                                            @error('visi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Misi -->
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">
                                                <i class="mdi mdi-bullseye me-1"></i>Misi
                                            </label>
                                            <div id="misiContainer">
                                                @php
                                                    $misiList = old(
                                                        'misi',
                                                        isset($tentang) && $tentang->misi ? $tentang->misi : [''],
                                                    );
                                                @endphp
                                                @foreach ($misiList as $index => $misi)
                                                    <div class="misi-item mb-2">
                                                        <div class="input-group">
                                                            <span
                                                                class="input-group-text bg-light">{{ $loop->iteration }}</span>
                                                            <input type="text"
                                                                class="form-control @error('misi.' . $index) is-invalid @enderror"
                                                                name="misi[]" value="{{ $misi }}"
                                                                placeholder="Masukkan misi organisasi...">
                                                            @if (!$loop->first)
                                                                <button type="button"
                                                                    class="btn btn-outline-danger remove-misi"
                                                                    title="Hapus">
                                                                    <i class="mdi mdi-close"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                        @error('misi.' . $index)
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="button" id="addMisi"
                                                class="btn btn-outline-primary btn-sm mt-2">
                                                <i class="mdi mdi-plus me-1"></i>Tambah Misi
                                            </button>
                                            @error('misi')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    @if (isset($tentang))
                                        <button type="button" class="btn btn-outline-danger" id="deleteBtn">
                                            <i class="mdi mdi-delete me-1"></i>Hapus
                                        </button>
                                    @endif
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-content-save me-1"></i>
                                        {{ isset($tentang) ? 'Update' : 'Simpan' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data Tentang Kami?</p>
                    <p class="text-muted small">Data akan dihapus secara soft delete dan dapat dipulihkan nanti.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .misi-item .input-group {
            transition: all 0.3s ease;
        }

        .misi-item:hover .input-group {
            box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.15);
        }

        .remove-misi:hover {
            background-color: #dc3545;
            color: white;
        }

        #logoPreview {
            transition: opacity 0.3s ease;
        }

        .card {
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Logo Preview
            $('#logo').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#logoPreview').attr('src', e.target.result).removeClass('d-none');
                        $('#logoPlaceholder').addClass('d-none');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Add Misi
            let misiCount = $('#misiContainer .misi-item').length;

            $('#addMisi').on('click', function() {
                misiCount++;
                var newMisi = '<div class="misi-item mb-2">' +
                    '<div class="input-group">' +
                    '<span class="input-group-text bg-light">' + misiCount + '</span>' +
                    '<input type="text" class="form-control" name="misi[]" placeholder="Masukkan misi organisasi...">' +
                    '<button type="button" class="btn btn-outline-danger remove-misi" title="Hapus">' +
                    '<i class="mdi mdi-close"></i>' +
                    '</button>' +
                    '</div>' +
                    '</div>';
                $('#misiContainer').append(newMisi);
                updateMisiNumbers();
            });

            // Remove Misi
            $(document).on('click', '.remove-misi', function() {
                $(this).closest('.misi-item').fadeOut(300, function() {
                    $(this).remove();
                    updateMisiNumbers();
                });
            });

            // Update Misi Numbers
            function updateMisiNumbers() {
                $('#misiContainer .misi-item').each(function(index) {
                    $(this).find('.input-group-text').text(index + 1);
                });
                misiCount = $('#misiContainer .misi-item').length;
            }

            // Delete Button
            @if (isset($tentang))
                $('#deleteBtn').on('click', function() {
                    $('#deleteForm').attr('action', '{{ route('admin.tentang.destroy', $tentang->id) }}');
                    $('#deleteModal').modal('show');
                });
            @endif

            // Form Submit with AJAX
            $('#tentangForm').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const url = $(this).attr('action');
                const method = $(this).find('input[name="_method"]').val() || 'POST';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href =
                                    '{{ route('admin.tentang.index') }}';
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMessages = '';
                            $.each(errors, function(key, value) {
                                errorMessages += value[0] + '\n';
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal!',
                                text: errorMessages
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON?.message ||
                                    'Terjadi kesalahan saat menyimpan data.'
                            });
                        }
                    }
                });
            });

            // Delete Form Submit
            $('#deleteForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.message ||
                                'Terjadi kesalahan saat menghapus data.'
                        });
                    }
                });
            });
        });
    </script>
@endpush
