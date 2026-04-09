@include('layouts.partials.main')

<head>

    @include('layouts.partials.title-meta')
    @include('layouts.partials.head-css')

</head>

<body class="authentication-bg authentication-bg-pattern" style="background-color: #f7f9fc;">
<br>
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-brand">
                                    <a href="{{ url('/') }}" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt=""
                                                height="40">
                                        </span>
                                    </a>

                                    <a href="{{ url('/') }}" class="logo logo-light text-center">
                                        <span class="logo-lg">

                                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt=""
                                                height="40">
                                        </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">
                                    Enter your email address and password to access admin
                                    panel.
                                </p>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Email address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                        id="email" placeholder="Enter your email" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        @if($message != 'These credentials do not match our records.')
                                            <span class="invalid-feedback" role="alert" style="display:block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @endif
                                    @enderror
                                    <span class="text-danger"></span>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" required
                                            autocomplete="current-password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Enter your password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <!-- Google reCAPTCHA -->
                                <div class="mb-3 text-center">
                                    <div class="d-flex justify-content-center">
                                        {!! NoCaptcha::display() !!}
                                    </div>
                                    @error('g-recaptcha-response')
                                        <span class="text-danger d-block mt-1" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                              
                                <div class="text-center mb-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-success w-100" type="submit">
                                                <i class="mdi mdi-arrow-right-bold me-2"></i>
                                                Login
                                            </button>
                                        </div>
                                        
                                        <div class="col-12">
                                            <a href="{{ route('auth.google') }}" class="btn btn-danger w-100">
                                                <i class="mdi mdi-google me-2"></i>
                                                Login Gmail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <!-- Modal Lisensi Expired -->
                    <div class="modal fade" id="expiredLicenseModal" tabindex="-1"
                        aria-labelledby="expiredLicenseModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-black">
                                    <h5 class="modal-title" id="expiredLicenseModalLabel">
                                        <i class="mdi mdi-alert-circle-outline me-2"></i>
                                        Lisensi Expired
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <i class="mdi mdi-lock-alert text-warning" style="font-size: 4rem;"></i>
                                        </div>
                                        <h4 class="text-danger mb-3">Akses Ditolak</h4>
                                        <p class="mb-3">
                                            Lisensi Anda telah dinonaktifkan dan saat ini layanan tidak dapat diakses. 
                                            Silakan menghubungi kami untuk melakukan aktivasi kembali..
                                            
                                        </p>
                                        <div class="alert alert-warning" role="alert">
                                            <i class="mdi mdi-information-outline me-2"></i>
                                            @if (session('expired_company_name'))
                                                <strong>{{ session('expired_company_name') }}</strong>
                                            @else
                                                <strong>Anda</strong>
                                            @endif
                                            telah <strong>berakhir</strong>.
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="mdi mdi-close me-1"></i>
                                        Tutup
                                    </button>
                                    <a href="https://wa.me/6281360205901?text=Halo%20Admin,%20saya%20membutuhkan%20bantuan%20terkait%20lisensi%20aplikasi."
                                    class="btn btn-success" target="_blank">
                                        <i class="mdi mdi-whatsapp me-1"></i>
                                        Hubungi Kami
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                    <!-- <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p> <a href="{{ route('kebijakan') }}" class="text-black-50 ms-1">Kebijakan Penggunaan</a>
                            </p>
                            <p class="text-black-50">Belum punya akun? <a href="{{ route('user.register') }}"
                                    class="text-black ms-1"><b>Daftar Disni</b></a>
                            </p>
                        </div> 
                    </div> -->
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->


    <footer class="footer footer-alt" style="color: black;">
        <script>
            document.write(new Date().getFullYear())
        </script> &copy; Fintek Mutiara Indonesia | <a href="{{ route('kebijakan') }}" class="text-black-50 ms-1">Kebijakan Penggunaan</a>
    </footer>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Authentication js -->
    {{-- <script src="{{ asset('assets/js/pages/authentication.init.js') }}"></script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log('DOM loaded, checking Bootstrap availability...');
            console.log('Bootstrap available:', typeof bootstrap !== 'undefined');

            const toggle = document.querySelector('.input-group-text[data-password]');
            const passwordInput = document.getElementById('password');
            const eye = toggle.querySelector('.password-eye');

            if (toggle && passwordInput && eye) {
                toggle.addEventListener('click', function() {
                    const isHidden = toggle.getAttribute('data-password') === 'false';
                    passwordInput.setAttribute('type', isHidden ? 'text' : 'password');
                    toggle.setAttribute('data-password', isHidden ? 'true' : 'false');

                    // Ganti icon jika perlu (misalnya pakai CSS class atau innerHTML)
                    eye.classList.toggle('show'); // kamu bisa definisikan style berbeda untuk .show
                });
            }

            // Tampilkan modal jika lisensi expired
            console.log('Checking for expired modal session...');
            var modalElement = document.getElementById('expiredLicenseModal');
            console.log('Modal element found:', modalElement !== null);

            @if (session('show_expired_modal'))
                console.log('Expired modal session found, showing modal...');
                console.log('Company name: {{ session('expired_company_name') }}');

                if (modalElement && typeof bootstrap !== 'undefined') {
                    try {
                        var expiredModal = new bootstrap.Modal(modalElement);
                        expiredModal.show();
                        console.log('Modal shown successfully');
                    } catch (error) {
                        console.error('Error showing modal:', error);
                    }
                } else {
                    console.error('Modal element or Bootstrap not found');
                    console.log('Modal element:', modalElement);
                    console.log('Bootstrap:', typeof bootstrap);
                }
            @else
                console.log('No expired modal session found');
            @endif
        });
    </script>

    <!-- jQuery & Toast JS -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>

    <!-- Google reCAPTCHA Script -->
    {!! NoCaptcha::renderJs() !!}
    
    @if($errors->has('email') && $errors->first('email') == 'These credentials do not match our records.')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                $.toast({
                    heading: 'Gagal Login',
                    text: 'Periksa kembali Email atau Password yang anda masukkan.',
                    showHideTransition: 'fade',
                    icon: 'error',
                    position: 'top-right',
                    loader: true,
                    loaderBg: '#ff2a00',
                    hideAfter: 6000
                });
            });
        </script>
    @endif
    
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $.toast({
                    heading: 'Sukses',
                    text: `{!! session('success') !!}`,
                    showHideTransition: 'slide up',
                    icon: 'danger',
                    loader: true,
                    loaderBg: '#2ecc71',
                    position: 'top-right',
                    hideAfter: 3000
                });
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $.toast({
                    heading: 'Gagal',
                    text: `{!! session('error') !!}`,
                    showHideTransition: 'slide up',
                    icon: 'danger',
                    loader: true,
                    loaderBg: '#e74c3c',
                    position: 'top-right',
                    hideAfter: 3000
                });
            });
        </script>
    @endif

</body>

</html>
