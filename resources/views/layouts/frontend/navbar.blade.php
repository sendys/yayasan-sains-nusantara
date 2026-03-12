{{-- <nav class="navbar navbar-expand-lg navbar-light p-0">
    <style>
        @media (max-width: 991px) {
            .logo-ysn {
                width: 40px !important;
                height: auto !important;
            }

            .navbar-brand {
                padding: 8px 0 !important;
            }

            .navbar-toggler {
                padding: 6px 10px !important;
                border: 2px solid rgba(255, 255, 255, 0.5) !important;
            }

            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E") !important;
            }
        }

        @media (min-width: 992px) {
            .logo-ysn {
                width: 50px;
                height: auto;
            }
        }
    </style>
    <a class="navbar-brand d-flex align-items-center" href="/">

        <!-- Logo -->
        <img src="{{ asset('assets/fe/images/about/small.png') }}" alt="Logo YSN" class="logo-ysn mr-2 mr-lg-3">

        <!-- Nama Yayasan -->
        <h3 class="mb-0 text-white font-weight-bold d-none d-lg-block">
            YAYASAN SAINS NUSANTRA
        </h3>
        <h5 class="mb-0 text-white font-weight-bold d-lg-none">
            YSN
        </h5>
    </a>
    <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
        aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item active">
                <a class="nav-link" href="/">Beranda</a>
            </li>
            <li class="nav-item @@events">
                <a class="nav-link" href="{{ route('frontend.blog.index') }}">Berita</a>
            </li>
            <li class="nav-item @@events">
                <a class="nav-link" href="{{ route('frontend.event.index') }}">Publikasi</a>
            </li>
            <li class="nav-item @@blog">
                <a class="nav-link" href="{{ route('partner') }}">Partner</a>
            </li>
            <li class="nav-item dropdown view">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tentang Kami
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('sejarah') }}">Sejarah</a>
                    <a class="dropdown-item" href="{{ route('tentang') }}">Visi &amp; Misi</a>
                    <a class="dropdown-item" href="{{ route('pengurus') }}">Kepengurusan</a>
                    <a class="dropdown-item" href="{{ route('legalitas') }}">Legalitas</a>
                    <a class="dropdown-item" href="{{ route('kontak') }}">Kontak</a>

                </div>
            </li>
        </ul>
    </div>
</nav> --}}

<nav class="navbar navbar-expand-lg navbar-light p-0 navbar-ysn">

    <style>
        /* ============================= */
        /* Navbar Styling */
        /* ============================= */

        .navbar-ysn {
            padding: 10px 0;
        }

        /* logo */
        .logo-ysn {
            width: 50px;
            height: auto;
        }

        /* brand text */
        .navbar-brand h3,
        .navbar-brand h5 {
            letter-spacing: 1px;
        }

        /* right navbar area */
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-left: 20px;
        }

        /* language switch */
        .language-switch {
            font-size: 14px;
            color: #fff;
        }

        .language-switch a {
            color: #fff;
            font-weight: 600;
        }

        .language-switch a:hover {
            color: #d7ffe1;
            text-decoration: none;
        }

        /* search icon */
        .nav-search {
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .nav-search:hover {
            color: #d7ffe1;
        }

        /* donate button */
        .btn-donasi {
            background: #fff;
            color: #269c41;
            font-weight: 700;
            padding: 8px 20px;
            border-radius: 3px;
            font-size: 14px;
            transition: all .3s ease;
        }

        .btn-donasi:hover {
            background: #f5f5f5;
            color: #269c41;
        }

        /* mobile */

        @media (max-width:991px) {

            .logo-ysn {
                width: 40px;
            }

            .navbar-brand {
                padding: 6px 0;
            }

            .navbar-toggler {
                padding: 6px 10px;
                border: 2px solid rgba(255, 255, 255, 0.5);
            }

            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255,0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
            }

            /* hide desktop extra */
            .navbar-right {
                display: none;
            }

        }
    </style>


    <!-- BRAND -->
    <a class="navbar-brand d-flex align-items-center" href="/">

        <img src="{{ asset('assets/fe/images/about/small.png') }}" alt="Logo YSN" class="logo-ysn mr-2 mr-lg-3">

        <h3 class="mb-0 text-white font-weight-bold d-none d-lg-block">
            YAYASAN SAINS NUSANTARA
        </h3>

        <h5 class="mb-0 text-white font-weight-bold d-lg-none">
            YSN
        </h5>

    </a>


    <!-- MOBILE TOGGLE -->
    <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation">

        <span class="navbar-toggler-icon"></span>

    </button>


    <div class="collapse navbar-collapse" id="navigation">

        <ul class="navbar-nav ml-auto text-center">

            {{--  <li class="nav-item active">
                <a class="nav-link" href="/">Beranda</a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link" href="{{ route('frontend.blog.index') }}">
                    Berita
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    Publikasi
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('partner') }}">
                    Partner
                </a>
            </li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown">

                    Tentang Kami

                </a>

                <div class="dropdown-menu">

                    <a class="dropdown-item" href="{{ route('sejarah') }}">
                        Sejarah
                    </a>

                    <a class="dropdown-item" href="{{ route('tentang') }}">
                        Visi & Misi
                    </a>

                    <a class="dropdown-item" href="{{ route('pengurus') }}">
                        Kepengurusan
                    </a>

                    <a class="dropdown-item" href="{{ route('legalitas') }}">
                        Legalitas
                    </a>

                    <a class="dropdown-item" href="{{ route('kontak') }}">
                        Kontak
                    </a>

                </div>

            </li>

        </ul>


        <!-- RIGHT NAVBAR -->
        <div class="navbar-right d-none d-lg-flex">

            <!-- SEARCH -->
            <span class="nav-search">
                <i class="ti-search"></i>
            </span>

            <!-- LANGUAGE -->
            <span class="language-switch">

                <i class="ti-world mr-1"></i>

                <a href="#" class="active">ID</a>
                |
                <a href="#">EN</a>

            </span>

            <!-- DONATE BUTTON -->
            <a href="/donasi" class="btn btn-donasi">

                DONASI

            </a>

        </div>

    </div>

</nav>
