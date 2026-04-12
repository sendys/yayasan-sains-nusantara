@extends('layouts.frontend')

@section('content')
    <!-- page title -->
    <section class="page-title-section overlay" data-background="{{ asset('assets/fe/images/backgrounds/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item">
                            <a class="h3 text-white font-secondary" href="#">{{ __('donasi.page_title') }}</a>
                        </li>
                    </ul>
                    <p class="text-lighten">
                        {{ __('donasi.page_description') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <section class="section bg-light py-5">
        <div class="container">
            <div class="row mb-5">
                <!-- Kolom Kiri: Informasi Donasi -->
                <div class="col-12">
                    <div class="text-center mb-4">
                        <h3></h3>
                        <div class="divider mx-auto mb-4"></div>
                    </div>

                    <div class="mx-auto text-justify" style="max-width:800px;">
                        <hr class="my-2">
                        <br>

                        <h5 class="fw-bold">{{ __('donasi.page_desc_1') }}</h5>

                        <p>
                            {{ __('donasi.page_desc_2') }}
                        </p>

                        <br>

                        <h5 class="fw-bold">{{ __('donasi.page_desc_3') }}</h5>

                        <p>
                            {{ __('donasi.page_desc_4') }}
                        </p>

                        <!-- Rekening Bank -->
                        <div class="card border-0 shadow-sm mb-4 donasi-rekening-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="donasi-bank-icon me-3">
                                        <i class="ti-credit-card"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-0">&nbsp;&nbsp;Transfer Bank</h6>
                                        <small class="text-muted">&nbsp;&nbsp; Info Rekening Resmi </small>
                                    </div>
                                </div>
                                <table class="table table-borderless mb-0 donasi-table">
                                    <tbody>
                                        <tr>
                                            {{-- <td class="fw-semibold" style="width: 140px;">Bank</td> --}}
                                            <td>
                                                <h4>Bank Syariah Indonesia (BSI)</h4>
                                                <h3>Yayasan Sains Nusantara</h3>
                                                <h3>NOREK : 7261814239</h3>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>

                        <p>
                            {{ __('donasi.page_desc_5') }}
                        </p>

                    </div>
                </div>

                <!-- Kolom Kanan: Gambar & Ajakan -->
                {{--  <div class="col-lg-5">
                    <!-- Info Box Transparansi -->
                    <div class="card border-0 shadow-sm donasi-info-card">
                        <div class="card-body">
                            <h5 class="fw-bold text-center mb-4">
                                <i class="ti-shield me-2 text-primary"></i>
                                Transparansi & Akuntabilitas
                            </h5>
                            <ul class="donasi-transparency-list">
                                <li>
                                    <i class="ti-check-box me-2 text-success"></i>
                                    Laporan penggunaan dana dipublikasikan secara berkala
                                </li>
                                <li>
                                    <i class="ti-check-box me-2 text-success"></i>
                                    Dana donasi digunakan sepenuhnya untuk program YSN
                                </li>
                                <li>
                                    <i class="ti-check-box me-2 text-success"></i>
                                    Yayasan terdaftar resmi dan memiliki legalitas lengkap
                                </li>
                                <li>
                                    <i class="ti-check-box me-2 text-success"></i>
                                    Donatur akan menerima bukti tanda terima donasi
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* ========================= */
        /*      DONASI PAGE STYLE    */
        /* ========================= */

        /* Program Cards */
        .donasi-program-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
        }

        .donasi-program-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .donasi-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .donasi-icon i {
            font-size: 24px;
            color: #fff;
        }

        /* Rekening Card */
        .donasi-rekening-card {
            border-left: 4px solid #0d6efd !important;
            border-radius: 10px;
        }

        .donasi-bank-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .donasi-bank-icon i {
            font-size: 20px;
            color: #fff;
        }

        .donasi-table td {
            padding: 6px 8px;
            font-size: 0.95rem;
        }

        .btn-copy {
            padding: 2px 8px;
            font-size: 12px;
            border-radius: 5px;
        }

        .btn-copy:hover {
            background: #0d6efd;
            color: #fff;
        }

        /* Konfirmasi List */
        .donasi-konfirmasi-list {
            list-style: none;
            padding-left: 0;
        }

        .donasi-konfirmasi-list li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            font-size: 0.95rem;
        }

        .donasi-konfirmasi-list li:last-child {
            border-bottom: none;
        }

        /* Info Card */
        .donasi-info-card {
            border-radius: 10px;
            background: linear-gradient(135deg, #f8f9ff 0%, #e8f0fe 100%);
        }

        /* Transparency List */
        .donasi-transparency-list {
            list-style: none;
            padding-left: 0;
        }

        .donasi-transparency-list li {
            padding: 8px 0;
            font-size: 0.95rem;
            line-height: 1.6;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function copyRekening() {
            var noRek = document.getElementById('noRekening').innerText;
            navigator.clipboard.writeText(noRek).then(function() {
                // Tampilkan notifikasi berhasil
                var btn = document.querySelector('.btn-copy');
                var originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="ti-check"></i>';
                btn.classList.remove('btn-outline-primary');
                btn.classList.add('btn-success');
                setTimeout(function() {
                    btn.innerHTML = originalHtml;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-outline-primary');
                }, 2000);
            }).catch(function(err) {
                // Fallback untuk browser yang tidak support clipboard API
                var textArea = document.createElement('textarea');
                textArea.value = noRek;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                alert('No. Rekening berhasil disalin: ' + noRek);
            });
        }
    </script>
@endpush
