@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'View';
    $title = 'Detail Event';
    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <h4 class="header-title mb-3">{{ $event->title }}</h4>
                            
                            @if ($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" 
                                    class="img-fluid rounded mb-3" style="max-height: 400px; object-fit: cover; width: 100%;">
                            @else
                                <img src="{{ asset('assets/fe/images/courses/course-1.jpg') }}" alt="No Image" 
                                    class="img-fluid rounded mb-3" style="max-height: 400px; object-fit: cover; width: 100%;">
                            @endif

                            <div class="mb-4">
                                <h5 class="card-title">Deskripsi</h5>
                                <p class="card-text">{!! $event->description ?? 'Tidak ada deskripsi' !!}</p>
                            </div>

                            @if ($event->content)
                                <div class="mb-4">
                                    <h5 class="card-title">Konten Lengkap</h5>
                                    <p class="card-text">{!! nl2br(e($event->content)) !!}</p>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Informasi Event</h5>
                                    
                                    <div class="mb-3">
                                        <label class="form-label text-muted">Status</label>
                                        <div>
                                            @if ($event->status === 'published')
                                                <span class="badge bg-success">Published</span>
                                            @elseif ($event->status === 'draft')
                                                <span class="badge bg-warning">Draft</span>
                                            @elseif ($event->status === 'cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                            @else
                                                <span class="badge bg-secondary">Completed</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-muted">Tanggal & Waktu</label>
                                        <div class="fw-bold">
                                            <i class="mdi mdi-calendar me-1"></i>
                                            {{ $event->event_date ? $event->event_date->format('d/m/Y H:i') : '-' }}
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-muted">Lokasi</label>
                                        <div>
                                            <i class="mdi mdi-map-marker me-1"></i>
                                            {{ $event->location ?? 'Tidak ditentukan' }}
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-muted">Kategori</label>
                                        <div>
                                            {{ $event->category ?? 'Tidak ada' }}
                                        </div>
                                    </div>

                                    @if ($event->registration_link)
                                        <div class="mb-3">
                                            <label class="form-label text-muted">Link Pendaftaran</label>
                                            <div>
                                                <a href="{{ $event->registration_link }}" target="_blank" class="btn btn-sm btn-primary">
                                                    <i class="mdi mdi-link me-1"></i> Daftar
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($event->max_participants)
                                        <div class="mb-3">
                                            <label class="form-label text-muted">Kuota Peserta</label>
                                            <div>
                                                {{ $event->current_participants }} / {{ $event->max_participants }} 
                                                @if ($event->is_full)
                                                    <span class="badge bg-danger">Penuh</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label text-muted">Tanggal Publish</label>
                                        <div>
                                            {{ $event->published_at ? $event->published_at->format('d/m/Y H:i') : 'Belum publish' }}
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-muted">Dibuat</label>
                                        <div>
                                            {{ $event->created_at->format('d/m/Y H:i') }}
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-muted">Terakhir Diupdate</label>
                                        <div>
                                            {{ $event->updated_at->format('d/m/Y H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <a href="{{ route('admin.event.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Kembali
                            </a>
                            <a href="{{ route('admin.event.edit', $event->uuid) }}" class="btn btn-warning">
                                <i class="mdi mdi-square-edit-outline me-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.event.destroy', $event->uuid) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-delete-event" data-event-title="{{ $event->title }}">
                                    <i class="mdi mdi-delete me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Delete Event
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButton = document.querySelector('.btn-delete-event');
            if (deleteButton) {
                deleteButton.addEventListener('click', function() {
                    const form = this.closest('form');
                    const eventTitle = this.getAttribute('data-event-title');
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        html: `Event "${eventTitle}" akan dihapus.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            }
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire('Berhasil', '{{ session('success') }}', 'success');
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire('Error', '{{ session('error') }}', 'error');
            });
        </script>
    @endif
@endsection
