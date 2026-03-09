@extends('layouts.frontend')

@section('content')
    <!-- page title -->
    <section class="page-title-section overlay" data-background="{{ asset('assets/fe/images/backgrounds/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item">
                            <a class="h3 text-white font-secondary" href="#">Kontak Kami</a>
                        </li>
                    </ul>
                    <p class="text-lighten">
                        Hubungi kami untuk informasi lebih lanjut tentang Yayasan Sains Nusantara.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <!-- contact -->
    <section class="section bg-light py-5">
        <div class="container">
            <div class="row">
                <!-- Kolom Kiri: Informasi Kontak -->
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="text-center mb-4">
                        <h3 class="font-weight-bold">Hubungi Kami</h3>
                        <div class="divider mx-auto mb-4"></div>
                    </div>

                    <div class="mx-auto" style="max-width: 400px;">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h5 class="font-weight-bold mb-3">
                                    <i class="bi bi-geo-alt-fill text-primary mr-2"></i>
                                    Alamat Kantor
                                </h5>
                                <p class="text-muted mb-4">
                                    Jln. Prada Utama, No. 55<br>
                                    Lamgugop, Banda Aceh<br>
                                    Aceh, Kode Pos 23122
                                </p>

                                <h5 class="font-weight-bold mb-3">
                                    <i class="bi bi-telephone-fill text-primary mr-2"></i>
                                    Telepon
                                </h5>
                                <p class="text-muted mb-4">
                                    0852 6000 0000
                                </p>

                                <h5 class="font-weight-bold mb-3">
                                    <i class="bi bi-envelope-fill text-primary mr-2"></i>
                                    Email
                                </h5>
                                <p class="text-muted mb-0">
                                    contact@ysn.or.id
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Peta Google Maps -->
                <div class="col-lg-7">
                    <div class="text-center mb-4">
                        <h3 class="font-weight-bold">Lokasi Kantor</h3>
                        <div class="divider mx-auto mb-4"></div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.053232904872!2d95.3196!3d5.5483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMzInNTQuNCJOIDk1wrAxOScxNi4yIk!5e0!3m2!1sid!2sid!4v1640000000000!5m2!1sid!2sid"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="https://www.google.com/maps/search/?api=1&query=5.5483,95.3196" target="_blank"
                            class="btn btn-primary">
                            <i class="bi bi-box-arrow-up-right mr-2"></i>
                            Buka di Google Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /contact -->
@endsection

@push('styles')
    <style>
        .bi {
            vertical-align: -0.125em;
        }

        .card {
            border-radius: 10px;
        }

        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        .divider {
            width: 60px;
            height: 3px;
            background-color: #ffc107;
            margin: 0 auto;
        }
    </style>
@endpush
