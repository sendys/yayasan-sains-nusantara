@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Manage Data Events';
    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Manage Data Events</h4>
                    <p class="sub-header">
                        Kelola data acara upcoming events dengan mudah
                    </p>

                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <form method="GET" action="{{ route('admin.event.index') }}"
                                class="d-flex flex-wrap align-items-center">
                                <label for="status-select" class="me-1">Showing</label>
                                <div class="me-1">
                                    <select class="form-select my-0" name="1 my-lg-per_page" onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                        </option>
                                    </select>
                                </div>

                                <label for="status-select" class="me-1">Status</label>
                                <div class="me-1">
                                    <select class="form-select my-1 my-lg-0" name="status" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft
                                        </option>
                                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                                            Published</option>
                                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                            Completed</option>
                                    </select>
                                </div>

                                <div class="me-1">
                                    <div class="position-relative">
                                        <i class="mdi mdi-filter position-absolute ms-2"
                                            style="top: 50%; transform: translateY(-50%);"></i>
                                        <select class="form-select my-1 my-lg-0 ps-4" name="sort_dir"
                                            onchange="this.form.submit()">
                                            <option value="asc" {{ request('sort_dir') == 'asc' ? 'selected' : '' }}>Asc
                                            </option>
                                            <option value="desc" {{ request('sort_dir') == 'desc' ? 'selected' : '' }}>
                                                Desc</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="me-1">
                                    <div class="position-relative">
                                        <i class="mdi mdi-magnify position-absolute ms-2"
                                            style="top: 50%; transform: translateY(-50%);"></i>
                                        <input type="search" name="search" class="form-control my-1 my-lg-0 ps-4"
                                            placeholder="Search..." value="{{ request('search') }}"
                                            onkeyup="if(this.value.length === 0) this.form.submit()" autofocus>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <div class="text-lg-end my-1 my-lg-0">
                                <a href="{{ route('admin.event.create') }}"
                                    class="btn btn-primary waves-effect waves-light mb-2">
                                    <i class="mdi mdi-plus me-1"></i>Tambah Event
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>

                    @if (isset($events) && $events->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover table-sm mb-0" id="eventsTable">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">No.</th>
                                        <th style="width: 100px;">Gambar</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th>Lokasi</th>
                                        <th style="width: 100px;">Status</th>
                                        <th style="width: 150px;">Published</th>
                                        <th style="width: 200px;">Pembaharuan</th>
                                        <th style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="data-tbody">
                                    <tr id="loading-row">
                                        <td colspan="9" class="text-center">
                                            <div class="spinner-border text-primary m-2" role="status"></div>
                                            <br>Sedang memuat data...</br>
                                        </td>
                                    </tr>

                                    @foreach ($events as $event)
                                        <tr class="data-row d-none">
                                            <td>{{ $loop->iteration + ($events->currentPage() - 1) * $events->perPage() }}
                                            </td>
                                            <td>
                                                @if ($event->image)
                                                    <img src="{{ asset('storage/' . $event->image) }}"
                                                        alt="{{ $event->title }}" class="rounded"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('assets/fe/images/courses/course-1.jpg') }}"
                                                        alt="No Image" class="rounded"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td style="max-width:200px; white-space:normal; word-break:break-word;">
                                                {{ $event->title }}</td>
                                            <td>{{ $event->event_date ? $event->event_date->format('d/m/Y H:i') : '-' }}
                                            </td>
                                            <td style="max-width:150px; white-space:normal; word-break:break-word;">
                                                {{ $event->location ?? '-' }}</td>
                                            <td>
                                                @if ($event->status === 'published')
                                                    <span class="badge bg-success">Published</span>
                                                @elseif ($event->status === 'draft')
                                                    <span class="badge bg-warning">Draft</span>
                                                @elseif ($event->status === 'cancelled')
                                                    <span class="badge bg-danger">Cancelled</span>
                                                @else
                                                    <span class="badge bg-secondary">Completed</span>
                                                @endif
                                            </td>
                                            <td>{{ $event->published_at ? $event->published_at->format('d/m/Y H:i') : '-' }}
                                            </td>
                                            <td>{{ $event->updated_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.event.show', $event->uuid) }}"
                                                    class="btn btn-sm btn-info me-1" title="Lihat">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>

                                                <a href="{{ route('admin.event.edit', $event->uuid) }}"
                                                    class="btn btn-sm btn-warning me-1" title="Edit">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>

                                                <form action="{{ route('admin.event.destroy', $event->uuid) }}"
                                                    method="POST" class="delete-event-form d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete-event"
                                                        data-event-title="{{ $event->title }}" title="Hapus">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {!! $events->appends(request()->query())->links('pagination::bootstrap-5') !!}
                        </div>
                    @else
                        <div class="text-center p-4">
                            <img src="{{ asset('assets/images/empty.png') }}" height="150" alt="No data">
                            <h4 class="text-muted mt-3">No Records Found</h4>
                            <p class="text-muted">We couldn't find any event records. Try adding some new events.</p>
                            <a href="{{ route('admin.event.create') }}" class="btn btn-primary btn-sm mt-2">
                                <i class="mdi mdi-plus me-1"></i> Tambah Event
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Hide spinner, show data rows
        document.addEventListener("DOMContentLoaded", function() {
            const loadingRow = document.getElementById('loading-row');
            const dataRows = document.querySelectorAll('.data-row');

            setTimeout(() => {
                if (loadingRow) loadingRow.remove();
                dataRows.forEach(row => row.classList.remove('d-none'));
            }, 500);
        });

        // Delete Event
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete-event');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
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
            });
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
