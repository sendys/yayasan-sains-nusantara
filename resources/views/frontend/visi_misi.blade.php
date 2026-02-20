@extends('layouts.frontend')

@section('content')

    <!-- page title -->
    <section class="page-title-section overlay"
        data-background="{{ asset('assets/fe/images/backgrounds/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item">
                            <!-- <a class="h2 text-primary font-secondary" href="#">Visi dan Misi</a> -->
                        </li>
                    </ul>
                    <p class="text-lighten">
                        <!--  Visi dan Misi Yayasan Sains Nusantara. -->
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

                    <!-- <div class="section-logo mb-3">
                                    <img src="{{ asset('storage/' . ($section->logo ?? 'no-image.png')) }}"
                                        alt="Logo Yayasan Sains Nusantara" class="img-fluid">
                                </div> -->
                    <h3>Visi dan Misi</h3>
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
            margin-bottom: 10px;
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
            line-height: 1.9;
            margin-bottom: 0;
        }
    </style>

@endpush

@push('scripts')
    <script>
        // Putar ikon saat accordion dibuka/tutup
        $(document).ready(function () {
            $('#timelineAccordion').on('show.bs.collapse', function (e) {
                $(e.target).closest('.card').find('.toggle-icon').addClass('rotate');
            }).on('hide.bs.collapse', function (e) {
                $(e.target).closest('.card').find('.toggle-icon').removeClass('rotate');
            });
        });
    </script>
@endpush