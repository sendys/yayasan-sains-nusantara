<nav class="navbar navbar-expand-lg navbar-light p-0">
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
        <img src="{{ asset('assets/fe/images/about/logosmall.png') }}" alt="Logo YSN" class="logo-ysn mr-2 mr-lg-3">

        <!-- Nama Yayasan -->
        <h3 class="mb-0 text-black font-weight-bold d-none d-lg-block">
            YAYASAN SAINS NUSANTARA
        </h3>
        <h5 class="mb-0 text-black font-weight-bold d-lg-none">
            YSN
        </h5>
    </a>
    <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
        aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav ml-auto text-center">
            {{-- <li class="nav-item active">
                <a class="nav-link" href="/">
                    <i class="ti-home"></i>
                </a>
            </li> --}}

            <li class="nav-item dropdown view">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('navbar.about_us') }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                    <a class="dropdown-item" href="{{ route('sejarah') }}">{{ __('navbar.history') }}</a>
                    <a class="dropdown-item" href="{{ route('tentang') }}">{{ __('navbar.vision_mission') }}</a>
                    <a class="dropdown-item" href="{{ route('pengurus') }}">{{ __('navbar.team') }}</a>
                    <a class="dropdown-item" href="{{ route('legalitas') }}">{{ __('navbar.legality') }}</a>
                    <a class="dropdown-item" href="{{ route('kontak') }}">{{ __('navbar.contact') }}</a>

                </div>
            </li>

            <li class="nav-item dropdown view">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('navbar.division') }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Environmental Service Project (ESP)</a>
                    <a class="dropdown-item" href="#">Social Study</a>
                    <a class="dropdown-item" href="#">Education</a>
                </div>
            </li>

            <li class="nav-item @@events">
                <a class="nav-link" href="{{ route('frontend.blog.index') }}">{{ __('navbar.news') }}</a>
            </li>

            <li class="nav-item dropdown view">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ __('navbar.publications') }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                    <a class="dropdown-item" href="{{ route('frontend.event.all') }}">{{ __('navbar.reports') }}</a>
                    <a class="dropdown-item" href="#">{{ __('navbar.books') }}</a>
                    <a class="dropdown-item" href="#">{{ __('navbar.scientific') }}</a>
                </div>
            </li>

            <li class="nav-item @@blog">
                <a class="nav-link" href="{{ route('partner') }}">{{ __('navbar.partnership') }}</a>
            </li>

        </ul>
    </div>
</nav>
