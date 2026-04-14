@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Forms';
    $title = 'Tambah Data Galeri';
    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Tambah Data Galeri</h4>

                    <form id="galleryForm" method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Galeri <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
                                    <div class="form-text">Deskripsi singkat tentang gambar galeri (opsional)</div>
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
                                    <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select" id="kategori" name="kategori" required>
                                        <option value="" selected>Pilih Kategori</option>
                                        @foreach ($kategoriList as $key => $label)
                                            <option value="{{ $key }}" {{ old('kategori') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                            value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Aktif</label>
                                    </div>
                                    <div class="form-text">Centang untuk menampilkan galeri di website</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#kategori').select2({
                width: '100%',
                placeholder: 'Pilih Kategori'
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
        document.getElementById('galleryForm').addEventListener('submit', function(e) {
            const kategori = document.getElementById('kategori').value;
            const title = document.getElementById('title').value;

            if (!kategori) {
                e.preventDefault();
                Swal.fire('Error', 'Kategori wajib dipilih', 'error');
                return false;
            }

            if (!title.trim()) {
                e.preventDefault();
                Swal.fire('Error', 'Judul galeri wajib diisi', 'error');
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