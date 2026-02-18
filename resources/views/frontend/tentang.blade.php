@extends('layouts.frontend')

@section('content')

    <!-- page title -->
    <section class="page-title-section overlay" data-background="{{ asset('assets/fe/images/backgrounds/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item">
                            <a class="h2 text-primary font-secondary" href="#">Tentang Kami</a>
                        </li>
                    </ul>
                    <p class="text-lighten">
                        Sejarah didirikan Yayasan Sains Nusantara (YSN).
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <section class="section bg-light py-5">
        <div class="container">

            <div class="row mb-5">
                <div class="col-lg-12 text-center">

                    <div class="section-logo mb-3">
                        <img src="{{ asset('storage/' . $section->logo) }}" alt="Logo Yayasan Sains Nusantara"
                            class="img-fluid">
                    </div>

                    <div class="divider mx-auto mb-4"></div>

                    <p class="text-justify mx-auto" style="max-width:800px;">
                        {{ $section->deskripsi }}
                    </p>

                    <!-- VISI -->
                    <div class="mx-auto text-justify" style="max-width:800px;">
                        <h6 class="text-black mb-3">Visi</h6>
                        <p>{{ $section->visi }}</p>
                    </div>

                    <!-- MISI -->
                    <div class="mx-auto text-justify" style="max-width:800px;">
                        <h6 class="text-black mb-3">Misi</h6>

                        @if ($section->misi && count($section->misi))
                            @foreach ($section->misi as $m)
                                <li class="misi-item">
                                    <span class="misi-number">
                                        {{ $loop->iteration }}.
                                    </span>
                                    <span class="misi-text">
                                        {{ $m }}
                                    </span>
                                </li>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>

            <!-- TIMELINE -->
            <div class="timeline-ngointernational">

                <div class="timeline-row left">
                    <div class="timeline-content">
                        <span class="timeline-year">2004</span>
                        <h5>Titik Refleksi Kemanusiaan</h5>
                        <p>Tsunami Aceh menjadi momentum lahirnya gagasan membangun lembaga berbasis sains untuk pemulihan
                            dan pembangunan masyarakat.</p>
                    </div>
                </div>

                <div class="timeline-row right">
                    <div class="timeline-content">
                        <span class="timeline-year">2005</span>
                        <h5>Pendirian Yayasan</h5>
                        <p>Yayasan Sains Nusantara resmi didirikan sebagai lembaga independen yang fokus pada pengembangan
                            ilmu pengetahuan dan pemberdayaan masyarakat.</p>
                    </div>
                </div>

                <div class="timeline-row left">
                    <div class="timeline-content">
                        <span class="timeline-year">2007</span>
                        <h5>Penguatan Legalitas</h5>
                        <p>Penyempurnaan struktur organisasi dan legalitas untuk memperluas jejaring kemitraan nasional dan
                            internasional.</p>
                    </div>
                </div>

                <div class="timeline-row right">
                    <div class="timeline-content">
                        <span class="timeline-year">2016–2020</span>
                        <h5>Ekspansi Program Strategis</h5>
                        <p>Fokus pada isu lingkungan, ketahanan bencana, ekonomi kemasyarakatan, dan penguatan kapasitas
                            desa.</p>
                    </div>
                </div>

                <div class="timeline-row left">
                    <div class="timeline-content">
                        <span class="timeline-year">2021–Sekarang</span>
                        <h5>Transformasi & Inovasi</h5>
                        <p>Transformasi kelembagaan menuju model kolaboratif lintas sektor dengan pendekatan teknologi
                            terapan.</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection


@push('styles')
    <style>
        /* ========================= */
        /*        MISI STYLE         */
        /* ========================= */

        /* Hilangkan bullet & indent bawaan */
        .misi-list {
            list-style: none;
            padding-left: 0;
            margin-left: 0;
        }

        /* Item layout */
        .misi-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 18px;
        }

        /* Nomor dalam bulat biru */
        .misi-number {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        /* Text misi */
        .misi-text {
            flex: 1;
            font-size: 16px;
            line-height: 1.6;
        }
    </style>
@endpush
