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
                        <img src="{{ asset('storage/' . ($section->logo ?? 'no-image.png')) }}" alt="Logo Yayasan Sains Nusantara"
                            class="img-fluid">
                    </div>

                    <div class="divider mx-auto mb-4"></div>

                   <div class="mx-auto text-justify" style="max-width:800px;">
                        {!! $section->deskripsi ?? 'Tidak ada deskripsi.' !!}
                    </div>

                    <!-- VISI -->
                    <div class="mx-auto text-justify" style="max-width:800px;">
                        <h6 class="text-black mb-3">Visi</h6>
                        <p>{{ $section->visi ?? 'Tidak ada visi.' }}</p>
                    </div>

                    <!-- MISI -->
                    <div class="mx-auto text-justify" style="max-width:800px;">
                        <h6 class="text-black mb-3">Misi</h6>

                        @if ($section->misi ?? null && count($section->misi))
                            @foreach ($section->misi as $m)
                                <ol class="misi-item">
                                    <span class="misi-number">
                                        {{ $loop->iteration }}.
                                    </span>
                                    <span class="misi-text">
                                        {{ $m }}
                                    </span>
                                </ol>
                            @endforeach
                        @endif
                    </div>
                    <br><br>
                    <div class="mx-auto text-justify" style="max-width:800px;">
                       <h6 class="text-black mb-3">Sejarah Perjalanan YSN</h6>
                       <hr class="my-2">
                       <br>
                       <div id="timelineAccordion">
                            <h5><span class="badge badge-primary mr-2">2004</span> Titik Refleksi Kemanusiaan</h5>
                            <div>
                                <p>Tsunami Aceh menjadi momentum lahirnya gagasan membangun lembaga berbasis sains untuk pemulihan dan pembangunan masyarakat.</p>
                            </div>
                            <h5><span class="badge badge-primary mr-2">2005</span> Pendirian Yayasan</h3>
                            <div>
                                <p>Yayasan Sains Nusantara resmi didirikan sebagai lembaga independen yang fokus pada pengembangan ilmu pengetahuan dan pemberdayaan masyarakat.</p>
                            </div>
                            <h5><span class="badge badge-primary mr-2">2007</span> Penguatan Legalitas</h5>
                            <div>
                                <p>Penyempurnaan struktur organisasi dan legalitas untuk memperluas jejaring kemitraan nasional dan internasional.</p>
                            </div>
                            <h5><span class="badge badge-primary mr-2">2016–2020</span> Ekspansi Program Strategis</h5>
                            <div>
                                <p>Fokus pada isu lingkungan, ketahanan bencana, ekonomi kemasyarakatan, dan penguatan kapasitas desa.</p>
                            </div>
                            <h5><span class="badge badge-primary mr-2">2021–Sekarang</span> Transformasi & Inovasi</h5>
                            <div>
                                <p>Transformasi kelembagaan menuju model kolaboratif lintas sektor dengan pendekatan teknologi terapan.</p>
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
    /*        MISI STYLE         */
    /* ========================= */

    .misi-list {
        list-style: none;
        padding-left: 0;
        margin-left: 0;
    }

    .misi-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 10px; /* sebelumnya 18px → lebih rapat */
    }

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

    .misi-text {
        flex: 1;
        font-size: 16px;
        line-height: 1.9; /* ½ spasi */
        margin-bottom: 0;
    }

    /* ========================= */
    /*   JQUERY ACCORDION STYLE  */
    /* ========================= */

    #timelineAccordion {
        font-family: inherit;
    }

    #timelineAccordion .ui-accordion-header {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0;
        padding: 12px 15px;
        margin-top: 5px;
        cursor: pointer;
        font-weight: 100;
        color: #212529;
        transition: background 0.2s;
    }

    #timelineAccordion .ui-accordion-header:first-child {
        margin-top: 0;
    }

    #timelineAccordion .ui-accordion-header:hover {
        background: #e9ecef;
    }

    #timelineAccordion .ui-accordion-header.ui-state-active {
        background: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }

    #timelineAccordion .ui-accordion-header .ui-icon {
        display: none;
    }

    #timelineAccordion .ui-accordion-content {
        border: 1px solid #dee2e6;
        border-top: none;
        padding: 15px;
        background: #fff;
        font-size: 15px;
        line-height: 1.6;
    }

    #timelineAccordion .badge {
        font-size: 10px;
        padding: 5px 10px;
    }

</style>

@endpush

@push('scripts')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#timelineAccordion").accordion({
                collapsible: true,
                active: 0,
                heightStyle: "content"
            });
        });
    </script>
@endpush
