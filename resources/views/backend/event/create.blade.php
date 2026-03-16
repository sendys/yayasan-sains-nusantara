@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Forms';
    $title = 'Tambah Data Event';
    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Tambah Data Event</h4>

                    <form id="eventForm" method="POST" action="{{ route('admin.event.store') }}" enctype="multipart/form-data"
                        novalidate>
                        @csrf

                        <div class="row">
                            <div class="col-lg-8">
                                <!-- Title Field -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Event <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title') }}" required maxlength="255"
                                        placeholder="Masukkan judul event">
                                    @error('title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description Field -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="3" maxlength="500" placeholder="Deskripsi singkat event">{{ old('description') }}</textarea>
                                    <div class="form-text">Deskripsi singkat event (opsional, maksimal 500 karakter)</div>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Content Field -->
                                <div class="mb-3">
                                    <label for="content" class="form-label">Konten Lengkap</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10"
                                        placeholder="Konten detail event">{{ old('content') }}</textarea>
                                    <div class="form-text">Konten detail event (opsional)</div>
                                    @error('content')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Sidebar -->
                            <div class="col-12 col-lg-4">
                                <!-- Image Field -->
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" accept="image/*">
                                    <div class="form-text">Format: JPG, PNG, GIF, WEBP. Maksimal 2MB.</div>
                                    <div class="mt-2">
                                        <img id="imagePreview" src="#" alt="Preview gambar event"
                                            style="max-width: 100%; display: none;" class="img-thumbnail">
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Event Date Field -->
                                <div class="mb-3">
                                    <label for="event_date" class="form-label">Tanggal & Waktu Event <span
                                            class="text-danger">*</span></label>
                                    <input type="datetime-local"
                                        class="form-control @error('event_date') is-invalid @enderror" id="event_date"
                                        name="event_date" value="{{ old('event_date') }}" step="1">
                                    @error('event_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Location Field -->
                                <div class="mb-3">
                                    <label for="location" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        id="location" name="location" value="{{ old('location') }}"
                                        placeholder="Contoh: Auditorium, Jakarta" maxlength="255">
                                    @error('location')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Category Field -->
                                <div class="mb-3">
                                    <label for="category" class="form-label">Kategori</label>
                                    <input type="text" class="form-control @error('category') is-invalid @enderror"
                                        id="category" name="category" value="{{ old('category') }}"
                                        placeholder="Contoh: Seminar, Workshop" maxlength="100">
                                    @error('category')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Registration Link Field -->
                                <div class="mb-3">
                                    <label for="registration_link" class="form-label">Link Pendaftaran</label>
                                    <input type="url"
                                        class="form-control @error('registration_link') is-invalid @enderror"
                                        id="registration_link" name="registration_link"
                                        value="{{ old('registration_link') }}" placeholder="https://example.com">
                                    @error('registration_link')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Max Participants Field -->
                                <div class="mb-3">
                                    <label for="max_participants" class="form-label">Maksimal Peserta</label>
                                    <input type="number"
                                        class="form-control @error('max_participants') is-invalid @enderror"
                                        id="max_participants" name="max_participants"
                                        value="{{ old('max_participants') }}" min="1"
                                        placeholder="Kosongkan jika tidak terbatas">
                                    <div class="form-text">Jumlah peserta maksimal (opsional)</div>
                                    @error('max_participants')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status Field -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="" selected>Pilih Status</option>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft
                                        </option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                                            Published</option>
                                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Publish Date Field -->
                                <div class="mb-3">
                                    <label for="published_at" class="form-label">Tanggal Publish</label>
                                    <input type="datetime-local"
                                        class="form-control @error('published_at') is-invalid @enderror"
                                        id="published_at" name="published_at" value="{{ old('published_at') }}"
                                        step="1">
                                    <div class="form-text">Format: Tanggal dan waktu. Kosongkan jika ingin diisi otomatis
                                        saat publish</div>
                                    @error('published_at')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save me-1"></i>Simpan
                                </button>
                                <a href="{{ route('admin.event.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-close me-1"></i>Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#status').select2({
                width: '100%',
                placeholder: 'Pilih Status'
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            const maxFileSize = 2097152; // 2MB in bytes

            // Image preview and validation
            if (imageInput) {
                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        // Validate file size
                        if (file.size > maxFileSize) {
                            Swal.fire('Error', 'Ukuran file tidak boleh lebih dari 2MB', 'error');
                            this.value = '';
                            imagePreview.style.display = 'none';
                            return;
                        }

                        // Validate file type
                        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                        if (!validTypes.includes(file.type)) {
                            Swal.fire('Error', 'Format file harus JPG, PNG, GIF, atau WEBP', 'error');
                            this.value = '';
                            imagePreview.style.display = 'none';
                            return;
                        }

                        // Show preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            imagePreview.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Form validation and submission
            document.getElementById('eventForm').addEventListener('submit', function(e) {
                const title = document.getElementById('title').value.trim();
                const eventDate = document.getElementById('event_date').value;
                const status = document.getElementById('status').value;
                const registrationLink = document.getElementById('registration_link').value;

                // Validate title
                if (!title) {
                    e.preventDefault();
                    Swal.fire('Error', 'Judul event wajib diisi', 'error');
                    document.getElementById('title').focus();
                    return false;
                }

                // Validate event date
                if (!eventDate) {
                    e.preventDefault();
                    Swal.fire('Error', 'Tanggal & waktu event wajib diisi', 'error');
                    document.getElementById('event_date').focus();
                    return false;
                }

                // Validate event date is in the future
                const eventDateTime = new Date(eventDate);
                if (eventDateTime < new Date()) {
                    e.preventDefault();
                    Swal.fire('Warning', 'Tanggal event tidak boleh di masa lalu', 'warning');
                    document.getElementById('event_date').focus();
                    return false;
                }

                // Validate status
                if (!status) {
                    e.preventDefault();
                    Swal.fire('Error', 'Status wajib dipilih', 'error');
                    document.getElementById('status').focus();
                    return false;
                }

                // Validate registration link format if provided
                if (registrationLink && !isValidUrl(registrationLink)) {
                    e.preventDefault();
                    Swal.fire('Error', 'Format link pendaftaran tidak valid', 'error');
                    document.getElementById('registration_link').focus();
                    return false;
                }
            });

            // Helper function to validate URL format
            function isValidUrl(string) {
                try {
                    new URL(string);
                    return true;
                } catch (_) {
                    return false;
                }
            }
        });

        // Show session error if exists
        @if (session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire('Error', '{{ session('error') }}', 'error');
            });
        @endif
    </script>
@endsection
