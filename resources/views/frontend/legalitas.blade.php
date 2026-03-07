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
                            <a class="h3 text-white font-secondary" href="#">Legalitas</a>
                        </li>
                    </ul>
                    <p class="text-lighten">
                        Dokumen Legal Yayasan Sains Nusantara (YSN).
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <section class="section bg-light py-5">
        <div class="container">
            <div class="row mb-5">
                <!-- Kolom Kiri: Legalitas -->
                <div class="col-lg-7">
                    <div class="text-center mb-4">
                        <h3></h3>
                        <div class="divider mx-auto mb-4"></div>
                    </div>

                    <div class="mx-auto text-justify" style="max-width:800px;">
                        <hr class="my-2">
                        <br>

                        <h5 class="fw-bold">I. Akta Pendirian</h5>

                        <p>
                            Yayasan Sains Nusantara (YSN) didirikan secara resmi dengan akta pendirian yang telah
                            disahkan oleh notaris. Berikut adalah detail akta pendirian yayasan:
                        </p>

                        <div class="legalitas-card">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150"><strong>Tanggal</strong></td>
                                    <td>: 30 Juni 2005</td>
                                </tr>
                                <tr>
                                    <td><strong>Nomor Akta</strong></td>
                                    <td>: 26</td>
                                </tr>
                                <tr>
                                    <td><strong>Notaris</strong></td>
                                    <td>: Ali Gunawan Istio, SH.</td>
                                </tr>
                            </table>
                        </div>

                        <br>

                        <h5 class="fw-bold">II. Akta Perubahan</h5>

                        <p>
                            Seiring dengan perkembangan organisasi, YSN telah melakukan perubahan anggaran dasar
                            yang tertuang dalam akta perubahan sebagai berikut:
                        </p>

                        <div class="legalitas-card">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150"><strong>Tanggal</strong></td>
                                    <td>: 30 Maret 2023</td>
                                </tr>
                                <tr>
                                    <td><strong>Nomor Akta</strong></td>
                                    <td>: 09</td>
                                </tr>
                                <tr>
                                    <td><strong>Notaris</strong></td>
                                    <td>: Nida Desianti, M.KN</td>
                                </tr>
                            </table>
                        </div>

                        <br>

                        <h5 class="fw-bold">III. Nomor Induk Berusaha (NIB)</h5>

                        <p>
                            Yayasan Sains Nusantara telah terdaftar dalam sistem OSS (Online Single Submission)
                            dengan Nomor Induk Berusaha sebagai berikut:
                        </p>

                        <div class="legalitas-card">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150"><strong>NIB</strong></td>
                                    <td>: 2605230014371</td>
                                </tr>
                            </table>
                        </div>

                        <br>

                        <h5 class="fw-bold">IV. NPWP</h5>

                        <p>
                            Nomor Pokok Wajib Pajak (NPWP) Yayasan Sains Nusantara:
                        </p>

                        <div class="legalitas-card">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150"><strong>NPWP</strong></td>
                                    <td>: 01.688.968.3-101.000</td>
                                </tr>
                            </table>
                        </div>

                        <br>

                        <h5 class="fw-bold">V. Surat Izin Usaha Perdagangan (SIUP)</h5>

                        <p>
                            YSN memiliki Surat Izin Usaha Perdagangan (SIUP) dengan rincian sebagai berikut:
                        </p>

                        <div class="legalitas-card">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="150"><strong>Kode</strong></td>
                                    <td>: 72109</td>
                                </tr>
                                <tr>
                                    <td valign="top"><strong>Bidang Usaha</strong></td>
                                    <td>: Penelitian dan Pengembangan Ilmu Pengetahuan Alam dan Teknologi Rekayasa Lainnya</td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>

                <!-- Kolom Kanan: Donasi & Info -->
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
                                    Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="card border-0 shadow-sm text-white">
                        <div class="card-body">
                            <h5 class="card-title"><i class="ti-check-box mr-2"></i>Terverifikasi</h5>
                            <p class="card-text">
                                Semua dokumen legalitas Yayasan Sains Nusantara telah terverifikasi dan
                                terdaftar secara resmi di instansi pemerintah yang berwenang.
                            </p>
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
        /*     LEGALITAS STYLE       */
        /* ========================= */

        .legalitas-card {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .legalitas-card .table {
            margin-bottom: 0;
        }

        .legalitas-card .table td {
            padding: 8px 0;
            border: none;
        }

        .legalitas-card .table td:first-child {
            color: #495057;
        }

        .legalitas-card .table td:last-child {
            font-weight: 500;
            color: #212529;
        }
    </style>
@endpush
