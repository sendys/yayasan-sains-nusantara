<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = 'Complete Registration'; ?>

    @include('layouts.partials.title-meta')
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    @include('layouts.partials.head-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <div class="auth-brand">
                                    <a href="index.php" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt=""
                                                height="40">
                                        </span>
                                    </a>

                                    <a href="index.php" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt=""
                                                height="40">
                                        </span>
                                    </a>
                                </div>
                                <p class="text-muted mb-4 mt-3">Lengkapi informasi untuk menyelesaikan registrasi dengan
                                    akun Google Anda</p>
                            </div>

                            <div class="text-center mb-4">
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <img src="{{ $avatar }}" alt="Google Avatar" class="rounded-circle me-3"
                                        width="50" height="50">
                                    <div>
                                        <h5 class="mb-0">{{ $name }}</h5>
                                        <small class="text-muted">{{ $email }}</small>
                                    </div>
                                </div>
                                <span class="badge bg-success">Terverifikasi dengan Google</span>
                            </div>

                            <form id="completeRegistrationForm" class="parsley-examples">
                                @csrf
                                <input type="hidden" name="google_id" value="{{ $googleUser->getId() }}">
                                <input type="hidden" name="name" value="{{ $name }}">
                                <input type="hidden" name="email" value="{{ $email }}">

                                <div class="mb-3">
                                    <label for="perusahaan" class="form-label">Nama usaha</label>
                                    <input class="form-control @error('nama') is-invalid @enderror" type="text"
                                        id="nama" name="nama" value="{{ old('nama') }}"
                                        placeholder="Masukkan nama usaha anda" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="mb-3">
                                    <label for="phone" class="form-label">Nomor WhatsApp</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                            name="phone" id="phone" min="0"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            value="{{ old('phone') }}" placeholder="Masukkan nomor whatsapp anda" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="agreeCheckbox" required>
                                        <label class="form-check-label" for="agreeCheckbox">Saya setuju <a
                                                href="javascript:void(0)" class="text-dark" data-bs-toggle="modal"
                                                data-bs-target="#termsModal">dengan ketentuan pengguna
                                                Fintek Indonesia</a></label>
                                    </div>
                                </div>

                                <div class="text-center d-grid">
                                    <button class="btn btn-success" type="submit" id="submitButton">
                                        <i class="mdi mdi-google me-2"></i>
                                        Selesaikan Registrasi
                                    </button>
                                </div>

                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-white-50">Sudah punya akun? <a href="{{ route('login') }}"
                                    class="text-white ms-1"><b>Sign In</b></a></p>
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

    <!-- Modal Terms -->
   <!--  <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Ketentuan Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p>Dengan menggunakan layanan ini, Anda menyetujui ketentuan berikut:</p>
                    <ul>
                        <li>Anda akan menggunakan layanan ini dengan itikad baik</li>
                        <li>Anda tidak akan menyalahgunakan sistem</li>
                        <li>Data yang Anda berikan adalah benar dan akurat</li>
                        <li>Kami berhak memproses data Anda sesuai kebijakan privasi</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div> -->

    @include('layouts.partials.vendor')
    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <script>
        document.getElementById('completeRegistrationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitButton = document.getElementById('submitButton');

            // Disable submit button
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="mdi mdi-loading mdi-spin me-2"></i>Memproses...';

            fetch('{{ route('auth.google.complete') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = data.redirect_url;
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan saat registrasi'
                        });

                        // Re-enable submit button
                        submitButton.disabled = false;
                        submitButton.innerHTML = '<i class="mdi mdi-google me-2"></i>Selesaikan Registrasi';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan sistem'
                    });

                    // Re-enable submit button
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<i class="mdi mdi-google me-2"></i>Selesaikan Registrasi';
                });
        });
    </script>

</body>

</html>
