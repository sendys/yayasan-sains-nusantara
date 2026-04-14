@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'Tables';
    $title = 'Detail Galeri';
    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="header-title">Detail Galeri</h4>
                        <div>
                            <a href="{{ route('admin.gallery.edit', $gallery->uuid) }}" class="btn btn-warning btn-sm">
                                <i class="mdi mdi-square-edit-outline me-1"></i> Edit
                            </a>
                            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary btn-sm">
                                <i class="mdi mdi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Judul</th>
                                    <td>: {{ $gallery->title }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>: <span class="badge bg-info">{{ \App\Models\Gallery::getKategoriList()[$gallery->kategori] ?? $gallery->kategori }}</span></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:
                                        @if ($gallery->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat</th>
                                    <td>: {{ $gallery->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diupdate</th>
                                    <td>: {{ $gallery->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-4">
                            @if ($gallery->image)
                                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                    class="img-fluid rounded">
                            @else
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" alt="No Image"
                                    class="img-fluid rounded">
                            @endif
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <h5>Deskripsi</h5>
                            <p>{{ $gallery->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection