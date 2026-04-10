<div class="top-header py-2 bg-black">
    <div class="container">
        <div class="row align-items-center">

            <!-- LEFT -->
            <div class="col-lg-6 text-center text-lg-left">

                <a class="text-color mr-3" href="tel:+6265123212">
                    <strong>TELP :</strong> +62 852-7739-0360 | +62 852-9740-1122
                </a>

                <ul class="list-inline d-inline mb-0">

                    <li class="list-inline-item mx-0">
                        <a class="d-inline-block p-2 text-color" href="#">
                            <i class="ti-facebook"></i>
                        </a>
                    </li>

                    <li class="list-inline-item mx-0">
                        <a class="d-inline-block p-2 text-color" href="#">
                            <i class="ti-twitter-alt"></i>
                        </a>
                    </li>

                    <li class="list-inline-item mx-0">
                        <a class="d-inline-block p-2 text-color" href="#">
                            <i class="ti-linkedin"></i>
                        </a>
                    </li>

                    <li class="list-inline-item mx-0">
                        <a class="d-inline-block p-2 text-color" href="https://www.instagram.com/yayasansainsnusantara/"
                            target="_blank">
                            <i class="ti-instagram"></i>
                        </a>
                    </li>

                </ul>

            </div>

            <!-- RIGHT -->
            <div class="col-lg-6 text-center text-lg-right">

                <span class="language-switch">

                    <i class="ti-world"></i>

                    <a href="{{ route('lang.switch', 'id') }}"
                        class="text-color ml-1 {{ app()->getLocale() === 'id' ? 'active' : '' }}">{{ __('navbar.language_indonesia') }}</a>
                    |
                    <a href="{{ route('lang.switch', 'en') }}"
                        class="text-color ml-1 {{ app()->getLocale() === 'en' ? 'active' : '' }}">{{ __('navbar.language_english') }}</a>

                </span>

                <button onclick="window.location.href='/donasi'" class="btn btn-primary btn-xs ml-2">
                    {{ __('navbar.donate') }}
                </button>

            </div>

        </div>
    </div>
</div>
