@include('layouts.partials.main')

<head>
    <?php
$title = 'Register & Signup'; ?>

    @include('layouts.partials.title-meta')
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    @include('layouts.partials.head-css')

</head>

<body class="authentication-bg authentication-bg-pattern" style="background-color: #f7f9fc;">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-brand">
                                    <a href="index.php" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="40">
                                        </span>
                                    </a>

                                    <a href="index.php" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="40">
                                        </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">Don't have an account? Create your account, it takes
                                    less than a minute</p>
                            </div>

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form id="roleForm" class="parsley-examples">
                                @csrf
                                <div class="mb-3 position-relative">
                                    <label for="fullname" class="form-label">Nama Usaha</label>
                                    <input class="form-control @error('perusahaan') is-invalid @enderror" type="text"
                                        id="perusahaan" name="perusahaan" value="{{ old('perusahaan') }}"
                                        placeholder="Enter your perusahaan" required>
                                    @error('perusahaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="fullname" class="form-label">Nama Lengkap</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        id="name" name="name" value="{{ old('name') }}" placeholder="Enter your name"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailaddress" class="form-label">Email</label>
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                type="email" name="email" value="{{ old('email') }}" required
                                                placeholder="Enter your email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <div class="input-group">
                                                {{-- <span class="input-group-text">+62</span> --}}
                                                <input type="number"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    name="phone" id="phone" min="0"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    value="{{ old('phone') }}" placeholder="Enter your phone number"
                                                    required>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 position-relative">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            oninput="validatePassword(this.value)" onfocus="showTooltip()"
                                            onblur="hideTooltip()" placeholder="Enter your password">

                                        <div id="passwordTooltip"
                                            class="position-absolute p-3 bg-white rounded shadow border"
                                            style="top: 100%; left: 0; display: none; z-index: 1000; width: 300px; font-size: 13px;">
                                            <strong>Password harus</strong>
                                            <ul class="list-unstyled mt-2 mb-0">
                                                <li id="check-number" class="text-danger"><span
                                                        class="fa fa-times"></span> Mengandung 1 angka</li>
                                                <li id="check-uppercase" class="text-danger"><span
                                                        class="fa fa-times"></span> Mengandung 1 huruf
                                                    besar</li>
                                                <li id="check-lowercase" class="text-danger"><span
                                                        class="fa fa-times"></span> Mengandung 1 huruf kecil
                                                </li>
                                                <li id="check-caracter" class="text-danger"><span
                                                        class="fa fa-times"></span> karakter
                                                    khusus (@$!%*?&)
                                                </li>
                                                <li id="check-length" class="text-danger"><span
                                                        class="fa fa-times"></span> Minimal 8 karakter</li>
                                            </ul>
                                        </div>
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                        {{-- <small class="form-text text-muted">
                                            Kata sandi harus mengandung setidaknya satu huruf kecil, satu huruf besar,
                                            satu angka dan satu karakter khusus (@$!%*?&)
                                        </small> --}}
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="agreeCheckbox">
                                        <label class="form-check-label" for="checkbox-signup">Saya setuju <a href="#"
                                                class="text-dark" data-bs-toggle="#" data-bs-target="#termsModal">dengan
                                                ketentuan pengguna
                                                Fintek Indonesia</a></label>
                                    </div>
                                </div>
                                <div class="text-center d-grid">
                                    <button class="btn btn-success btn" type="submit" id="submitButton" disabled> Sign
                                        Up
                                    </button>
                                </div>

                            </form>

                            <!-- <div class="text-center">
                                <h5 class="mt-3 text-muted">Sign up using</h5>
                                <div class="d-grid gap-2 mt-3">
                                    <a href="{{ route('auth.google') }}" class="btn btn-outline-danger">
                                        <i class="mdi mdi-google me-2"></i>
                                        Daftar dengan Google
                                    </a>
                                </div>
                            </div> -->

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-black-50">Sudah punya akun? <a href="{{ route('login') }}"
                                    class="text-black ms-1"><b>Login Disini</b></a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Ketentuan Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <h4>Syarat dan Ketentuan Penggunaan</h4>
                    <p>Selamat datang di Fintek Mutiara Indonesia. Dengan menggunakan layanan kami, Anda menyetujui
                        syarat dan ketentuan berikut:</p>

                    <h5>1. Pendaftaran Akun</h5>
                    <ul>
                        <li>Anda harus memberikan informasi yang akurat dan lengkap saat mendaftar</li>
                        <li>Anda bertanggung jawab untuk menjaga kerahasiaan akun Anda</li>
                        <li>Anda harus berusia minimal 18 tahun atau usia legal di wilayah Anda</li>
                    </ul>

                    <h5>2. Penggunaan Layanan</h5>
                    <ul>
                        <li>Layanan hanya boleh digunakan untuk tujuan yang legal</li>
                        <li>Dilarang menyalahgunakan layanan untuk aktivitas yang merugikan</li>
                        <li>Kami berhak membatasi atau menghentikan akses jika terjadi pelanggaran</li>
                    </ul>

                    <h5>3. Privasi dan Keamanan</h5>
                    <ul>
                        <li>Kami menjaga kerahasiaan data pribadi Anda sesuai kebijakan privasi</li>
                        <li>Anda wajib melaporkan segala aktivitas mencurigakan pada akun Anda</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer footer-alt">
        2015 -
        <script>
            document.write(new Date().getFullYear())
        </script> &copy; &nbsp<a href="" class="text-black-50">Fintek Mutiara Indonesia</a>
    </footer>

    <!-- Authentication js -->
    <!-- Sweet Alerts js -->
    {{--
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Sweet alert init js-->
    <script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('roleForm');
            const submitButton = form.querySelector('button[type="submit"]');

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(form);

                // Disable submit button
                submitButton.disabled = true;
                submitButton.classList.add('disabled');
                submitButton.innerHTML =
                    '<span class="fas fa-spinner fa-spin me-2" role="status" aria-hidden="true"></span>Mengirim...';

                fetch("{{ route('user.daftar') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Jika sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                html: `<strong>${data.message}</strong>`,
                                confirmButtonText: 'OK',
                                didOpen: () => {
                                    const title = Swal.getTitle();
                                    if (title) {
                                        title.style.marginBottom = '2px';
                                    }
                                }
                            }).then(() => {
                                window.location.href = data.redirect_url;
                            });
                        } else {
                            // Validasi gagal
                            let errorMessages = '';
                            if (data.errors) {
                                for (const field in data.errors) {
                                    errorMessages += data.errors[field].join('<br>') + '<br>';
                                }
                            } else {
                                errorMessages = data.message || 'Terjadi kesalahan.';
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: errorMessages,
                            });
                        }

                        // Enable kembali tombol
                        submitButton.disabled = false;
                        submitButton.classList.remove('disabled');
                        submitButton.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Sign Up';
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Silakan coba lagi nanti.'
                        });

                        submitButton.disabled = false;
                        submitButton.classList.remove('disabled');
                        submitButton.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Sign Up';
                    });
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('agreeCheckbox');
            const button = document.getElementById('submitButton');

            checkbox.addEventListener('change', function () {
                button.disabled = !this.checked;
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggle = document.querySelector('.input-group-text[data-password]');
            const passwordInput = document.getElementById('password');
            const eye = toggle.querySelector('.password-eye');

            toggle.addEventListener('click', function () {
                const isHidden = toggle.getAttribute('data-password') === 'false';
                passwordInput.setAttribute('type', isHidden ? 'text' : 'password');
                toggle.setAttribute('data-password', isHidden ? 'true' : 'false');

                // Ganti icon jika perlu (misalnya pakai CSS class atau innerHTML)
                eye.classList.toggle('show'); // kamu bisa definisikan style berbeda untuk .show
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."
        crossorigin="anonymous"></script>
    <script>
        function showTooltip() {
            document.getElementById('passwordTooltip').style.display = 'block';
        }

        function hideTooltip() {
            document.getElementById('passwordTooltip').style.display = 'none';
        }

        function validatePassword(password) {
            // Cek angka
            document.getElementById('check-number').className =
                /\d/.test(password) ? 'text-success' : 'text-danger';

            // Cek huruf besar
            document.getElementById('check-uppercase').className =
                /[A-Z]/.test(password) ? 'text-success' : 'text-danger';

            // Cek huruf kecil
            document.getElementById('check-lowercase').className =
                /[a-z]/.test(password) ? 'text-success' : 'text-danger';

            // Cek karackter khusus
            document.getElementById('check-caracter').className =
                /[@$!%*?&]/.test(password) ? 'text-success' : 'text-danger';

            // Cek panjang minimal
            document.getElementById('check-length').className =
                password.length >= 8 ? 'text-success' : 'text-danger';
        }
    </script>

</body>

</html>