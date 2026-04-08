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
                            <a class="h3 text-white font-secondary" href="#">{{ __('legalitas.page_title') }}</a>
                        </li>
                    </ul>
                    <p class="text-lighten">
                        {{ __('legalitas.page_description') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <section class="section bg-light py-5">
        <div class="container">
            <div class="row mb-5">
               <!-- Kolom Kiri: Profil Lembaga -->
<div class="col-lg-8">

    <div class="text-center mb-5">
        <div class="divider mx-auto"></div>
    </div>

    <div class="mx-auto" style="max-width:850px;">

        <!-- PROFIL LEMBAGA -->
        <div class="card shadow-sm border-0 mb-4 legalitas-modern">
            <div class="card-body p-4">

                <h5 class="fw-bold mb-3">
                    <i class="ti-home text-primary mr-2"></i>
                    {{ __('legalitas.institution_profile') }}
                </h5>

                <p class="text-black">
                    {{ __('legalitas.institution_description') }}
                </p>

                <table class="table table-borderless mt-3">
                    <tr>
                        <td width="200"><strong>{{ __('legalitas.institution_name') }}</strong></td>
                        <td>: Yayasan Sains Nusantara</td>
                    </tr>
                    <tr>
                        <td><strong>{{ __('legalitas.address') }}</strong></td>
                        <td>: Jl. Prada Utama No. 55, Lamgugob, Syiah Kuala, Banda Aceh</td>
                    </tr>
                    <tr>
                        <td><strong>{{ __('legalitas.email') }}</strong></td>
                        <td>: support@ysn.ac.id</td>
                    </tr>
                    <tr>
                        <td><strong>{{ __('legalitas.founded_year') }}</strong></td>
                        <td>: 30 Juni 2005</td>
                    </tr>
                </table>

            </div>
        </div>

        <!-- BIDANG KEGIATAN -->
        <div class="card shadow-sm border-0 mb-4 legalitas-modern">
            <div class="card-body p-4">

                <h5 class="fw-bold mb-3">
                    <i class="ti-light-bulb text-primary mr-2"></i>
                    {{ __('legalitas.business_field') }}
                </h5>

                <p class="text-black">
                    {{ __('legalitas.business_description') }}
                </p>

                <table class="table table-borderless mt-3">
                    <tr>
                        <td width="200"><strong>{{ __('legalitas.kbli') }}</strong></td>
                        <td>: 72109</td>
                    </tr>
                    <tr>
                        <td><strong>{{ __('legalitas.activity_field') }}</strong></td>
                        <td>: {{ __('legalitas.activity_description') }}</td>
                    </tr>
                </table>

            </div>
        </div>

        <!-- LEGALITAS -->
        <div class="card shadow-sm border-0 mb-4 legalitas-modern">
            <div class="card-body p-4">

                <h5 class="fw-bold mb-3">
                    <i class="ti-id-badge text-primary mr-2"></i>
                    {{ __('legalitas.legality') }}
                </h5>

                <table class="table table-borderless">
                    <tr>
                        <td width="200"><strong>{{ __('legalitas.nib') }}</strong></td>
                        <td>: 2605230014371</td>
                    </tr>
                    <tr>
                        <td><strong>{{ __('legalitas.npwp') }}</strong></td>
                        <td>: 01.688.968.3-101.000</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

</div>

                <!-- Kolom Kanan: Donasi & Info -->
                <div class="col-lg-4">
                    <!-- Image Donasi -->
                    <div class="mb-4">
                        <div class="text-center mb-4">
                            <h3>{{ __('legalitas.donation_title') }}</h3>
                            <div class="divider mx-auto mb-4"></div>
                        </div>
                        <div class="card border-0 shadow-sm">
                           <img src="{{ asset('assets/fe/images/about/donasi.png') }}" alt="Donasi" class="card-img-top"
                                style="height: 300px; with:100px;">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ __('legalitas.donation_title') }}</h5>
                                <p class="card-text">{{ __('legalitas.donation_description') }}</p>
                                <a href="{{ route('donasi') }}" class="btn btn-primary">
                                    {{ __('legalitas.donation_button') }}
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
