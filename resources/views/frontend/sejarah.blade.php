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
                            <!--  <a class="h2 text-primary font-secondary" href="#">Sejarah</a> -->
                        </li>
                    </ul>
                    <p class="text-lighten">
                        <!--  Sejarah didirikan Yayasan Sains Nusantara (YSN). -->
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
                        <h3>Sejarah Kami</h3>
                        <div class="divider mx-auto mb-4"></div>
                    </div>

                    <div class="mx-auto text-justify" style="max-width:800px;">
                        <hr class="my-2">
                        <br>
                        <div id="accordion">

                            <!-- 2004 -->
                            <div class="card mb-2 border-0 shadow-sm">
                                <div class="card-header p-0 bg-white" id="heading2004">
                                    <button class="btn btn-block text-left d-flex align-items-center py-3 px-4 collapsed"
                                        type="button" data-toggle="collapse" data-target="#collapse2004"
                                        aria-expanded="true" aria-controls="collapse2004">
                                        <span class="font-weight-normal">Titik Refleksi Kemanusiaan</span>
                                        <i class="ti-angle-down ml-auto toggle-icon"></i>
                                    </button>
                                </div>
                                <div id="collapse2004" class="collapse show" aria-labelledby="heading2004"
                                    data-parent="#accordion">
                                    <div class="card-body text-dark">
                                        Tsunami Aceh menjadi momentum lahirnya gagasan membangun lembaga berbasis sains
                                        untuk pemulihan dan pembangunan masyarakat.
                                    </div>
                                </div>
                            </div>

                            <!-- 2005 -->
                            <div class="card mb-2 border-0 shadow-sm">
                                <div class="card-header p-0 bg-white" id="heading2005">
                                    <button class="btn btn-block text-left d-flex align-items-center py-3 px-4 collapsed"
                                        type="button" data-toggle="collapse" data-target="#collapse2005"
                                        aria-expanded="false" aria-controls="collapse2005">
                                        <span class="font-weight-normal">Pendirian Yayasan</span>
                                        <i class="ti-angle-down ml-auto toggle-icon"></i>
                                    </button>
                                </div>
                                <div id="collapse2005" class="collapse" aria-labelledby="heading2005"
                                    data-parent="#accordion">
                                    <div class="card-body text-dark">
                                        Yayasan Sains Nusantara resmi didirikan sebagai lembaga independen yang fokus
                                        pada
                                        pengembangan ilmu pengetahuan dan pemberdayaan masyarakat.
                                    </div>
                                </div>
                            </div>

                            <!-- 2007 -->
                            <div class="card mb-2 border-0 shadow-sm">
                                <div class="card-header p-0 bg-white" id="heading2007">
                                    <button class="btn btn-block text-left d-flex align-items-center py-3 px-4 collapsed"
                                        type="button" data-toggle="collapse" data-target="#collapse2007"
                                        aria-expanded="false" aria-controls="collapse2007">
                                        <span class="font-weight-normal">Penguatan Legalitas</span>
                                        <i class="ti-angle-down ml-auto toggle-icon"></i>
                                    </button>
                                </div>
                                <div id="collapse2007" class="collapse" aria-labelledby="heading2007"
                                    data-parent="#accordion">
                                    <div class="card-body text-dark">
                                        Penyempurnaan struktur organisasi dan legalitas untuk memperluas jejaring
                                        kemitraan
                                        nasional dan internasional.
                                    </div>
                                </div>
                            </div>

                            <!-- 2016–2020 -->
                            <div class="card mb-2 border-0 shadow-sm">
                                <div class="card-header p-0 bg-white" id="heading2016">
                                    <button class="btn btn-block text-left d-flex align-items-center py-3 px-4 collapsed"
                                        type="button" data-toggle="collapse" data-target="#collapse2016"
                                        aria-expanded="false" aria-controls="collapse2016">
                                        <span class="font-weight-normal">Ekspansi Program Strategis</span>
                                        <i class="ti-angle-down ml-auto toggle-icon"></i>
                                    </button>
                                </div>
                                <div id="collapse2016" class="collapse" aria-labelledby="heading2016"
                                    data-parent="#accordion">
                                    <div class="card-body text-dark">
                                        Fokus pada isu lingkungan, ketahanan bencana, ekonomi kemasyarakatan, dan
                                        penguatan
                                        kapasitas desa.
                                    </div>
                                </div>
                            </div>

                            <!-- 2021–Sekarang -->
                            <div class="card mb-2 border-0 shadow-sm">
                                <div class="card-header p-0 bg-white" id="heading2021">
                                    <button class="btn btn-block text-left d-flex align-items-center py-3 px-4 collapsed"
                                        type="button" data-toggle="collapse" data-target="#collapse2021"
                                        aria-expanded="false" aria-controls="collapse2021">
                                        <span class="font-weight-normal">Transformasi &amp; Inovasi</span>
                                        <i class="ti-angle-down ml-auto toggle-icon"></i>
                                    </button>
                                </div>
                                <div id="collapse2021" class="collapse" aria-labelledby="heading2021"
                                    data-parent="#accordion">
                                    <div class="card-body text-dark">
                                        Transformasi kelembagaan menuju model kolaboratif lintas sektor dengan
                                        pendekatan
                                        teknologi terapan.
                                    </div>
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
                            <img src="{{ asset('assets/fe/images/about/donasi.jpg') }}" alt="Donasi" class="card-img-top"
                                style="height: 400px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">Mari Berdonasi</h5>
                                <p class="card-text">Dukungan Anda sangat berarti untuk kelanjutan program-program kami.</p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalDonasi">
                                    Donasi Sekarang
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Section (Max 4) -->
                    <div class="mb-4">
                        <div class="text-center mb-4">
                            <h3>Blog Terbaru</h3>
                            <div class="divider mx-auto mb-4"></div>
                        </div>

                        <div class="row">
                            <!-- Blog 1 -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <img src="path/to/blog1.jpg" class="card-img-top" alt="Blog 1"
                                        style="height: 150px; object-fit: cover;">
                                    <div class="card-body">
                                        <h6 class="card-title">Judul Blog 1</h6>
                                        <p class="card-text small">Ringkasan singkat dari artikel blog...</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Blog 2 -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <img src="path/to/blog2.jpg" class="card-img-top" alt="Blog 2"
                                        style="height: 150px; object-fit: cover;">
                                    <div class="card-body">
                                        <h6 class="card-title">Judul Blog 2</h6>
                                        <p class="card-text small">Ringkasan singkat dari artikel blog...</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Blog 3 -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <img src="path/to/blog3.jpg" class="card-img-top" alt="Blog 3"
                                        style="height: 150px; object-fit: cover;">
                                    <div class="card-body">
                                        <h6 class="card-title">Judul Blog 3</h6>
                                        <p class="card-text small">Ringkasan singkat dari artikel blog...</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Blog 4 -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm">
                                    <img src="path/to/blog4.jpg" class="card-img-top" alt="Blog 4"
                                        style="height: 150px; object-fit: cover;">
                                    <div class="card-body">
                                        <h6 class="card-title">Judul Blog 4</h6>
                                        <p class="card-text small">Ringkasan singkat dari artikel blog...</p>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Donasi -->
    <div class="modal fade" id="modalDonasi" tabindex="-1" aria-labelledby="modalDonasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalDonasiLabel">Saluran Donasi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- Bagian Rekening Bank -->
                    <h6 class="fw-bold mb-3 text-primary">Transfer Bank</h6>

                    <!-- Bank BCA -->
                    <div class="card bg-light border-0 mb-2">
                        <div class="card-body py-2 d-flex justify-content-between align-items-center">
                            <div>
                                <strong class="d-block">Bank BCA</strong>
                                <small class="text-muted">a.n. Yayasan Sains Nusantara</small>
                                <div class="fw-bold mt-1">1234567890</div>
                            </div>
                            <button class="btn btn-sm btn-outline-secondary" onclick="copyText('1234567890')">
                                <i class="bi bi-clipboard"></i> Salin
                            </button>
                        </div>
                    </div>

                    <!-- Bank Mandiri -->
                    <div class="card bg-light border-0 mb-2">
                        <div class="card-body py-2 d-flex justify-content-between align-items-center">
                            <div>
                                <strong class="d-block">Bank Mandiri</strong>
                                <small class="text-muted">a.n. Yayasan Sains Nusantara</small>
                                <div class="fw-bold mt-1">9876543210</div>
                            </div>
                            <button class="btn btn-sm btn-outline-secondary" onclick="copyText('9876543210')">
                                <i class="bi bi-clipboard"></i> Salin
                            </button>
                        </div>
                    </div>

                    <!-- Bank BNI -->
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body py-2 d-flex justify-content-between align-items-center">
                            <div>
                                <strong class="d-block">Bank BNI</strong>
                                <small class="text-muted">a.n. Yayasan Sains Nusantara</small>
                                <div class="fw-bold mt-1">5551234567</div>
                            </div>
                            <button class="btn btn-sm btn-outline-secondary" onclick="copyText('5551234567')">
                                <i class="bi bi-clipboard"></i> Salin
                            </button>
                        </div>
                    </div>

                    <hr>

                    <!-- Bagian QRIS -->
                    <div class="text-center mb-4">
                        <h6 class="fw-bold text-primary">Scan QRIS</h6>
                        <div class="p-3 border rounded d-inline-block bg-white">
                            <!-- Ganti src dengan path gambar QRIS Anda -->
                            <img src="{{ asset('assets/fe/images/qris-placeholder.png') }}" alt="QRIS Code"
                                style="width: 200px; height: 200px; object-fit: contain;">
                        </div>
                        <p class="small text-muted mt-2">
                            Mendukung: GoPay, OVO, Dana, LinkAja, ShopeePay, Mobile Banking
                        </p>
                        <p class="small">Scan kode QR di atas untuk donasi cepat dan mudah</p>
                    </div>

                    <!-- Cara Berdonasi -->
                    <div class="bg-light p-3 rounded mb-3">
                        <h6 class="fw-bold">Cara Berdonasi:</h6>
                        <ol class="small ps-3 mb-0">
                            <li>Pilih metode pembayaran (Transfer Bank atau QRIS)</li>
                            <li>Lakukan transfer sesuai nominal yang Anda inginkan</li>
                            <li>Konfirmasi donasi Anda melalui WhatsApp di bawah</li>
                        </ol>
                    </div>

                    <!-- Tombol Konfirmasi WA -->
                    <div class="d-grid gap-2">
                        <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20sudah%20melakukan%20donasi."
                            target="_blank" class="btn btn-success">
                            <i class="bi bi-whatsapp"></i> Konfirmasi via WhatsApp
                        </a>
                    </div>

                    <p class="text-center small text-muted mt-3 mb-0">Donasi Anda aman dan tersalurkan dengan transparan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification (Muncul saat copy) -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="copyToast" class="toast align-items-center text-white bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle-fill me-2"></i> Nomor rekening berhasil disalin!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

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

        /* ========================= */
        /*      ACCORDION SOFT       */
        /* ========================= */

        #accordion .card {
            border-radius: 12px !important;
            overflow: hidden;
            border: none !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            transition: box-shadow 0.3s ease;
            margin-bottom: 10px;
        }

        #accordion .card:hover {
            box-shadow: 0 4px 18px rgba(0, 123, 255, 0.12);
        }

        #accordion .card-header {
            background: #fff;
            border: none;
            padding: 0;
        }

        #accordion .card-header .btn {
            color: #444;
            font-size: 15px;
            font-weight: 500;
            border-radius: 12px !important;
            padding: 14px 20px;
            transition: background 0.25s ease, color 0.25s ease, border-radius 0.25s ease;
            background: #fff;
            border: none;
            outline: none !important;
            box-shadow: none !important;
        }

        #accordion .card-header .btn:not(.collapsed) {
            background: linear-gradient(135deg, #4e9af1, #007bff);
            color: #fff;
            border-radius: 12px 12px 0 0 !important;
        }

        #accordion .card-header .btn:hover.collapsed {
            background: #f0f6ff;
            color: #007bff;
        }

        #accordion .toggle-icon {
            font-size: 11px;
            transition: transform 0.35s ease, color 0.25s ease;
            color: #adb5bd;
        }

        #accordion .card-header .btn:not(.collapsed) .toggle-icon {
            transform: rotate(180deg);
            color: #fff;
        }

        #accordion .card-body {
            font-size: 14.5px;
            line-height: 1.75;
            padding: 14px 20px 16px;
            border-top: 1px solid #e8f0fe;
            background: #fafcff;
            color: #212529;
        }
    </style>

@endpush

@push('scripts')
    <script>
        // Putar ikon saat accordion dibuka/tutup
        $(document).ready(function () {
            $('#accordion').on('show.bs.collapse', function (e) {
                $(e.target).closest('.card').find('.toggle-icon').addClass('rotate');
            }).on('hide.bs.collapse', function (e) {
                $(e.target).closest('.card').find('.toggle-icon').removeClass('rotate');
            });
        });
    </script>

    <script>
        function copyText(text) {
            // Menyalin teks ke clipboard
            navigator.clipboard.writeText(text).then(function () {
                // Menampilkan Toast notifikasi
                var toastEl = document.getElementById('copyToast');
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }, function (err) {
                console.error('Gagal menyalin teks: ', err);
            });
        }
    </script>
@endpush