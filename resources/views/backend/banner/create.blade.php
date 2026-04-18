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
                    <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data"
                        id="bannerForm">
                        @csrf

                        <!-- Upload Image -->
                        <div class="mb-3">
                            <label for="imageInput" class="form-label">Pilih Gambar</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="imageInput"
                                name="image" accept="image/*">
                            @error('image')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">Format: JPG, PNG, GIF, WebP. Ukuran maksimal: 2MB.
                                Rekomendasi: 16:9</small>
                        </div>

                        <!-- Crop Container (Hidden by default) -->
                        <div id="cropContainer" class="mb-3" style="display: none;">
                            <label>Crop Gambar</label>
                            <img id="cropImage" src="" style="max-width: 100%; display: none;">
                        </div>

                        <!-- Hidden input untuk crop data -->
                        <input type="hidden" name="cropData" id="cropData" value="{}">

                        <!-- Preview -->
                        <div class="mb-3">
                            <label>Preview</label>
                            <div id="previewContainer"
                                style="background: #f5f5f5; min-height: 200px; display: none; overflow: hidden; border-radius: 5px;">
                                <img id="previewImage" src="" style="width: 100%; object-fit: cover;">
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div id="cropButtons" style="display: none;" class="mb-3">
                            <button type="button" class="btn btn-info" id="cropBtn">Crop Gambar</button>
                            <button type="button" class="btn btn-secondary" id="resetBtn">Reset</button>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Simpan Banner</button>
                            <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Cropperjs Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <script>
        let cropper = null;
        let isCropped = false;
        const MAX_FILE_SIZE = 2 * 1024 * 1024; // 2MB

        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Validasi tipe file
            const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Format File Tidak Valid',
                    text: 'Format gambar harus JPEG, PNG, GIF, atau WebP',
                    confirmButtonText: 'OK'
                });
                document.getElementById('imageInput').value = '';
                return;
            }

            // Validasi ukuran file
            if (file.size > MAX_FILE_SIZE) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Terlalu Besar',
                    text: 'Ukuran file minimal dibawah 2MB',
                    confirmButtonText: 'OK'
                });
                document.getElementById('imageInput').value = '';
                return;
            }

            const reader = new FileReader();
            reader.onerror = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Membaca File',
                    text: 'Terjadi kesalahan saat membaca file gambar',
                    confirmButtonText: 'OK'
                });
                document.getElementById('imageInput').value = '';
            };

            reader.onload = function(event) {
                const cropImage = document.getElementById('cropImage');
                cropImage.src = event.target.result;
                cropImage.style.display = 'block';

                document.getElementById('cropContainer').style.display = 'block';
                document.getElementById('cropButtons').style.display = 'block';
                document.getElementById('previewContainer').style.display = 'none';
                document.getElementById('submitBtn').disabled = true;
                isCropped = false;

                // Destroy previous cropper
                if (cropper) {
                    cropper.destroy();
                }

                // Initialize new cropper
                cropper = new Cropper(cropImage, {
                    aspectRatio: 16 / 9,
                    viewMode: 1,
                    autoCropArea: 0.8,
                    responsive: true,
                    guides: true,
                    center: true,
                    highlight: true,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: true,
                });
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('cropBtn').addEventListener('click', function() {
            if (!cropper) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Cropper Belum Siap',
                    text: 'Silakan tunggu gambar selesai dimuat',
                    confirmButtonText: 'OK'
                });
                return;
            }

            const canvas = cropper.getCroppedCanvas();
            const previewImage = document.getElementById('previewImage');
            previewImage.src = canvas.toDataURL();

            // Get crop data
            const data = cropper.getData();
            document.getElementById('cropData').value = JSON.stringify({
                x: Math.round(data.x),
                y: Math.round(data.y),
                width: Math.round(data.width),
                height: Math.round(data.height),
            });

            // Hide crop container, show preview
            document.getElementById('cropContainer').style.display = 'none';
            document.getElementById('cropButtons').style.display = 'none';
            document.getElementById('previewContainer').style.display = 'block';
            document.getElementById('submitBtn').disabled = false;
            isCropped = true;

            Swal.fire({
                icon: 'success',
                title: 'Crop Berhasil',
                text: 'Gambar berhasil di-crop. Silakan klik Simpan Banner untuk menyimpan',
                confirmButtonText: 'OK'
            });
        });

        document.getElementById('resetBtn').addEventListener('click', function() {
            document.getElementById('imageInput').value = '';
            document.getElementById('cropContainer').style.display = 'none';
            document.getElementById('cropButtons').style.display = 'none';
            document.getElementById('previewContainer').style.display = 'none';
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('cropData').value = '{}';

            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            isCropped = false;
        });

        // Prevent form submission if crop not done
        document.getElementById('bannerForm').addEventListener('submit', function(e) {
            if (!isCropped) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Crop Gambar Belum Dilakukan',
                    text: 'Silakan crop gambar terlebih dahulu sebelum menyimpan',
                    confirmButtonText: 'OK'
                });
            }
        });

        // Tampilkan error jika ada dari backend
        @if ($errors->any())
            const errorMessages = @json($errors->all());
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                html: errorMessages.join('<br>'),
                confirmButtonText: 'OK'
            });
        @endif
    </script>

    <style>
        #cropImage {
            max-width: 100%;
        }

        .cropper-container {
            max-width: 100%;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
        }
    </style>
@endsection
