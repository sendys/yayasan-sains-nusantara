<div class="footer bg-footer section border-bottom">
    <div class="container">
        <div class="row">
            <!-- Kolom 1: Info Yayasan -->
            <div class="col-md-7 mb-5">
                <a class="logo-footer" href="index.html">
                    <h4 class="text-white mb-4">{{ __('footer.organization_name') }}</h4>
                </a>
                <ul class="list-unstyled">
                    <li class="mb-2 text-white">{{ __('footer.address') }}</li>
                    <li class="mb-2 text-white">{{ __('footer.phone') }}</li>
                    <li class="mb-2 text-white">{{ __('footer.postal_code') }}</li>
                    <li class="mb-2 text-white">{{ __('footer.email') }}</li>
                </ul>
            </div>

            <!-- Kolom 2: Sitemap -->
            <div class="col-md-3 mb-5">
                <h4 class="text-white mb-4">{{ __('footer.sitemap') }}</h4>
                <ul class="list-unstyled">
                    <li class="mb-3"><a class="text-white" href="">{{ __('footer.news') }}</a></li>
                    <li class="mb-3"><a class="text-white" href="">{{ __('footer.publications') }}</a></li>
                    <li class="mb-3"><a class="text-white" href="">{{ __('footer.sainspedia') }}</a></li>
                    <li class="mb-3"><a class="text-white" href="">{{ __('footer.about_us') }}</a></li>
                    <li class="mb-3"><a class="text-white" href="{{ route('kontak') }}">{{ __('footer.contact') }}</a></li>
                </ul>
            </div>

            <div class="col-md-1 mb-5">
                <h4 class="text-white mb-4">Follow Us</h4>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <a class="text-white" href="#"><i class="mdi mdi-facebook me-2"></i>Facebook</a>
                    </li>
                    <li class="mb-3">
                        <a class="text-white" href="#"><i class="mdi mdi-instagram me-2"></i>Instagram</a>
                    </li>
                    <li class="mb-3">
                        <a class="text-white" href="#"><i class="mdi mdi-youtube me-2"></i>YouTube</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
<!-- copyright -->
<div class="copyright py-4 bg-footer">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p class="mb-0 text-white">{{ __('footer.copyright') }}
                    <script>
                        var CurrentYear = new Date().getFullYear()
                        document.write(CurrentYear)
                    </script>
                    © <a href="https://fintekindonesia.web.id" target="_blank" rel="noopener noreferrer">Fintek
                        Indonesia</a> {{ __('footer.all_rights_reserved') }}
            </div>
           
        </div>
    </div>

    <!-- Back To Top Premium -->
    <button id="backToTop" class="back-to-top">
        <svg class="progress-circle" width="48" height="48">
            <circle cx="24" cy="24" r="20"></circle>
        </svg>
        <i class="ti-angle-up"></i>
    </button>

</div>
