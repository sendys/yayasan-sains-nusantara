@extends('layouts.frontend')

@section('content')
    <!-- page title -->
    <section class="page-title-section overlay" data-background="{{ asset('assets/fe/images/backgrounds/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item">
                            <a class="h3 text-white font-secondary" href="{{ route('frontend.galeri.index') }}">Galeri</a>
                        </li>
                    </ul>
                    <p class="text-lighten">{{ $gallery->title }}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Main Image -->
                    <div class="card mb-4">
                        <img src="{{ $gallery->image_url }}" alt="{{ e($gallery->title) }}" 
                             class="img-fluid rounded" style="width: 100%;">
                    </div>

                    <!-- Gallery Info -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-info me-2">
                                    {{ \App\Models\Gallery::getKategoriList()[$gallery->kategori] ?? $gallery->kategori }}
                                </span>
                                <small class="text-muted">
                                    <i class="ti-calendar mr-1"></i>
                                    {{ $gallery->created_at->format('d F Y') }}
                                </small>
                            </div>
                            <h3 class="card-title">{{ $gallery->title }}</h3>
                            <p class="card-text">
                                {{ $gallery->deskripsi ?? 'Tidak ada deskripsi.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Galeri Terkait</h5>
                            <div class="row">
                                @forelse($relatedGalleries as $related)
                                    <div class="col-6 mb-3">
                                        <a href="{{ route('frontend.galeri.show', $related->uuid) }}">
                                            <img src="{{ $related->image_url }}" alt="{{ e($related->title) }}" 
                                                 class="img-fluid rounded" style="height: 100px; width: 100%; object-fit: cover;">
                                            <p class="small text-truncate mt-1 mb-0">{{ $related->title }}</p>
                                        </a>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-muted small">Tidak ada galeri terkait.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Kategori</h5>
                            <ul class="list-unstyled mb-0">
                                @foreach (\App\Models\Gallery::getKategoriList() as $key => $label)
                                    <li class="mb-2">
                                        <a href="{{ route('frontend.galeri.kategori', $key) }}" class="text-decoration-none">
                                            <i class="ti-angle-right text-primary me-2"></i>{{ $label }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .gallery-image-wrapper {
        position: relative;
        overflow: hidden;
    }
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }
</style>
@endpush
@endsection