<!DOCTYPE html>
<html lang="zxx">

<head>
  
  @include('layouts.frontend.head-css')

</head>

<body>

  <!-- header -->
  <header class="fixed-top header">
    <!-- top header -->
    @include('layouts.frontend.top-header')
    <!-- navbar -->
    <div class="navigation w-100">
      <div class="container">
         @include('layouts.frontend.navbar')
      </div>
    </div>
  </header>
  <!-- /header -->

  <!-- hero slider -->
  <section class="hero-section overlay bg-cover" data-background="{{ asset('assets/fe/images/banner/banner-1.jpg') }}">
    <div class="container">
      <div class="hero-slider">
        <!-- slider item -->
        <div class="hero-slider-item">
          <div class="row">
            <div class="col-md-8">
              <h3 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Isu Strategis</h3>
              <h1 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Lingkungan & Perubahan Iklim</h1>
              <p class="text-muted mb-4" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".4">Melalui kolaborasi multipihak dan pemberdayaan
                masyarakat, kami mendorong solusi nyata untuk menciptakan lingkungan yang lestari, tangguh, dan
                berkeadilan bagi generasi kini dan mendatang.</p>
              <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutRight" data-delay-out="5"
                data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".7">Detail</a>
            </div>
          </div>
        </div>
        <!-- slider item -->
        <div class="hero-slider-item">
          <div class="row">
            <div class="col-md-8">
              <h3 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Isu Strategis</h3>
              <h1 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Penanggulangan Bencana</h1>
              <p class="text-muted mb-4" data-animation-out="fadeOutUp" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInDown" data-delay-in=".4">Melalui kolaborasi dan aksi kemanusiaan yang
                terkoordinasi, kami berkomitmen mendukung masyarakat agar lebih siap, tangguh, dan mampu bangkit dari
                setiap bencana.</p>
              <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutUp" data-delay-out="5"
                data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".7">Detail</a>
            </div>
          </div>
        </div>
        <!-- slider item -->
        <div class="hero-slider-item">
          <div class="row">
            <div class="col-md-8">
              <h3 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Isu Strategis</h3>
              <h1 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Ekonomi Kemasyarakatan</h1>
              <p class="text-muted mb-4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInUp" data-delay-in=".4">Melalui pemberdayaan ekonomi berbasis komunitas, kami
                mendorong kemandirian, inovasi, dan pertumbuhan ekonomi yang adil serta berdampak langsung bagi
                masyarakat.</p>
              <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutDown" data-delay-out="5"
                data-duration-in=".3" data-animation-in="zoomIn" data-delay-in=".7">Detail</a>
            </div>
          </div>
        </div>
        <!-- slider item -->
        <div class="hero-slider-item">
          <div class="row">
            <div class="col-md-8">
              <h3 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Isu Strategis</h3>
              <h1 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Pendidikan & Vokasi</h1>
              <p class="text-muted mb-4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInUp" data-delay-in=".4">Melalui program pendidikan dan vokasi, kami mendorong
                lahirnya generasi yang kompeten, mandiri, dan siap menghadapi dinamika masa depan.</p>
              <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutDown" data-delay-out="5"
                data-duration-in=".3" data-animation-in="zoomIn" data-delay-in=".7">Detail</a>
            </div>
          </div>
        </div>
        <!-- slider item -->
        <div class="hero-slider-item">
          <div class="row">
            <div class="col-md-8">
              <h3 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Isu Strategis</h3>
              <h1 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Pemberdayaan Desa</h1>
              <p class="text-muted mb-4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInUp" data-delay-in=".4">Melalui pendekatan kolaboratif dan berbasis potensi
                lokal, kami mendukung desa agar tumbuh mandiri, tangguh, dan mampu meningkatkan kesejahteraan warganya.
              </p>
              <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutDown" data-delay-out="5"
                data-duration-in=".3" data-animation-in="zoomIn" data-delay-in=".7">Detail</a>
            </div>
          </div>
        </div>
        <!-- slider item -->
        <div class="hero-slider-item">
          <div class="row">
            <div class="col-md-8">
              <h3 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Isu Strategis</h3>
              <h1 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Pertanian & Pangan</h1>
              <p class="text-muted mb-4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInUp" data-delay-in=".4">Melalui pendekatan berbasis komunitas dan teknologi
                tepat guna, kami mendorong sistem pertanian yang produktif, ramah lingkungan, dan mampu menjamin
                ketahanan pangan bagi generasi mendatang.</p>
              <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutDown" data-delay-out="5"
                data-duration-in=".3" data-animation-in="zoomIn" data-delay-in=".7">Detail</a>
            </div>
          </div>
        </div>
        <!-- slider item -->
        <div class="hero-slider-item">
          <div class="row">
            <div class="col-md-8">
              <h3 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Isu Strategis</h3>
              <h1 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Energi & Transportasi</h1>
              <p class="text-muted mb-4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInUp" data-delay-in=".4">Melalui inovasi, kolaborasi, dan pendekatan berbasis
                kebutuhan masyarakat, kami mendukung terwujudnya sistem energi dan transportasi yang inklusif, bersih,
                dan berkelanjutan.</p>
              <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutDown" data-delay-out="5"
                data-duration-in=".3" data-animation-in="zoomIn" data-delay-in=".7">Detail</a>
            </div>
          </div>
        </div>
        <!-- slider item -->
        <div class="hero-slider-item">
          <div class="row">
            <div class="col-md-8">
              <h3 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Isu Strategis</h3>
              <h1 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInLeft" data-delay-in=".1">Pemberdayaan Masyarakat Adat</h1>
              <p class="text-muted mb-4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3"
                data-animation-in="fadeInUp" data-delay-in=".4">Melalui pendekatan yang inklusif dan menghormati nilai
                budaya, kami berkomitmen mendukung kemandirian serta keberlanjutan kehidupan masyarakat adat secara adil
                dan bermartabat.</p>
              <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutDown" data-delay-out="5"
                data-duration-in=".3" data-animation-in="zoomIn" data-delay-in=".7">Detail</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- /hero slider -->

  <!-- banner-feature -->
  <section class="bg-gray">
    <div class="container-fluid p-0">
      <div class="row no-gutters">
        <div class="col-xl-4 col-lg-5 align-self-end">
          <!-- Slider Start -->
          <div id="bannerFeatureCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#bannerFeatureCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#bannerFeatureCarousel" data-slide-to="1"></li>
              <li data-target="#bannerFeatureCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100 img-fluid" src="{{ asset('assets/fe/images/banner/banner-feature-1.png') }}"
                  alt="Banner Feature 1">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100 img-fluid" src="{{ asset('assets/fe/images/banner/banner-feature-1.png') }}"
                  alt="Banner Feature 2">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100 img-fluid" src="{{ asset('assets/fe/images/banner/banner-feature-1.png') }}"
                  alt="Banner Feature 3">
              </div>
            </div>

          </div>
          <!-- Slider End -->
        </div>
        <div class="col-xl-8 col-lg-7">
          <div class="row feature-blocks bg-gray justify-content-between">
            <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
              <i class="ti-book mb-xl-4 mb-lg-3 mb-4 feature-icon"></i>
              <h3 class="mb-xl-4 mb-lg-3 mb-4">Penelitian dan Kajian SDM</h3>
              <p>Melakukan penelitian mendalam terkait sumber daya alam untuk pemanfaatan yang berkelanjutan.</p>
            </div>
            <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
              <i class="ti-blackboard mb-xl-4 mb-lg-3 mb-4 feature-icon"></i>
              <h3 class="mb-xl-4 mb-lg-3 mb-4">Pemberdayaan Masyarakat</h3>
              <p>Menerapkan teknologi tepat guna untuk meningkatkan perekonomian masyarakat secara efisien.</p>
            </div>
            <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
              <i class="ti-agenda mb-xl-4 mb-lg-3 mb-4 feature-icon"></i>
              <h3 class="mb-xl-4 mb-lg-3 mb-4">Konservasi Lingkungan</h3>
              <p>Terlibat aktif dalam penyusunan profil biodiversitas dan rencana induk pengelolaan keanekaragaman
                hayati, salah satunya di Provinsi Aceh.</p>
            </div>
            <div class="col-sm-6 col-xl-5 mb-xl-5 mb-lg-3 mb-4 text-center text-sm-left">
              <i class="ti-write mb-xl-4 mb-lg-3 mb-4 feature-icon"></i>
              <h3 class="mb-xl-4 mb-lg-3 mb-4">Pengembangan SDM</h3>
              <p>Mempersiapkan kader dan tenaga kerja yang handal sesuai dengan potensi sumber daya alam.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /banner-feature -->

  <!-- about us -->
  <section class="section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 order-2 order-md-1">
          <h2 class="section-title">Tentang Yayasan Sains Nusantara</h2>
          <p style="text-align: justify;">YSN adalah Lembaga Nirlaba yang fokus pada Penelitian, Pelatihan dan Rekayasa
            Teknologi Terapan serta berbagai terobosan menjawab dinamika masyarakat untuk kesejahteraan. YSN berdiri
            Tahun 2005 sebagai bentuk kepedulian mahasiswa FMIPA USK pasca tsunami Aceh tahun 2004. </p>
          <p style="text-align: justify;">YSN hadir sebagai wadah kolaborasi antara akademisi, peneliti, praktisi,
            komunitas, dan generasi muda untuk mendorong solusi berbasis data dan ilmu pengetahuan dalam menjawab
            berbagai tantangan strategis bangsa—mulai dari lingkungan dan perubahan iklim, ketahanan pangan, pendidikan,
            hingga pemberdayaan desa dan masyarakat adat.</p>
          <a href="about.html" class="btn btn-primary-outline">Learn more</a>
        </div>
        <div class="col-md-6 order-1 order-md-2 mb-4 mb-md-0">
          <img class="img-fluid w-90" src="{{ asset('assets/fe/images/about/about-us.png') }}" alt="about image">
        </div>
      </div>
    </div>
  </section>
  <!-- /about us -->

  <!-- courses -->
  <section class="section-sm">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="d-flex align-items-center section-title justify-content-between">
            <h2 class="mb-0 text-nowrap mr-3">Publikasi</h2>
            <div class="border-top w-100 border-primary d-none d-sm-block"></div>
            <div>
              <a href="courses.html" class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block">see all</a>
            </div>
          </div>
        </div>
      </div>
      <!-- course list -->
      <div class="row justify-content-center">
        <!-- course item -->
        <div class="col-lg-4 col-sm-6 mb-5">
          <div class="card p-0 border-primary rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/courses/course-1.jpg') }}"
              alt="course thumb">
            <div class="card-body">
              <ul class="list-inline mb-2">
                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>02-14-2018</li>
                <li class="list-inline-item"><a class="text-color" href="#">Humanities</a></li>
              </ul>
              <a href="course-single.html">
                <h4 class="card-title">Photography</h4>
              </a>
              <p class="card-text mb-4"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna.</p>
              <a href="course-single.html" class="btn btn-primary btn-sm">Apply now</a>
            </div>
          </div>
        </div>
        <!-- course item -->
        <div class="col-lg-4 col-sm-6 mb-5">
          <div class="card p-0 border-primary rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/courses/course-2.jpg') }}"
              alt="course thumb">
            <div class="card-body">
              <ul class="list-inline mb-2">
                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>02-14-2018</li>
                <li class="list-inline-item"><a class="text-color" href="#">Humanities</a></li>
              </ul>
              <a href="course-single.html">
                <h4 class="card-title">Programming</h4>
              </a>
              <p class="card-text mb-4"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna.</p>
              <a href="course-single.html" class="btn btn-primary btn-sm">Apply now</a>
            </div>
          </div>
        </div>
        <!-- course item -->
        <div class="col-lg-4 col-sm-6 mb-5">
          <div class="card p-0 border-primary rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/courses/course-3.jpg') }}"
              alt="course thumb">
            <div class="card-body">
              <ul class="list-inline mb-2">
                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>02-14-2018</li>
                <li class="list-inline-item"><a class="text-color" href="#">Humanities</a></li>
              </ul>
              <a href="course-single.html">
                <h4 class="card-title">Lifestyle Archives</h4>
              </a>
              <p class="card-text mb-4"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna.</p>
              <a href="course-single.html" class="btn btn-primary btn-sm">Apply now</a>
            </div>
          </div>
        </div>
        <!-- course item -->
        <div class="col-lg-4 col-sm-6 mb-5">
          <div class="card p-0 border-primary rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/courses/course-4.jpg') }}"
              alt="course thumb">
            <div class="card-body">
              <ul class="list-inline mb-2">
                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>02-14-2018</li>
                <li class="list-inline-item"><a class="text-color" href="#">Humanities</a></li>
              </ul>
              <a href="course-single.html">
                <h4 class="card-title">Complete Freelancing</h4>
              </a>
              <p class="card-text mb-4"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna.</p>
              <a href="course-single.html" class="btn btn-primary btn-sm">Apply now</a>
            </div>
          </div>
        </div>
        <!-- course item -->
        <div class="col-lg-4 col-sm-6 mb-5">
          <div class="card p-0 border-primary rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/courses/course-5.jpg') }}"
              alt="course thumb">
            <div class="card-body">
              <ul class="list-inline mb-2">
                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>02-14-2018</li>
                <li class="list-inline-item"><a class="text-color" href="#">Humanities</a></li>
              </ul>
              <a href="course-single.html">
                <h4 class="card-title">Branding Design</h4>
              </a>
              <p class="card-text mb-4"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna.</p>
              <a href="course-single.html" class="btn btn-primary btn-sm">Apply now</a>
            </div>
          </div>
        </div>
        <!-- course item -->
        <div class="col-lg-4 col-sm-6 mb-5">
          <div class="card p-0 border-primary rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/courses/course-6.jpg') }}"
              alt="course thumb">
            <div class="card-body">
              <ul class="list-inline mb-2">
                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>02-14-2018</li>
                <li class="list-inline-item"><a class="text-color" href="#">Humanities</a></li>
              </ul>
              <a href="course-single.html">
                <h4 class="card-title">Art Design</h4>
              </a>
              <p class="card-text mb-4"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna.</p>
              <a href="course-single.html" class="btn btn-primary btn-sm">Apply now</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /course list -->
      <!-- mobile see all button -->
      <div class="row">
        <div class="col-12 text-center">
          <a href="courses.html" class="btn btn-sm btn-primary-outline d-sm-none d-inline-block">sell all</a>
        </div>
      </div>
    </div>
  </section>
  <!-- /courses -->

  <!-- cta -->
  <section class="section bg-primary">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <h6 class="text-white font-secondary mb-0">Bersama Kita Wujudkan Perubahan Nyata</h6>
          <h2 class="section-title text-white">Dukung Gerakan Kami Melalui Donasi</h2>
          <a href="contact.html" class="btn btn-secondary">Donasi Sekarang</a>
        </div>
      </div>
    </div>
  </section>
  <!-- /cta -->

  <!-- success story -->
  <section class="section bg-cover" data-background="{{ asset('assets/fe/images/backgrounds/success-story.jpg') }}">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-sm-4 position-relative success-video">
          <a class="play-btn venobox" href="https://youtu.be/nA1Aqp0sPQo" data-vbtype="video">
            <i class="ti-control-play"></i>
          </a>
        </div>
        <div class="col-lg-6 col-sm-8">
          <div class="bg-white p-5">
            <h2 class="section-title">Success Stories</h2>
            <p style="text-align: justify;">Di Yayasan Sains Nusantara, setiap program dirancang untuk menghadirkan
              dampak nyata dan terukur bagi masyarakat. Melalui pendekatan berbasis riset, kolaborasi lintas sektor, dan
              pendampingan berkelanjutan, kami telah membantu berbagai komunitas meningkatkan kapasitas, ketahanan, dan
              kesejahteraan mereka.</p>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</p> -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /success story -->

  <!-- events -->
  <section class="section bg-gray">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="d-flex align-items-center section-title justify-content-between">
            <h2 class="mb-0 text-nowrap mr-3">Upcoming Events</h2>
            <div class="border-top w-100 border-primary d-none d-sm-block"></div>
            <div>
              <a href="events.html" class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block">see all</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <!-- event -->
        <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
          <div class="card border-0 rounded-0 hover-shadow">
            <div class="card-img position-relative">
              <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/events/event-1.jpg') }}"
                alt="event thumb">
              <div class="card-date"><span>18</span><br>December</div>
            </div>
            <div class="card-body">
              <!-- location -->
              <p><i class="ti-location-pin text-primary mr-2"></i>Harvard, Usa</p>
              <a href="event-single.html">
                <h4 class="card-title">Toward a public philosophy of justice</h4>
              </a>
            </div>
          </div>
        </div>
        <!-- event -->
        <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
          <div class="card border-0 rounded-0 hover-shadow">
            <div class="card-img position-relative">
              <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/events/event-2.jpg') }}"
                alt="event thumb">
              <div class="card-date"><span>21</span><br>December</div>
            </div>
            <div class="card-body">
              <!-- location -->
              <p><i class="ti-location-pin text-primary mr-2"></i>Cambridge, USA</p>
              <a href="event-single.html">
                <h4 class="card-title">Research seminar in clinical science.</h4>
              </a>
            </div>
          </div>
        </div>
        <!-- event -->
        <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
          <div class="card border-0 rounded-0 hover-shadow">
            <div class="card-img position-relative">
              <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/events/event-3.jpg') }}"
                alt="event thumb">
              <div class="card-date"><span>23</span><br>December</div>
            </div>
            <div class="card-body">
              <!-- location -->
              <p><i class="ti-location-pin text-primary mr-2"></i>Dhanmondi Lake, Dhaka</p>
              <a href="event-single.html">
                <h4 class="card-title">Firefly training in trauma-informed yoga</h4>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- mobile see all button -->
      <div class="row">
        <div class="col-12 text-center">
          <a href="course.html" class="btn btn-sm btn-primary-outline d-sm-none d-inline-block">sell all</a>
        </div>
      </div>
    </div>
  </section>
  <!-- /events -->

  <!-- blog -->
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="section-title">Latest News</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <!-- blog post -->
        <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
          <div
            class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
            <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/blog/post-1.jpg') }}" alt="Post thumb">
            <div class="card-body">
              <!-- post meta -->
              <ul class="list-inline mb-3">
                <!-- post date -->
                <li class="list-inline-item mr-3 ml-0">August 28, 2019</li>
                <!-- author -->
                <li class="list-inline-item mr-3 ml-0">By Jonathon</li>
              </ul>
              <a href="blog-single.html">
                <h4 class="card-title">The Expenses You Are Thinking.</h4>
              </a>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicin</p>
              <a href="blog-single.html" class="btn btn-primary btn-sm">read more</a>
            </div>
          </div>
        </article>
        <!-- blog post -->
        <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
          <div
            class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
            <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/blog/post-2.jpg') }}" alt="Post thumb">
            <div class="card-body">
              <!-- post meta -->
              <ul class="list-inline mb-3">
                <!-- post date -->
                <li class="list-inline-item mr-3 ml-0">August 13, 2019</li>
                <!-- author -->
                <li class="list-inline-item mr-3 ml-0">By Jonathon Drew</li>
              </ul>
              <a href="blog-single.html">
                <h4 class="card-title">Tips to Succeed in an Online Course</h4>
              </a>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicin</p>
              <a href="blog-single.html" class="btn btn-primary btn-sm">read more</a>
            </div>
          </div>
        </article>
        <!-- blog post -->
        <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
          <div
            class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
            <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/blog/post-3.jpg') }}" alt="Post thumb">
            <div class="card-body">
              <!-- post meta -->
              <ul class="list-inline mb-3">
                <!-- post date -->
                <li class="list-inline-item mr-3 ml-0">August 24, 2018</li>
                <!-- author -->
                <li class="list-inline-item mr-3 ml-0">By Alex Pitt</li>
              </ul>
              <a href="blog-single.html">
                <h4 class="card-title">Orientation Program for the new students</h4>
              </a>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicin</p>
              <a href="blog-single.html" class="btn btn-primary btn-sm">read more</a>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>
  <!-- /blog -->

  <!-- footer -->
  @include('layouts.frontend.footer')
  <!-- /footer -->

  <!-- jQuery -->
  <script src="{{ asset('assets/fe/plugins/jQuery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/fe/plugins/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/fe/plugins/slick/slick.min.js') }}"></script>
  <script src="{{ asset('assets/fe/plugins/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/fe/plugins/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('assets/fe/plugins/mixitup/mixitup.min.js') }}"></script>
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
  <script src="{{ asset('assets/fe/plugins/google-map/gmap.js') }}"></script>
  <script src="{{ asset('assets/fe/js/script.js') }}"></script>

</body>

</html>