@extends('layouts.frontend')

@section('content')
    <!-- page title -->
    <section class="page-title-section overlay" data-background="{{ asset('assets/fe/images/backgrounds/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item">
                            <a class="h3 text-white font-secondary" href="{{ route('frontend.galeri.index') }}">{{ __('story.title') }}</a>
                        </li>
                    </ul>
                    <p class="text-lighten">
                        {{ __('story.description') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center section-title justify-content-between">
                        <h2 class="mb-0 text-nowrap mr-3">@isset($kategoriLabel) {{ $kategoriLabel }} @else {{ __('story.title') }} @endisset</h2>
                        <div class="border-top w-100 border-primary d-none d-sm-block"></div>
                    </div>
                </div>
            </div>

            <!-- Filter Kategori -->
            {{-- <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('frontend.galeri.index') }}" 
                           class="btn {{ !isset($kategori) ? 'btn-primary' : 'btn-outline-primary' }} btn-sm">
                            Semua
                        </a>
                        @foreach (\App\Models\Gallery::getKategoriList() as $key => $label)
                            <a href="{{ route('frontend.galeri.kategori', $key) }}" 
                               class="btn {{ ($kategori ?? '') == $key ? 'btn-primary' : 'btn-outline-primary' }} btn-sm">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div> --}}

            <!-- gallery list -->
            <div class="row justify-content-center" id="gallery-container">
                @include('frontend.galeri.partials.gallery-items')
            </div>
            <!-- /gallery list -->

            @if ($galleries->hasPages())
                <div class="row">
                    <div class="col-12 text-center">
                        <nav class="mt-4 custom-pagination">
                            {{ $galleries->links('pagination::simple-bootstrap-5') }}
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection