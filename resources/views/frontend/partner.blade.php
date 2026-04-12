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
                            <a class="h3 text-white font-secondary" href="#">Mitra & Kolaborasi</a>
                        </li>
                    </ul>
                    <p class="text-lighten">
                        Bersama mitra strategis, kami menghadirkan dampak berkelanjutan bagi masyarakat dan lingkungan.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <section class="section bg-light py-5">
        <div class="container">

            <!-- ===================== -->
            <!-- PEMERINTAH -->
            <!-- ===================== -->
            <h5 class="partner-title">PEMERINTAH</h5>
            <div class="row text-center">

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="partner-card text-center">
                        <a href="https://dlhk.acehprov.go.id" target="_blank" class="partner-link-wrapper">
                            <img src="{{ asset('assets/fe/images/partners/logo2.png') }}" class="partner-logo"
                                alt="DLHK Aceh">

                            <h6 class="mt-3 mb-1">DLHK Aceh</h6>
                            <span class="partner-visit">Kunjungi Website</span>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="partner-card">
                        <a href="https://bappeda.acehprov.go.id" target="_blank" class="partner-link-wrapper">
                            <img src="{{ asset('assets/fe/images/partners/logo_aceh.png') }}" class="partner-logo"
                                alt="BAPPEDA Aceh">
                            <h6 class="mt-3">BAPPEDA Aceh</h6>
                            <span class="partner-visit">Kunjungi Website</span>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="partner-card">
                        <a href="https://acehbesarkab.go.id" target="_blank" class="partner-link-wrapper">
                            <img src="{{ asset('assets/fe/images/partners/logo_aceh_besar1.png') }}" class="partner-logo"
                                alt="Pemkab Aceh Besar">
                            <h6 class="mt-3">Pemkab Aceh Besar</h6>
                            <span class="partner-visit">Kunjungi Website</span>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="partner-card">
                        <a href="https://www.bappenas.go.id" target="_blank" class="partner-link-wrapper">
                            <img src="{{ asset('assets/fe/images/partners/Logo_Kementerian_PPN-Bappenas.png') }}"
                                class="partner-logo" alt="Bappenas">
                            <h6 class="mt-3">Bappenas</h6>
                            <span class="partner-visit">Kunjungi Website</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- ===================== -->
            <!-- NGO -->
            <!-- ===================== -->
            <h5 class="partner-title mt-5">NGO</h5>
            <div class="row text-center">

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="partner-card">
                        <a href="https://www.giz.de/en" target="_blank" class="partner-link-wrapper">
                            <img src="{{ asset('assets/fe/images/partners/giz.png') }}" class="partner-logo"
                                alt="GIZ Indonesia">
                            <h6 class="mt-3">GIZ Indonesia</h6>
                            <span class="partner-visit">Kunjungi Website</span>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="partner-card">
                        <a href="https://sintas.or.id/" target="_blank" class="partner-link-wrapper">
                        <img src="{{ asset('assets/fe/images/partners/sintas.jpg') }}" class="partner-logo"
                            alt="Yayasan Sintas">
                        <h6 class="mt-3">Yayasan Sintas</h6>
                         <span class="partner-visit">Kunjungi Website</span>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="partner-card">
                         <a href="https://www.geutanyoe.id/" target="_blank" class="partner-link-wrapper">
                            <img src="{{ asset('assets/fe/images/partners/geutanyoe.png') }}" class="partner-logo"
                                alt="Yayasan Geutanyoe">
                            <h6 class="mt-3">Yayasan Geutanyoe</h6>
                            <span class="partner-visit">Kunjungi Website</span>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="partner-card">
                        <a href="https://www.ekoba.or.id/" target="_blank" class="partner-link-wrapper">
                        <img src="{{ asset('assets/fe/images/partners/ekoba.jpg') }}" class="partner-logo"
                            alt="Yayasan Ekoba">
                        <h6 class="mt-3">Yayasan Ekoba</h6>
                        <span class="partner-visit">Kunjungi Website</span>
                    </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="partner-card">
                        <a href="https://www.leuser.org/" target="_blank" class="partner-link-wrapper">
                        <img src="{{ asset('assets/fe/images/partners/YKL.jpeg') }}" class="partner-logo"
                            alt="Forum Konservasi Leuser">
                        <h6 class="mt-3">Forum Konservasi Leuser</h6>
                        <span class="partner-visit">Kunjungi Website</span>
                    </a>
                    </div>
                </div>

            </div>

            <!-- ===================== -->
            <!-- BUMN -->
            <!-- ===================== -->
            <h5 class="partner-title mt-5">BUMN</h5>
            <div class="row text-center">

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="partner-card">
                        <a href="https://pln.co.id" target="_blank" class="partner-link-wrapper">
                            <img src="{{ asset('assets/fe/images/partners/pln.jpg') }}" class="partner-logo" alt="PLN UID Aceh">
                            <h6 class="mt-3">PT PLN (Persero) UID Aceh</h6>
                            <span class="partner-visit">Kunjungi Website</span>

                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="partner-card">
                        <a href="https://www.andalas.com" target="_blank" class="partner-link-wrapper">
                            <img src="{{ asset('assets/fe/images/partners/andalas.png') }}" class="partner-logo"
                                alt="Solusi Bangun Andalas">
                            <h6 class="mt-3">PT Solusi Bangun Andalas</h6>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection

@push('styles')
    <style>
        .partner-title {
            font-weight: 700;
            margin-bottom: 25px;
            border-left: 4px solid #28a745;
            padding-left: 10px;
        }

        .partner-card {
            background: #fff;
            padding: 30px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
        }

        .partner-card:hover {
            transform: translateY(-5px);
        }

        .partner-logo {
            height: 80px;
            width: auto;
            object-fit: contain;
            filter: grayscale(0%);
            transition: 0.3s ease;
        }

        .partner-card:hover .partner-logo {
            filter: grayscale(0%);
        }
    </style>
@endpush