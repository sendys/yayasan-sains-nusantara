@include('layouts.partials.main')

<head>
    @include('layouts.partials.title-meta')
    @include('layouts.partials.head-css')
</head>

<body class="authentication-bg authentication-bg-pattern" style="background-color: #f7f9fc;">
    <br>
    <div class="account-pages d-flex align-items-center justify-content-center mt-5 mb-5">
        <div class="col-md-6 col-lg-6">
            <div class="card shadow-sm rounded-3">

                <div class="card-body p-4">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            <i class="fas fa-times-circle me-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    <h4 class="fw-bold text-center mb-3">Verifikasi Email Anda</h4>

                    <div class="alert alert-warning" role="alert">
                        <ul class="mb-0 ps-3 small">
                            <li>Link aktivasi sudah dikirim ke email Anda.</li>
                            <li>Jika belum menerima email, masukkan email Anda untuk mengirim ulang link.</li>
                            <li>Cek folder spam apabila email tidak ditemukan.</li>
                            <li>Link aktivasi berlaku selama <strong>24 Jam</strong>.</li>
                            <li>
                                Jika ada kendala, hubungi admin:
                                <a href="https://wa.me/+6281360205901" target="_blank" class="fw-bold text-success">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </li>
                        </ul>
                    </div>

                    <form id="resendActivationForm">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                placeholder="Masukkan email terdaftar" required autofocus>

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100" id="submitButton">
                                    <span id="btnText">
                                        <i class="fas fa-paper-plane me-2"></i> Kirim
                                    </span>
                                    <span id="btnLoading" class="d-none">
                                        <span class="spinner-border spinner-border-sm me-2"></span>
                                    </span>
                                </button>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('login') }}" class="btn btn-warning w-100">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- end page -->


    <footer class="footer footer-alt">
        <script>
            document.write(new Date().getFullYear())
        </script> &copy; Fintek Mutiara Indonesia
    </footer>

    <script>
        document.getElementById('resendActivationForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitButton = document.getElementById('submitButton');
            const emailInput = document.getElementById('email');

            // Disable submit button
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';

            // Remove previous error states
            emailInput.classList.remove('is-invalid');
            const existingError = emailInput.parentNode.querySelector('.invalid-feedback');
            if (existingError) {
                existingError.remove();
            }

            fetch('{{ route('account.resend-activation') }}', {
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
                        // Show success message
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-success';
                        alertDiv.innerHTML = '<i class="fas fa-check-circle me-2"></i>' + data.message;

                        const cardBody = document.querySelector('.card-body');
                        cardBody.insertBefore(alertDiv, cardBody.firstChild);

                        // Clear form
                        emailInput.value = '';
                        // Redirect to login page after 2 seconds
                        setTimeout(() => {
                            window.location.href = '{{ url('/login') }}';
                        }, 2000);

                    } else {
                        // Show error message
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-danger';
                        alertDiv.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>' + data.message;

                        const cardBody = document.querySelector('.card-body');
                        cardBody.insertBefore(alertDiv, cardBody.firstChild);
                    }

                    // Re-enable submit button
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Kirim Email Aktivasi';
                })
                .catch(error => {
                    console.error('Error:', error);

                    // Show error message
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-danger';
                    alertDiv.innerHTML =
                        '<i class="fas fa-exclamation-circle me-2"></i>Terjadi kesalahan sistem atau email yang anda masukan tidak valid. Silakan coba lagi.';

                    const cardBody = document.querySelector('.card-body');
                    cardBody.insertBefore(alertDiv, cardBody.firstChild);

                    // Re-enable submit button
                    submitButton.disabled = false;
                    submitButton.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Kirim Email Aktivasi';
                });
        });
    </script>

</body>

</html>