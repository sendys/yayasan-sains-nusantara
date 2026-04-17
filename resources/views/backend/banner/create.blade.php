@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Forms';
    $title = 'Tambah Data Banner';
    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Tambah Data Banner</h4>

                    <form id="bannerForm" method="POST" action="{{ route('admin.banner.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar Banner <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" accept="image/*" required>
                                    <div class="form-text">Format: JPG, PNG, GIF, WEBP. Maksimal 2MB. Resolusi rekomendasi:
                                        1920x600px</div>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2">
                                        <img id="imagePreview" src="#" alt="Preview"
                                            style="max-width: 100%; display: none;" class="img-thumbnail">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                            value="1" {{ old('is_active', false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Aktif</label>
                                    </div>
                                    <div class="form-text">Centang untuk menampilkan banner di website</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
        document.getElementById('bannerForm').addEventListener('submit', function(e) {
            const image = document.getElementById('image').value;

            if (!image.trim()) {
                e.preventDefault();
                Swal.fire('Error', 'Gambar banner wajib dipilih', 'error');
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
