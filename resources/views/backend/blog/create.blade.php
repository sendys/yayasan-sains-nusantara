@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Forms';
    $title = 'Tambah Data Blog';
    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Tambah Data Blog</h4>

                    <form id="blogForm" method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Blog <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="excerpt" class="form-label">Excerpt</label>
                                    <textarea class="form-control" id="excerpt" name="excerpt" rows="2">{{ old('excerpt') }}</textarea>
                                    <div class="form-text">Ringkasan singkat blog (opsional)</div>
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Konten <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="content" name="content" rows="10">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    <div class="form-text">Format: JPG, PNG, GIF, WEBP. Maksimal 2MB.</div>
                                    <div class="mt-2">
                                        <img id="imagePreview" src="#" alt="Preview"
                                            style="max-width: 100%; display: none;" class="img-thumbnail">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="author" class="form-label">Author</label>
                                    <input type="text" class="form-control" id="author" name="author"
                                        value="{{ old('author', auth()->user()->name ?? '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="" selected>Pilih Status</option>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="published_at" class="form-label">Tanggal Publish</label>
                                    <input type="datetime-local" class="form-control" id="published_at" name="published_at"
                                        value="{{ old('published_at') }}" step="1">
                                    <div class="form-text">Format: Tanggal dan waktu (menit). Kosongkan jika ingin diisi otomatis saat publish</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#status').select2({
                width: '100%',
                placeholder: 'Pilih Status'
            });
        });
    </script>

    <script>
        // Preview image before upload
        document.getElementById('image').addEventListener('change', function(e) {
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

        // Form validation
        document.getElementById('blogForm').addEventListener('submit', function(e) {
            const status = document.getElementById('status').value;
            const content = document.getElementById('content').value;

            if (!status) {
                e.preventDefault();
                Swal.fire('Error', 'Status wajib dipilih', 'error');
                return false;
            }

            if (!content.trim()) {
                e.preventDefault();
                Swal.fire('Error', 'Konten blog wajib diisi', 'error');
                return false;
            }
        });
    </script>

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire('Error', '{{ session('error') }}', 'error');
            });
        </script>
    @endif
@endsection
