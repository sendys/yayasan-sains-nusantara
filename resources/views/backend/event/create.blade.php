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

                    <form id="eventForm" method="POST" action="{{ route('admin.event.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Event <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                    <div class="form-text">Deskripsi singkat event (opsional)</div>
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Konten Lengkap</label>
                                    <textarea class="form-control" id="content" name="content" rows="10">{{ old('content') }}</textarea>
                                    <div class="form-text">Konten detail event (opsional)</div>
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
                                    <label for="event_date" class="form-label">Tanggal & Waktu Event <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="event_date" name="event_date"
                                        value="{{ old('event_date') }}" required>
                                    @error('event_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" id="location" name="location"
                                        value="{{ old('location') }}" placeholder="Contoh: Auditorium, Jakarta">
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Kategori</label>
                                    <input type="text" class="form-control" id="category" name="category"
                                        value="{{ old('category') }}" placeholder="Contoh: Seminar, Workshop">
                                </div>

                                <div class="mb-3">
                                    <label for="registration_link" class="form-label">Link Pendaftaran</label>
                                    <input type="url" class="form-control" id="registration_link" name="registration_link"
                                        value="{{ old('registration_link') }}" placeholder="https://...">
                                </div>

                                <div class="mb-3">
                                    <label for="max_participants" class="form-label">Maksimal Peserta</label>
                                    <input type="number" class="form-control" id="max_participants" name="max_participants"
                                        value="{{ old('max_participants') }}" min="1" placeholder="Kosongkan jika tidak terbatas">
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="" selected>Pilih Status</option>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="published_at" class="form-label">Tanggal Publish</label>
                                    <input type="datetime-local" class="form-control" id="published_at" name="published_at"
                                        value="{{ old('published_at') }}" step="1">
                                    <div class="form-text">Format: Tanggal dan waktu. Kosongkan jika ingin diisi otomatis saat publish</div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.event.index') }}" class="btn btn-secondary">Batal</a>
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
        document.getElementById('eventForm').addEventListener('submit', function(e) {
            const status = document.getElementById('status').value;
            const title = document.getElementById('title').value;
            const eventDate = document.getElementById('event_date').value;

            if (!title.trim()) {
                e.preventDefault();
                Swal.fire('Error', 'Judul event wajib diisi', 'error');
                return false;
            }

            if (!eventDate) {
                e.preventDefault();
                Swal.fire('Error', 'Tanggal event wajib diisi', 'error');
                return false;
            }

            if (!status) {
                e.preventDefault();
                Swal.fire('Error', 'Status wajib dipilih', 'error');
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
