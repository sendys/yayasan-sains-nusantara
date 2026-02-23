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
                <div class="col-lg-7">
    <div class="text-center mb-4">
        <h3>Struktur Pengurus</h3>
        <div class="divider mx-auto mb-4"></div>
    </div>
    <br>

<div class="struktur-section">

    <!-- ===================== -->
    <!-- Pembina -->
    <!-- ===================== -->
    <h6 class="struktur-title">Pembina</h6>
    <div class="row">

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="struktur-card text-center">
                <img src="{{ asset('assets/fe/images/struktur/person-m-5.webp') }}" class="struktur-img" alt="Prof. Dr. Mustanir">
                <h6 class="mt-3 mb-1">Prof. Dr. Mustanir, M.Sc</h6>
                <small class="text-muted">Pembina</small>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="struktur-card text-center">
                <img src="{{ asset('assets/fe/images/struktur/person-m-7.webp') }}" class="struktur-img" alt="Prof. Dr. Ismail">
                <h6 class="mt-3 mb-1">Prof. Dr. Ismail, M.Sc</h6>
                <small class="text-muted">Pembina</small>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="struktur-card text-center">
                <img src="{{ asset('assets/fe/images/struktur/person-m-8.webp') }}" class="struktur-img" alt="Dr. Firdus">
                <h6 class="mt-3 mb-1">Dr. Firdus, M.Si</h6>
                <small class="text-muted">Pembina</small>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="struktur-card text-center">
                <img src="{{ asset('assets/fe/images/struktur/person-m-13.webp') }}" class="struktur-img" alt="Dr. Elly Sufriadi">
                <h6 class="mt-3 mb-1">Dr. Elly Sufriadi, M.Si</h6>
                <small class="text-muted">Pembina</small>
            </div>
        </div>

    </div>

    <!-- ===================== -->
    <!-- Pengawas -->
    <!-- ===================== -->
    <h6 class="struktur-title mt-4">Pengawas</h6>
    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="struktur-card text-center">
                <img src="{{ asset('assets/fe/images/struktur/person-m-8.webp') }}" class="struktur-img" alt="Dedy Yansyah">
                <h6 class="mt-3 mb-1">Dedy Yansyah, S.Si</h6>
                <small class="text-muted">Pengawas</small>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="struktur-card text-center">
                <img src="{{ asset('assets/fe/images/struktur/person-m-7.webp') }}" class="struktur-img" alt="Dr. Muslim">
                <h6 class="mt-3 mb-1">Dr. Muslim, M.Info.Tech.</h6>
                <small class="text-muted">Pengawas</small>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="struktur-card text-center">
                <img src="{{ asset('assets/fe/images/struktur/person-m-5.webp') }}" class="struktur-img" alt="Dr. Ardiansyah">
                <h6 class="mt-3 mb-1">Dr. Ardiansyah, B.Sc.Elect.Eng.</h6>
                <small class="text-muted">Pengawas</small>
            </div>
        </div>

    </div>

    <!-- ===================== -->
    <!-- Pengurus Harian -->
    <!-- ===================== -->
    <h6 class="struktur-title mt-4">Pengurus Harian</h6>
    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="struktur-card text-center">
                <img src="{{ asset('assets/fe/images/struktur/2.jpg') }}" class="struktur-img" alt="Kholil Yusra">
                <h6 class="mt-3 mb-1">Kholil Yusra, S.Si., M.Si.</h6>
                <small class="text-muted">Ketua</small>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="struktur-card text-center">
                <img src="{{ asset('assets/fe/images/struktur/3.jpg') }}" class="struktur-img" alt="Dedy Safran">
                <h6 class="mt-3 mb-1">Dedy Safran, S.Si</h6>
                <small class="text-muted">Sekretaris</small>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="struktur-card text-center">
                <img src="{{ asset('assets/fe/images/struktur/person-f-7.webp') }}" class="struktur-img" alt="Ruhaya">
                <h6 class="mt-3 mb-1">Ruhaya, S.Si., M.Ling.</h6>
                <small class="text-muted">Bendahara</small>
            </div>
        </div>

    </div>

    </div>
        </div>

                <!-- Kolom Kanan: Donasi & Blog -->
                <div class="col-lg-5">
                    <!-- Image Donasi -->
                    <div class="mb-5">
                        <div class="text-center mb-4">
                            <h3>Dukungan Anda</h3>
                            <div class="divider mx-auto mb-4"></div>
                        </div>
                        <div class="card border-0 shadow-sm">
                            <img src="{{ asset('assets/fe/images/about/donasi.png') }}" alt="Donasi" class="card-img-top"
                                style="height: 400px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">Mari Berdonasi</h5>
                                <p class="card-text">Dukungan Anda sangat berarti untuk kelanjutan program-program kami.</p>
                                <a href="{{ route('donasi') }}" class="btn btn-primary">
                                    Donasi Sekarang
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
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
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
