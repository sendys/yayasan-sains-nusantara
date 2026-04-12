@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Divisi';
    $title = 'Kelola Data Divisi';
    ?>

    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14">
                        Halaman ini digunakan untuk mengelola data Divisi yang ditampilkan di halaman frontend. <br>
                        Data ini mencakup diskripsi.
                    </p>
                    <hr class="my-1">
                    <br>

                    <form id="divisiForm"
                        action="{{ isset($divisi) ? route('admin.divisi.update', $divisi->id) : route('admin.divisi.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($divisi))
                            @method('PUT')
                        @endif

                        <div class="row">

                            <!-- Form Fields Section -->
                            <div class="col-12">
                                <div class="card border-light">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0"><i class="mdi mdi-information me-2"></i>Informasi Divisi
                                        </h5>
                                    </div>

                                    <div class="card-body">
                                        <!-- Tabs -->
                                        <ul class="nav nav-tabs" id="languageTabs">
                                            <li class="nav-item">
                                                <button type="button" class="nav-link active" data-bs-toggle="tab"
                                                    data-bs-target="#id-content">
                                                    Bahasa Indonesia
                                                </button>
                                            </li>
                                            <li class="nav-item">
                                                <button type="button" class="nav-link" data-bs-toggle="tab"
                                                    data-bs-target="#en-content">
                                                    English
                                                </button>
                                            </li>
                                        </ul>

                                        <div class="tab-content mt-3">

                                            <!-- INDONESIA -->
                                            <div class="tab-pane fade show active" id="id-content">
                                                <div class="mb-4">

                                                    <!-- 🔥 TOMBOL TRANSLATE -->
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <label class="form-label fw-semibold mb-0">
                                                            <i class="mdi mdi-text me-1"></i>Deskripsi (Bahasa Indonesia)
                                                        </label>

                                                        <button type="button" id="btnTranslate"
                                                            class="btn btn-sm btn-success">
                                                            <i class="mdi mdi-translate"></i> Translate
                                                        </button>
                                                    </div>

                                                    <textarea class="form-control tinymce @error('deskripsi_id') is-invalid @enderror" id="deskripsi_id" name="deskripsi_id"
                                                        rows="4" placeholder="Masukkan deskripsi tentang yayasan dalam bahasa Indonesia...">{{ old('deskripsi_id', $divisi->deskripsi_id ?? '') }}</textarea>

                                                    @error('deskripsi_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- ENGLISH -->
                                            <div class="tab-pane fade" id="en-content">
                                                <div class="mb-4">
                                                    <label class="form-label fw-semibold">
                                                        <i class="mdi mdi-text me-1"></i>Description (English)
                                                    </label>

                                                    <textarea class="form-control tinymce @error('deskripsi_en') is-invalid @enderror" id="deskripsi_en" name="deskripsi_en"
                                                        rows="4" placeholder="Enter the history description in English...">{{ old('deskripsi_en', $tentang->deskripsi_en ?? '') }}</textarea>

                                                    @error('deskripsi_en')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Deskripsi -->
                                        {{-- <div class="mb-4">
                                            <label for="deskripsi" class="form-label fw-semibold">
                                                <i class="mdi mdi-text me-1"></i>Deskripsi
                                            </label>
                                            <textarea class="form-control tinymce @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                                rows="4" placeholder="Masukkan deskripsi organisasi...">{{ old('deskripsi', isset($tentang) ? $tentang->deskripsi : '') }}</textarea>
                                            @error('deskripsi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div> --}}

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    @if (isset($divisi))
                                        <button type="button" class="btn btn-outline-danger" id="deleteBtn">
                                            <i class="mdi mdi-delete me-1"></i>Hapus
                                        </button>
                                    @endif
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-content-save me-1"></i>
                                        {{ isset($divisi) ? 'Update' : 'Simpan' }}
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
                    <p>Apakah Anda yakin ingin menghapus data Divisi?</p>
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

{{-- @push('styles')
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
@endpush --}}

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/{{ config('tinymce.api_key') }}/tinymce/7/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: 'textarea.tinymce',
            height: 500,
            menubar: false,

            plugins: 'lists link image table code fontfamily fontsize',

            // 🔥 ini penting
            paste_as_text: true,

            valid_elements: '*[*]',
            cleanup: true,

            toolbar: `
                undo redo |
                fontfamily fontsize |
                bold italic underline |
                alignleft aligncenter alignright |
                bullist numlist |
                link image |
                code
            `,

            // Custom font (optional tapi bagus)
            font_family_formats: `
                Poppins=Poppins,sans-serif;
                Arial=arial,helvetica,sans-serif;
                Times New Roman=times new roman,times;
                Courier New=courier new,courier;
            `,

            // Custom size
            font_size_formats: '10pt 12pt 14pt 16pt 18pt 24pt 32pt',

            content_style: `
                body { font-family: Poppins, sans-serif; font-size: 14px; }
            `
        });
    </script>

    <script>
        $(document).ready(function() {

            function stripHtml(html) {
                let tmp = document.createElement("DIV");
                tmp.innerHTML = html;
                return tmp.textContent || tmp.innerText || "";
            }

            function translateText() {

                let indoText = tinymce.get('deskripsi_id')?.getContent() || '';

                if (!stripHtml(indoText).trim()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops!',
                        text: 'Isi Bahasa Indonesia dulu'
                    });
                    return;
                }

                $('#btnTranslate')
                    .html('⏳ Translating...')
                    .prop('disabled', true);

                $.ajax({
                    url: "{{ route('translate') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        text: indoText
                    },
                    success: function(res) {

                        tinymce.get('deskripsi_en')?.setContent(res.result);
                        /* tinymce.get('deskripsi')?.setContent(res.result); */

                        $('#btnTranslate')
                            .html('✅ Translate')
                            .prop('disabled', false);
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal translate'
                        });

                        $('#btnTranslate')
                            .html('Translate')
                            .prop('disabled', false);
                    }
                });
            }

            // ✅ tombol translate (ANTI SUBMIT)
            $('#btnTranslate').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                translateText();
            });

            // ✅ AUTO TRANSLATE SAAT TAB ENGLISH
            $('button[data-bs-target="#en-content"]').on('shown.bs.tab', function() {

                let enText = tinymce.get('deskripsi_en')?.getContent() || '';

                if (!stripHtml(enText).trim()) {
                    translateText();
                }
            });

        });
    </script>

    <script>
        $(document).ready(function() {

            // Delete Button
            @if (isset($divisi))
                $('#deleteBtn').on('click', function() {
                    $('#deleteForm').attr('action', '{{ route('admin.divisi.destroy', $divisi->id) }}');
                    $('#deleteModal').modal('show');
                });
            @endif

            // Form Submit with AJAX
            $('#divisiForm').on('submit', function(e) {
                e.preventDefault();

                // Sync TinyMCE content to textarea before submit
                if (typeof tinymce !== 'undefined' && tinymce.get('deskripsi_id')) {
                    tinymce.get('deskripsi_id').save();
                }

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
                                    '{{ route('admin.divisi.index') }}';
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
