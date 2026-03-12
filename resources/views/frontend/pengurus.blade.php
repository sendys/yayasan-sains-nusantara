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
                            <a class="h3 text-white font-secondary" href="#">Struktur Pengurus</a>
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
                <div class="col-lg-12">
                    <div class="text-center mb-4">
                        <h3></h3>
                        <div class="divider mx-auto mb-4"></div>
                    </div>
                    <br>

                    <div class="struktur-section">

                        <!-- ===================== -->
                        <!-- Pembina -->
                        <!-- ===================== -->
                        <h6 class="struktur-title">PEMBINA</h6>
                        <div class="row">

                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="struktur-card text-center">
                                    <img src="{{ asset('assets/fe/images/struktur/Mustanir.png') }}" class="struktur-img"
                                        alt="Prof. Dr. Mustanir">
                                    <h6 class="mt-3 mb-1">Prof. Dr. Mustanir, M.Sc</h6>
                                    <small class="text-color">Ketua Pembina</small>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="struktur-card text-center">
                                    <img src="{{ asset('assets/fe/images/struktur/Ismail.png') }}" class="struktur-img"
                                        alt="Prof. Dr. Ismail">
                                    <h6 class="mt-3 mb-1">Prof. Dr. Ismail, M.Sc</h6>
                                    <small class="text-color">Anggota Pembina</small>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="struktur-card text-center">
                                    <img src="{{ asset('assets/fe/images/struktur/Firdus.png') }}" class="struktur-img"
                                        alt="Dr. Firdus">
                                    <h6 class="mt-3 mb-1">Dr. Firdus, M.Si</h6>
                                    <small class="text-color">Anggota Pembina</small>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3 mb-4">
                                <div class="struktur-card text-center">
                                    <img src="{{ asset('assets/fe/images/struktur/Elly.jpg') }}" class="struktur-img"
                                        class="struktur-img" alt="Dr. Elly Sufriadi">
                                    <h6 class="mt-3 mb-1">Dr. Elly Sufriadi, M.Si</h6>
                                    <small class="text-color">Anggota Pembina</small>
                                </div>
                            </div>

                        </div>

                        <!-- ===================== -->
                        <!-- Pengawas -->
                        <!-- ===================== -->
                        <h6 class="struktur-title mt-4">PENGAWAS</h6>
                        <div class="row">

                            <div class="col-md-4 mb-4">
                                <div class="struktur-card text-center">
                                    <img src="{{ asset('assets/fe/images/struktur/yansya.jpeg') }}" class="struktur-img"
                                        alt="Dedy Yansyah">
                                    <h6 class="mt-3 mb-1">Dedy Yansyah, S.Si</h6>
                                    <small class="text-color">Ketua Pengawas</small>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="struktur-card text-center">
                                    <img src="{{ asset('assets/fe/images/struktur/Muslim.png') }}" class="struktur-img"
                                        alt="Dr. Muslim">
                                    <h6 class="mt-3 mb-1">Dr. Muslim, M.Info.Tech.</h6>
                                    <small class="text-color">Anggota Pengawas</small>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="struktur-card text-center">
                                    <img src="{{ asset('assets/fe/images/struktur/Ardiansyah.png') }}" class="struktur-img"
                                        alt="Dr. Ardiansyah">
                                    <h6 class="mt-3 mb-1">Dr. Ardiansyah, B.Sc.Elect.Eng.</h6>
                                    <small class="text-color">Anggota Pengawas</small>
                                </div>
                            </div>

                        </div>

                        <!-- ===================== -->
                        <!-- Pengurus Harian -->
                        <!-- ===================== -->
                        <h6 class="struktur-title mt-4">PENGURUS HARIAN</h6>
                        <div class="row">

                            <div class="col-md-4 mb-4">
                                <div class="struktur-card text-center">
                                    <img src="{{ asset('assets/fe/images/struktur/Kholil.jpeg') }}" class="struktur-img"
                                        alt="Kholil Yusra">
                                    <h6 class="mt-3 mb-1">Kholil Yusra, S.Si., M.Si.</h6>
                                    <small class="text-color">Ketua</small>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="struktur-card text-center">
                                    <img src="{{ asset('assets/fe/images/struktur/Dedy.jpeg') }}" class="struktur-img"
                                        alt="Dedy Safran">
                                    <h6 class="mt-3 mb-1">Dedy Safran, S.Si</h6>
                                    <small class="text-color">Sekretaris</small>
                                </div>
                            </div>

                            <div class="col-md-4 mb-4">
                                <div class="struktur-card text-center">
                                    <img src="{{ asset('assets/fe/images/struktur/Ruhaya.jpeg') }}" class="struktur-img"
                                        alt="Ruhaya">
                                    <h6 class="mt-3 mb-1">Ruhaya, S.Si., M.Ling.</h6>
                                    <small class="text-color">Bendahara</small>
                                </div>
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
        /*      STRUKTUR STYLE       */
        /* ========================= */

        .struktur-title {
            font-weight: 700;
            margin-bottom: 20px;
            border-left: 4px solid #0d6efd;
            padding-left: 10px;
        }

        .struktur-card {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .struktur-card:hover {
            transform: translateY(-5px);
        }

        .struktur-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #f1f1f1;
        }
    </style>
@endpush