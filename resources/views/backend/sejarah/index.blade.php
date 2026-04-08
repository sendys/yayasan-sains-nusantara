@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Deskripsi Sejarah';
    $title = 'Kelola Data Sejarah';
    ?>

    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14">
                        Halaman ini digunakan untuk mengelola data Sejarah YSN yang ditampilkan di halaman frontend. <br>
                        Data ini mencakup Logo, Deskripsi, Visi, dan Misi organisasi.
                    </p>
                    <hr class="my-1">
                    <br>

                    <form id="sejarahForm"
                        action="{{ isset($sejarah) ? route('admin.sejarah.update', $sejarah->id) : route('admin.sejarah.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        @if (isset($sejarah))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <!-- Form Fields Section -->
                            <div class="col-12">
                                <div class="card border-light">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="mdi mdi-information me-2"></i>Informasi Sejarah YSN
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Tabs for Languages -->
                                        <ul class="nav nav-tabs" id="languageTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="id-tab" data-bs-toggle="tab" data-bs-target="#id-content" type="button" role="tab" aria-controls="id-content" aria-selected="true">Bahasa Indonesia</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en-content" type="button" role="tab" aria-controls="en-content" aria-selected="false">English</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content mt-3" id="languageTabsContent">
                                            <!-- Indonesian Tab -->
                                            <div class="tab-pane fade show active" id="id-content" role="tabpanel" aria-labelledby="id-tab">
                                                <div class="mb-4">
                                                    <label for="deskripsi_id" class="form-label fw-semibold">
                                                        <i class="mdi mdi-text me-1"></i>Deskripsi (Bahasa Indonesia)
                                                    </label>
                                                    <textarea class="form-control tinymce @error('deskripsi_id') is-invalid @enderror" id="deskripsi_id" name="deskripsi_id"
                                                        rows="4" placeholder="Masukkan deskripsi sejarah yayasan dalam bahasa Indonesia...">{{ old('deskripsi_id', isset($sejarah) ? $sejarah->deskripsi_id : '') }}</textarea>
                                                    @error('deskripsi_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- English Tab -->
                                            <div class="tab-pane fade" id="en-content" role="tabpanel" aria-labelledby="en-tab">
                                                <div class="mb-4">
                                                    <label for="deskripsi_en" class="form-label fw-semibold">
                                                        <i class="mdi mdi-text me-1"></i>Description (English)
                                                    </label>
                                                    <textarea class="form-control tinymce @error('deskripsi_en') is-invalid @enderror" id="deskripsi_en" name="deskripsi_en"
                                                        rows="4" placeholder="Enter the history description in English...">{{ old('deskripsi_en', isset($sejarah) ? $sejarah->deskripsi_en : '') }}</textarea>
                                                    @error('deskripsi_en')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Default Deskripsi (for backward compatibility) -->
                                        <div class="mb-4">
                                            <label for="deskripsi" class="form-label fw-semibold">
                                                <i class="mdi mdi-text me-1"></i>Deskripsi Default (Fallback)
                                            </label>
                                            <textarea class="form-control tinymce @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                                rows="4" placeholder="Masukkan deskripsi default...">{{ old('deskripsi', isset($sejarah) ? $sejarah->deskripsi : '') }}</textarea>
                                            @error('deskripsi')
                                                <div class="invalid-feedback">{{ $message }}</div>
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
                                    @if (isset($sejarah))
                                        <button type="button" class="btn btn-outline-danger" id="deleteBtn">
                                            <i class="mdi mdi-delete me-1"></i>Hapus
                                        </button>
                                    @endif
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-content-save me-1"></i>
                                        {{ isset($sejarah) ? 'Update' : 'Simpan' }}
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

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/{{ config('tinymce.api_key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin">
    </script>
    <script>
        tinymce.init({
            selector: 'textarea.tinymce',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            menubar: false,
            height: 300,
        });
    </script>

    <script>
        $(document).ready(function() {

            // Delete Button
            @if (isset($sejarah))
                $('#deleteBtn').on('click', function() {
                    $('#deleteForm').attr('action', '{{ route('admin.sejarah.destroy', $sejarah->id) }}');
                    $('#deleteModal').modal('show');
                });
            @endif

            // Form Submit with AJAX
            $('#sejarahForm').on('submit', function(e) {
                e.preventDefault();

                // Sync TinyMCE content to textarea before submit
                if (typeof tinymce !== 'undefined' && tinymce.get('deskripsi')) {
                    tinymce.get('deskripsi').save();
                }

                const formData = new FormData(this);
                const url = $(this).attr('action');

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
                                    '{{ route('admin.sejarah.index') }}';
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error('Error details:', xhr);
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
