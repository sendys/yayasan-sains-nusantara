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
                             <a class="h3 text-white font-secondary" href="#">Visi &amp; Misi</a>
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
        <h3>Visi &amp; Misi</h3>
        <div class="divider mx-auto mb-4"></div>
    </div>

    <div class="mx-auto text-justify" style="max-width:800px;">
        <hr class="my-2">
        <br>

        <h5 class="fw-bold">I. Latar Belakang</h5>

        <p>
            Yayasan Sains Nusantara (YSN) adalah sebuah lembaga swadaya masyarakat yang didirikan di 
            Banda Aceh pada tahun 2005. Awalnya bernama Yayasan Pengembangan Sains Nusantara 
            (YPSN), didirikan untuk membantu Forum Mahasiswa Peduli Aceh (KoMPA) dalam 
            memberikan bantuan kepada para korban tsunami. Organisasi ini memulai kiprahnya melalui 
            program rehabilitasi sosial-ekonomi, pemberdayaan perempuan, dan pelatihan 
            keterampilan, bekerja sama dengan mitra internasional seperti OXFAM, UNIFEM, dan Islamic 
            Relief. Pada 2023, nama resmi menjadi Yayasan Sains Nusantara (YSN) untuk memperkuat 
            identitas dan memperluas cakupan kerja di tingkat lokal, nasional, dan internasional. Seiring 
            berjalannya waktu, YSN telah berkembang menjadi lembaga yang lebih luas yang 
            berkomitmen untuk memajukan kesejahteraan masyarakat.
        </p>

        <p>
            Yayasan ini bersifat independen, nirlaba, dan tidak berafiliasi dengan organisasi partai politik mana pun. Sejak awal berdirinya, YSN telah terlibat aktif dalam membantu pemerintah dalam 
            program-program sosial, khususnya dalam pemberdayaan perekonomian masyarakat dan 
            memajukan pendidikan. Organisasi ini telah menerima sertifikasi pemerintah untuk mendirikan dan memberikan pelatihan di berbagai bidang, termasuk pertanian, perkebunan, peternakan, perikanan, pengelolaan sumber daya alam, dan konservasi. 
        </p>

        <br>

        <h5 class="fw-bold">II. Visi dan Misi</h5>

        <h6 class="fw-semibold mt-3">Visi:</h6>
        <p>
            Menjadi wadah pengembangan ilmu pengetahuan untuk mewujudkan kesejahteraan masyarakat,
            mandiri berbasiskan sains secara arif dan bijaksana.
        </p>

       <h6 class="fw-bold mt-3">Misi:</h6>

        <ol class="misi-list">
            <li>
                Membantu pemerintah dalam upaya mewujudkan kesejahteraan masyarakat,
                meningkatkan mutu pendidikan dan penerapan teknologi terpadu.
            </li>
            <li>
                Melakukan pengembangan dan penerapan sains dalam proses peningkatan
                perekonomian masyarakat yang efisien dan ramah lingkungan.
            </li>
            <li>
                Melakukan kajian dan penelitian sumber daya alam untuk dapat berguna secara 
                bijaksana terhadap kesejahteraan masyarakat; dan
            </li>
            <li>
                Mempersiapkan kader dan tenaga kerja yang handal sesuai potensi sumber daya alam 
                di Indonesia khususnya di Provinsi Aceh.
            </li>
        </ol>

        <br>

<h5 class="fw-bold">III. Bidang Pokok</h5>

<p>
    Adapun bidang pokok gerakan YSN sebagaimana tercantum dalam akta pendiriannya meliputi:
</p>

<ol class="bidang-list">

    <!-- 1. Bidang Sosial -->
    <li>
        <strong>Bidang Sosial</strong>

        <ul class="sub-bidang">
            <li>
                Menyelenggarakan program-program pendidikan yang bersifat umum, kejuruan,
                maupun yang bersifat khusus dan program-program pelatihan;
            </li>
            <li>
                Mengadakan penelitian, pengkajian, dan studi pendalaman terhadap ilmu pengetahuan;
            </li>
            <li>
                Pengembangan riset dan teknologi;
            </li>
            <li>
                Pengembangan dan pemberdayaan masyarakat; dan
            </li>
            <li>
                Pemrakarsaan dan penyelenggaraan kegiatan penyuluhan, pelatihan, dialog,
                ceramah, seminar, upgrading, workshop, forum diskusi, lokakarya,
                dan simposium ilmiah.
            </li>
        </ul>
    </li>

    <!-- 2. Bidang Kemanusiaan -->
    <li>
        <strong>Bidang Kemanusiaan</strong>

        <ul class="sub-bidang">
            <li>Memberikan bantuan kepada korban bencana alam;</li>
            <li>Memberikan bantuan kepada pengungsi;</li>
            <li>Memberikan bantuan kepada tuna wisma, fakir miskin, dan gelandangan;</li>
            <li>Memberikan perlindungan konsumen; dan</li>
            <li>Melestarikan lingkungan hidup.</li>
        </ul>
    </li>

</ol>
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

                    <!-- Blog Section (Max 4) -->
                   <!--  <div class="mb-4">
                        <div class="text-center mb-4">
                            <h3>Blog Terbaru</h3>
                            <div class="divider mx-auto mb-4"></div>
                        </div>

                        <div class="row">
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
                    </div> -->
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>

/* ========================= */
/*        MISI STYLE FINAL   */
/* ========================= */

/* ========================= */
/*     LIST CONTENT STYLE    */
/* ========================= */

.misi-list,
.bidang-list {
    list-style-type: decimal !important;
    padding-left: 30px !important;
    margin-top: 12px;
}

.misi-list li,
.bidang-list > li {
    margin-bottom: 18px;
    line-height: 1.9;
    text-align: justify;
}

/* Sub list untuk bidang */
.sub-bidang {
    list-style-type: disc !important;
    padding-left: 25px !important;
    margin-top: 10px;
}

.sub-bidang li {
    margin-bottom: 10px;
    line-height: 1.8;
}

</style>
@endpush
