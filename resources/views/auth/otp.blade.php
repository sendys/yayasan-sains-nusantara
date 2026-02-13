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
                                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="40">
                                        </span>
                                    </a>
                                    <a href="{{ url('/') }}" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="40">
                                        </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">
                                    Masukkan kode OTP yang dikirim ke email Anda untuk melanjutkan.
                                </p>
                            </div>

                            <form method="POST" action="{{ route('otp.verify') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="otp" class="form-label">Kode OTP</label>
                                    <input id="otp" name="otp" type="text"
                                        class="form-control @error('otp') is-invalid @enderror" maxlength="6"
                                        placeholder="Masukkan 6 digit kode OTP" required autofocus>
                                    @error('otp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="text-center mb-4">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-success" type="submit">
                                            <i class="mdi mdi-check-circle-outline me-2"></i>
                                            Verifikasi OTP
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p>
                                <a href="{{ route('login') }}" class="text-black-50 ms-1">Kembali ke halaman login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer footer-alt" style="color: white;">
        <script>
            document.write(new Date().getFullYear())
        </script> &copy; Fintek Mutiara Indonesia
    </footer>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>

