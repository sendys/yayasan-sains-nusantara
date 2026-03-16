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
                    <p class="sub-header">Kelola data acara upcoming events dengan mudah</p>

                    <div class="row justify-content-between mb-3">
                        <div class="col-auto">
                            <form method="GET" action="{{ route('admin.event.index') }}"
                                class="d-flex flex-wrap align-items-center gap-2">
                                <!-- Items Per Page -->
                                <div class="d-flex align-items-center">
                                    <label for="per-page" class="me-2 text-nowrap">Showing</label>
                                    <select class="form-select form-select-sm" id="per-page" name="per_page"
                                        onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100
                                        </option>
                                    </select>
                                </div>

                                <!-- Status Filter -->
                                <div class="d-flex align-items-center">
                                    <label for="status" class="me-2 text-nowrap">Status</label>
                                    <select class="form-select form-select-sm" id="status" name="status"
                                        onchange="this.form.submit()">
                                        <option value="">All</option>
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

                                <!-- Sort Direction -->
                                <div class="d-flex align-items-center">
                                    <label for="sort-dir" class="me-2 text-nowrap">Sort</label>
                                    <select class="form-select form-select-sm" id="sort-dir" name="sort_dir"
                                        onchange="this.form.submit()">
                                        <option value="desc" {{ request('sort_dir') == 'desc' ? 'selected' : '' }}>Newest
                                        </option>
                                        <option value="asc" {{ request('sort_dir') == 'asc' ? 'selected' : '' }}>Oldest
                                        </option>
                                    </select>
                                </div>

                                <!-- Search -->
                                <div style="min-width: 200px; flex: 1;">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-magnify"></i>
                                        </span>
                                        <input type="search" name="search" class="form-control"
                                            placeholder="Search events..." value="{{ request('search') }}"
                                            onkeyup="if(this.value.length === 0) this.form.submit()">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('admin.event.create') }}" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-plus me-1"></i>Tambah Event
                            </a>
                        </div>
                    </div>

                    @if (isset($events) && $events->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">No.</th>
                                        <th style="width: 80px;">Image</th>
                                        <th>Title</th>
                                        <th style="width: 150px;">Event Date</th>
                                        <th style="width: 120px;">Location</th>
                                        <th style="width: 100px;">Status</th>
                                        <th style="width: 130px;">Published</th>
                                        <th style="width: 130px;">Updated</th>
                                        <th style="width: 120px;">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
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
