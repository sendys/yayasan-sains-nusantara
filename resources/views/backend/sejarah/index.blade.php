@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Profil';
    $title = 'Kelola Data Profil';
    ?>

    @include('layouts.partials.page-title')
    @include('layouts.partials.preloader')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14">
                        Halaman ini digunakan untuk mengelola data Profil YSN yang ditampilkan di halaman frontend. <br>
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
                            <div class="col-12">
                                <div class="card border-light">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">
                                            <i class="mdi mdi-information me-2"></i>Informasi Profil YSN
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
                                                        rows="4" placeholder="Masukkan deskripsi sejarah yayasan dalam bahasa Indonesia...">{{ old('deskripsi_id', $sejarah->deskripsi_id ?? '') }}</textarea>

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
                                                        rows="4" placeholder="Enter the history description in English...">{{ old('deskripsi_en', $sejarah->deskripsi_en ?? '') }}</textarea>

                                                    @error('deskripsi_en')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ACTION -->
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

    <!-- MODAL DELETE -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

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
@endpush
