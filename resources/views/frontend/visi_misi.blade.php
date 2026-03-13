@extends('layouts.frontend')

@section('content')
    <!-- page title -->
    <section class="page-title-section overlay" data-background="{{ asset('assets/fe/images/backgrounds/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item">
                            <a class="h3 text-white font-secondary" href="#">Visi &amp; Misi</a>
                        </li>
                    </ul>
                    <p class="text-lighten">
                        Yayasan Sains Nusantara (YSN).
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <section class="section bg-light py-5">
        <div class="container">
            <div class="row mb-5">
                <!-- Kolom Kiri: Sejarah -->
                <div class="col-lg-7">
                    <div class="text-center mb-4">
                        <h3></h3>
                        <div class="divider mx-auto mb-4"></div>
                    </div>

                    <div class="mx-auto text-justify" style="max-width:800px;">
                        <hr class="my-2">
                        <br>

                        {!! $section->deskripsi !!}

                    </div>
                </div>

                <!-- Kolom Kanan: Donasi & Blog -->
                <div class="col-lg-5">
                    <!-- Image Donasi -->
                    <div class="mb-5">
                        <div class="text-center mb-4">
                            <h3></h3>
                            <div class="divider mx-auto mb-4"></div>
                        </div>
                        <div class="card border-0 shadow-sm">
                            <img src="{{ asset('assets/fe/images/about/donasi.png') }}" alt="Donasi" class="card-img-top"
                                style="height: 400px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">Mari Berdonasi</h5>
                                <p class="card-text">Dukungan Anda sangat berarti untuk kelanjutan program-program kami.</p>
                                <a href="{{ route('donasi') }}" class="btn btn-primary">
                                    Donasi
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* ========================= */
        /*        MISI STYLE FINAL   */
        /* ========================= */

        /* ========================= */
        /*     LIST CONTENT STYLE    */
        /* ========================= */

        .misi-list,
        .bidang-list {
            list-style-type: decimal !important;
            padding-left: 30px !important;
            margin-top: 12px;
        }

        .misi-list li,
        .bidang-list>li {
            margin-bottom: 18px;
            line-height: 1.9;
            text-align: justify;
        }

        /* Sub list untuk bidang */
        .sub-bidang {
            list-style-type: disc !important;
            padding-left: 25px !important;
            margin-top: 10px;
        }

        .sub-bidang li {
            margin-bottom: 10px;
            line-height: 1.8;
        }
    </style>
@endpush
