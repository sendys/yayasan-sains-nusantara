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
                            <a class="h3 text-white font-secondary" href="#">Kebijakan Privasi</a>
                        </li>
                    </ul>
                    <p class="text-lighten">
                        Komitmen kami dalam melindungi privasi dan data pribadi Anda.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <section class="section bg-light py-5">
        <div class="container">
            <div class="row mb-5">
                <!-- Kolom Kiri: Kebijakan Privasi -->
                <div class="col-lg-12">
                    <div class="text-center mb-4">
                        <h3></h3>
                        <div class="divider mx-auto mb-4"></div>
                    </div>

                    <div class="mx-auto text-justify" style="max-width:800px;">
                        <hr class="my-2">
                        <br>

                        <h5 class="fw-bold">Tujuan Pengumpulan Data</h5>
                        <p>
                            YSN tidak akan menggunakan data pribadi Anda untuk kepentingan selain YSN. Tujuan pengumpulan
                            dan penggunaan data pribadi Anda adalah:
                        </p>
                        <ul class="misi-list" style="list-style-type: disc !important; padding-left: 25px !important;">
                            <li>Untuk mengirimkan informasi, newsletters, dan materi lainnya tentang YSN dalam bentuk
                                elektronik</li>
                            <li>Untuk mempromosikan kegiatan penggalangan dana YSN, baik melalui email maupun telepon</li>
                        </ul>

                        <br>

                        <h5 class="fw-bold">Jenis Data yang Dikumpulkan YSN</h5>
                        <p>
                            YSN mengumpulkan jenis-jenis data pribadi berikut:
                        </p>
                        <ul class="misi-list" style="list-style-type: disc !important; padding-left: 25px !important;">
                            <li>Nama</li>
                            <li>Nomor telepon</li>
                            <li>Alamat email</li>
                        </ul>

                        <br>

                        <h5 class="fw-bold">Pemasaran Langsung</h5>
                        <p>
                            YSN akan menggunakan data pribadi Anda untuk tujuan pemasaran langsung dengan hanya menggunakan
                            informasi kontak pribadi Anda seperti nama, nomor telepon, dan/atau alamat email Anda dan hanya
                            setelah menerima persetujuan Anda untuk menggunakan data tersebut.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .misi-list {
            margin-top: 12px;
        }

        .misi-list li {
            margin-bottom: 10px;
            line-height: 1.9;
            text-align: justify;
        }
    </style>
@endpush