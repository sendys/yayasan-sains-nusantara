<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Yayasan Sains Nusantara</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/fe/plugins/bootstrap/bootstrap.min.css') }}">
  <!-- slick slider -->
  <link rel="stylesheet" href="{{ asset('assets/fe/plugins/slick/slick.css') }}">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="{{ asset('assets/fe/plugins/themify-icons/themify-icons.css') }}">
  <!-- animation css -->
  <link rel="stylesheet" href="{{ asset('assets/fe/plugins/animate/animate.css') }}">
  <!-- aos -->
  <link rel="stylesheet" href="{{ asset('assets/fe/plugins/aos/aos.css') }}">
  <!-- venobox popup -->
  <link rel="stylesheet" href="{{ asset('assets/fe/plugins/venobox/venobox.css') }}">

  <!-- Main Stylesheet -->
  <link href="{{ asset('assets/fe/css/style.css') }}" rel="stylesheet">

  <!--Favicon-->
  <link rel="shortcut icon" href="{{ asset('assets/fe/images/favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/fe/images/favicon.ico') }}" type="image/x-icon">

</head>

<body>


  <!-- header -->
  <header class="fixed-top header">
    <!-- top header -->
    <div class="top-header py-2 bg-white">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-lg-4 text-center text-lg-left">
            <a class="text-color mr-3" href="callto:+443003030266"><strong>TELP : </strong> (0651 -23212)</a>
            <ul class="list-inline d-inline">
              <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i
                    class="ti-facebook"></i></a></li>
              <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i
                    class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i
                    class="ti-linkedin"></i></a></li>
              <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color"
                  href="https://www.instagram.com/yayasansainsnusantara/"><i class="ti-instagram"></i></a></li>
            </ul>
          </div>
          <div class="col-lg-8 text-center text-lg-right">
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                  href="research.html">research</a></li>
              <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                  href="{{ route('login') }}">login</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- navbar -->
    <div class="navigation w-100">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
          <a class="navbar-brand" href="index.html">
            <h3 class="text-white">Yayasan Sains Nusantara</h3>
          </a>
          <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto text-center">
              <li class="nav-item active">
                <a class="nav-link" href="index.html">Beranda</a>
              </li>
              <!--  <li class="nav-item @@about">
              <a class="nav-link" href="about.html">About</a>
            </li> -->
              <li class="nav-item dropdown view">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  Tentang
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="">Sejarah</a>
                  <a class="dropdown-item" href="">Visi & Misi</a>
                  <a class="dropdown-item" href="">Tim YSN</a>
                  <a class="dropdown-item" href="">Legalitas</a>

                </div>
              </li>
              <li class="nav-item dropdown view">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  Divisi
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="">Environmental Service Project (ESP)</a>
                  <a class="dropdown-item" href="">Social Study</a>
                  <a class="dropdown-item" href="">Education</a>
                </div>
              </li>
              <!-- <li class="nav-item @@courses">
              <a class="nav-link" href="courses.html">Divisi</a>
            </li> -->
              <li class="nav-item @@events">
                <a class="nav-link" href="events.html">Publikasi</a>
              </li>
              <li class="nav-item @@blog">
                <a class="nav-link" href="blog.html">Sainspedia</a>
              </li>
              <!--  <li class="nav-item dropdown view">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Pages
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="teacher.html">Teacher</a>
                <a class="dropdown-item" href="teacher-single.html">Teacher Single</a>
                <a class="dropdown-item" href="notice.html">Notice</a>
                <a class="dropdown-item" href="notice-single.html">Notice Details</a>
                <a class="dropdown-item" href="research.html">Research</a>
                <a class="dropdown-item" href="scholarship.html">Scholarship</a>
                <a class="dropdown-item" href="course-single.html">Course Details</a>
                <a class="dropdown-item" href="event-single.html">Event Details</a>
                <a class="dropdown-item" href="blog-single.html">Blog Details</a>
              </div>
            </li> -->
              <li class="nav-item @@contact">
                <a class="nav-link" href="contact.html">Kontak</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <!-- /header -->
  <!-- Modal -->
  <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content rounded-0 border-0 p-4">
        <div class="modal-header border-0">
          <h3>Register</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="login">
            <form action="#" class="row">
              <div class="col-12">
                <input type="text" class="form-control mb-3" id="signupPhone" name="signupPhone" placeholder="Phone">
              </div>
              <div class="col-12">
                <input type="text" class="form-control mb-3" id="signupName" name="signupName" placeholder="Name">
              </div>
              <div class="col-12">
                <input type="email" class="form-control mb-3" id="signupEmail" name="signupEmail" placeholder="Email">
              </div>
              <div class="col-12">
                <input type="password" class="form-control mb-3" id="signupPassword" name="signupPassword"
                  placeholder="Password">
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary">SIGN UP</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content rounded-0 border-0 p-4">
        <div class="modal-header border-0">
          <h3>Login</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="#" class="row">
            <div class="col-12">
              <input type="text" class="form-control mb-3" id="loginPhone" name="loginPhone" placeholder="Phone">
            </div>
            <div class="col-12">
              <input type="text" class="form-control mb-3" id="loginName" name="loginName" placeholder="Name">
            </div>
            <div class="col-12">
              <input type="password" class="form-control mb-3" id="loginPassword" name="loginPassword"
                placeholder="Password">
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">LOGIN</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

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
  <footer>

    <!-- footer content -->
    <div class="footer bg-footer section border-bottom">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-8 mb-5 mb-lg-0">
            <!-- logo -->
            <!--  <a class="logo-footer" href="index.html"><img class="img-fluid mb-4" src="images/logo.png" alt="logo"></a> -->
            <a class="logo-footer" href="index.html">
              <h4 class="text-white mb-4">Yayasan Sains Nusantara</h4>
            </a>
            <ul class="list-unstyled">
              <li class="mb-2">Banda Aceh, Aceh</li>
              <li class="mb-2">0651 - 00000</li>
              <li class="mb-2">0651 - 11111</li>
              <li class="mb-2">contact@ysn.or.id</li>
            </ul>
          </div>
          <!-- company -->
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
            <h4 class="text-white mb-5">Tentang</h4>
            <ul class="list-unstyled">
              <li class="mb-3"><a class="text-color" href="about.html">About Us</a></li>
              <li class="mb-3"><a class="text-color" href="teacher.html">Our Teacher</a></li>
              <li class="mb-3"><a class="text-color" href="contact.html">Contact</a></li>
              <li class="mb-3"><a class="text-color" href="blog.html">Blog</a></li>
            </ul>
          </div>
          <!-- links -->
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
            <h4 class="text-white mb-5">Link</h4>
            <ul class="list-unstyled">
              <li class="mb-3"><a class="text-color" href="courses.html">Courses</a></li>
              <li class="mb-3"><a class="text-color" href="event.html">Events</a></li>
              <li class="mb-3"><a class="text-color" href="gallary.html">Gallary</a></li>
              <li class="mb-3"><a class="text-color" href="faqs.html">FAQs</a></li>
            </ul>
          </div>
          <!-- support -->
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
            <h4 class="text-white mb-5">Support</h4>
            <ul class="list-unstyled">
              <li class="mb-3"><a class="text-color" href="#">Forums</a></li>
              <li class="mb-3"><a class="text-color" href="#">Documentation</a></li>
              <li class="mb-3"><a class="text-color" href="#">Language</a></li>
              <li class="mb-3"><a class="text-color" href="#">Release Status</a></li>
            </ul>
          </div>
          <!-- support -->
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
            <h4 class="text-white mb-5">Rekomendasi</h4>
            <ul class="list-unstyled">
              <li class="mb-3"><a class="text-color" href="#">WordPress</a></li>
              <li class="mb-3"><a class="text-color" href="#">LearnPress</a></li>
              <li class="mb-3"><a class="text-color" href="#">WooCommerce</a></li>
              <li class="mb-3"><a class="text-color" href="#">bbPress</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- copyright -->
    <div class="copyright py-4 bg-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-7 text-sm-left text-center">
            <p class="mb-0">Copyright
              <script>
                var CurrentYear = new Date().getFullYear()
                document.write(CurrentYear)
              </script>
              © Design By <a href="fintekindonesia.com">Fintek Indonesia</a> All Rights Reserved.
          </div>
          <div class="col-sm-5 text-sm-right text-center">
            <ul class="list-inline">
              <li class="list-inline-item"><a class="d-inline-block p-2" href="https://www.facebook.com/themefisher"><i
                    class="ti-facebook text-primary"></i></a></li>
              <li class="list-inline-item"><a class="d-inline-block p-2" href="https://www.twitter.com/themefisher"><i
                    class="ti-twitter-alt text-primary"></i></a></li>
              <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i
                    class="ti-instagram text-primary"></i></a></li>
              <li class="list-inline-item"><a class="d-inline-block p-2" href="https://dribbble.com/themefisher"><i
                    class="ti-dribbble text-primary"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- /footer -->

  <!-- jQuery -->
  <script src="{{ asset('assets/fe/plugins/jQuery/jquery.min.js') }}"></script>
  <!-- Bootstrap JS -->
  <script src="{{ asset('assets/fe/plugins/bootstrap/bootstrap.min.js') }}"></script>
  <!-- slick slider -->
  <script src="{{ asset('assets/fe/plugins/slick/slick.min.js') }}"></script>
  <!-- aos -->
  <script src="{{ asset('assets/fe/plugins/aos/aos.js') }}"></script>
  <!-- venobox popup -->
  <script src="{{ asset('assets/fe/plugins/venobox/venobox.min.js') }}"></script>
  <!-- mixitup filter -->
  <script src="{{ asset('assets/fe/plugins/mixitup/mixitup.min.js') }}"></script>
  <!-- google map -->
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>

  <script src="{{ asset('assets/fe/plugins/google-map/gmap.js') }}"></script>

  <!-- Main Script -->
  <script src="{{ asset('assets/fe/js/script.js') }}"></script>

</body>

</html>