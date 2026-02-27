@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Manage Data Blog';
    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Manage Data Blog</h4>
                    <p class="sub-header">
                        Kelola data blog dengan mudah
                    </p>

                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <form method="GET" action="{{ route('admin.blog.index') }}"
                                class="d-flex flex-wrap align-items-center">
                                <label for="status-select" class="me-1">Showing</label>
                                <div class="me-1">
                                    <select class="form-select my-1 my-lg-0" name="per_page" onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                    </select>
                                </div>

                                <label for="status-select" class="me-1">Status</label>
                                <div class="me-1">
                                    <select class="form-select my-1 my-lg-0" name="status" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                </div>

                                <div class="me-1">
                                    <div class="position-relative">
                                        <i class="mdi mdi-filter position-absolute ms-2"
                                            style="top: 50%; transform: translateY(-50%);"></i>
                                        <select class="form-select my-1 my-lg-0 ps-4" name="sort_dir"
                                            onchange="this.form.submit()">
                                            <option value="asc" {{ request('sort_dir') == 'asc' ? 'selected' : '' }}>Asc</option>
                                            <option value="desc" {{ request('sort_dir') == 'desc' ? 'selected' : '' }}>Desc</option>
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
                                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary waves-effect waves-light mb-2">
                                    <i class="mdi mdi-plus me-1"></i>Tambah Blog
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>

                    @if (isset($blogs) && $blogs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-centered table-nowrap table-hover table-sm mb-0" id="blogsTable">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">No.</th>
                                        <th style="width: 100px;">Gambar</th>
                                        <th>Judul</th>
                                        <th>Excerpt</th>
                                        <th>Author</th>
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

                                    @foreach ($blogs as $blog)
                                        <tr class="data-row d-none">
                                            <td>{{ $loop->iteration + ($blogs->currentPage() - 1) * $blogs->perPage() }}</td>
                                            <td>
                                                @if ($blog->image)
                                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                                        class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('assets/fe/images/blog/post-1.jpg') }}" alt="No Image"
                                                        class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ Str::limit($blog->excerpt, 50) }}</td>
                                            <td>{{ $blog->author ?? '-' }}</td>
                                            <td>
                                                @if ($blog->status === 'published')
                                                    <span class="badge bg-success">Published</span>
                                                @elseif ($blog->status === 'draft')
                                                    <span class="badge bg-warning">Draft</span>
                                                @else
                                                    <span class="badge bg-secondary">Archived</span>
                                                @endif
                                            </td>
                                            <td>{{ $blog->published_at ? $blog->published_at->format('d/m/Y H:i') : '-' }}</td>
                                            <td>{{ $blog->updated_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('admin.blog.show', $blog->uuid) }}" class="btn btn-sm btn-info me-1" title="Lihat">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>

                                                <a href="{{ route('admin.blog.edit', $blog->uuid) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                </a>

                                                <form action="{{ route('admin.blog.destroy', $blog->uuid) }}" method="POST"
                                                    class="delete-blog-form d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger btn-delete-blog"
                                                        data-blog-title="{{ $blog->title }}" title="Hapus">
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
                            {!! $blogs->appends(request()->query())->links('pagination::bootstrap-5') !!}
                        </div>
                    @else
                        <div class="text-center p-4">
                            <img src="{{ asset('assets/images/empty.png') }}" height="150" alt="No data">
                            <h4 class="text-muted mt-3">No Records Found</h4>
                            <p class="text-muted">We couldn't find any blog records. Try adding some new blogs.</p>
                            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary btn-sm mt-2">
                                <i class="mdi mdi-plus me-1"></i> Tambah Blog
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

        // Delete Blog
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete-blog');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    const blogTitle = this.getAttribute('data-blog-title');
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        html: `Blog "${blogTitle}" akan dihapus.`,
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
