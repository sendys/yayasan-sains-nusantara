@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Detail Blog';
    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="header-title">Detail Blog</h4>
                        <div>
                            <a href="{{ route('admin.blog.edit', $blog->uuid) }}" class="btn btn-warning btn-sm">
                                <i class="mdi mdi-square-edit-outline me-1"></i> Edit
                            </a>
                            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary btn-sm">
                                <i class="mdi mdi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Judul</th>
                                    <td>: {{ $blog->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>: {{ $blog->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Author</th>
                                    <td>: {{ $blog->author ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:
                                        @if ($blog->status === 'published')
                                            <span class="badge bg-success">Published</span>
                                        @elseif ($blog->status === 'draft')
                                            <span class="badge bg-warning">Draft</span>
                                        @else
                                            <span class="badge bg-secondary">Archived</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Publish</th>
                                    <td>: {{ $blog->published_at ? $blog->published_at->format('d/m/Y H:i') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Dibuat</th>
                                    <td>: {{ $blog->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diupdate</th>
                                    <td>: {{ $blog->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-4">
                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                    class="img-fluid rounded">
                            @else
                                <img src="{{ asset('assets/fe/images/blog/post-1.jpg') }}" alt="No Image"
                                    class="img-fluid rounded">
                            @endif
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <h5>Excerpt</h5>
                            <p>{{ $blog->excerpt ?? 'Tidak ada excerpt' }}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <h5>Konten</h5>
                            <div class="border p-3 rounded">
                                {!! nl2br(e($blog->content)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
