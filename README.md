# Setup Google OAuth untuk Registrasi User

## Langkah-langkah Setup

### 1. Install Dependencies

Jalankan perintah berikut untuk menginstall Laravel Socialite:

```bash
composer install
```

### 2. Jalankan Migration

Jalankan migration untuk menambahkan kolom `google_id` ke tabel users:

```bash
php artisan migrate
```

### 3. Setup Google OAuth Credentials

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih project yang sudah ada
3. Aktifkan Google+ API dan Google OAuth2 API
4. Buat OAuth 2.0 Client ID:
   - Pilih "Web application"
   - Tambahkan Authorized redirect URIs: `http://localhost:8000/auth/google/callback`
   - Salin Client ID dan Client Secret

### 4. Konfigurasi Environment

Tambahkan konfigurasi berikut ke file `.env`:

```env
# Google OAuth Configuration
GOOGLE_CLIENT_ID=your_google_client_id_here
GOOGLE_CLIENT_SECRET=your_google_client_secret_here
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

# Email Configuration (untuk aktivasi akun)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your_email@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**Catatan untuk Email Configuration:**
- Gunakan App Password untuk Gmail, bukan password biasa
- Aktifkan 2-Factor Authentication di Gmail terlebih dahulu
- Buat App Password di Google Account Settings

### 5. Fitur yang Ditambahkan

#### Routes Baru:
- `GET /auth/google` - Redirect ke Google OAuth
- `GET /auth/google/callback` - Handle callback dari Google
- `POST /auth/google/complete` - Melengkapi registrasi setelah login Google
- `GET /account/activate/{token}` - Aktivasi akun melalui email
- `GET /account/resend-activation` - Form kirim ulang email aktivasi
- `POST /account/resend-activation` - Proses kirim ulang email aktivasi

#### Controller Methods Baru:
- `redirectToGoogle()` - Redirect user ke halaman login Google
- `handleGoogleCallback()` - Handle response dari Google OAuth
- `completeGoogleRegistration()` - Proses registrasi lengkap dengan data Google + kirim email aktivasi
- `activateAccount()` - Aktivasi akun melalui token email
- `resendActivationEmail()` - Kirim ulang email aktivasi

#### Views Baru:
- `resources/views/user/complete-registration.blade.php` - Form melengkapi registrasi Google
- `resources/views/emails/account-activation.blade.php` - Template email aktivasi
- `resources/views/auth/resend-activation.blade.php` - Form kirim ulang email aktivasi

#### Database Changes:
- Kolom `google_id` ditambahkan ke tabel `users`
- Kolom `phone` ditambahkan ke fillable array di User model
- Kolom `activation_token`, `activation_token_expires_at`, `is_activated`, `activated_at` ditambahkan ke tabel `users`

#### Email System:
- `AccountActivationMail` - Mailable class untuk email aktivasi
- Email dikirim otomatis setelah registrasi Google berhasil
- Token aktivasi berlaku 24 jam
- User dapat meminta kirim ulang email aktivasi

#### Middleware & Security:
- `CheckAccountActivation` - Middleware untuk memastikan akun sudah diaktivasi
- User yang belum aktivasi tidak dapat mengakses fitur utama
- Auto-redirect ke halaman aktivasi jika akun belum diaktivasi
- Login dengan Google otomatis memverifikasi email

#### UI/UX Improvements:
- Tombol "Login dengan Google" di halaman login
- Tombol "Daftar dengan Google" di halaman registrasi
- Halaman resend activation email dengan form yang user-friendly
- Email template yang responsive dan modern

### 6. Cara Kerja

#### Login dengan Google OAuth (User Sudah Terdaftar):
1. User mengklik tombol "Login dengan Google" di halaman login
2. User diarahkan ke halaman login Google
3. Setelah berhasil login, Google mengirim data user ke callback URL
4. Sistem mengecek apakah email sudah terdaftar:
   - Jika sudah: langsung login dan redirect ke dashboard
   - Jika user belum memiliki `google_id`: sistem otomatis menambahkan `google_id` dan verifikasi email
5. User berhasil login dan dapat menggunakan aplikasi

#### Registrasi dengan Google OAuth (User Baru):
1. User mengklik tombol "Daftar dengan Google" di halaman registrasi
2. User diarahkan ke halaman login Google
3. Setelah berhasil login, Google mengirim data user ke callback URL
4. Sistem mengecek apakah email sudah terdaftar:
   - Jika belum: tampilkan form melengkapi registrasi
5. User mengisi data perusahaan dan nomor telepon
6. Sistem membuat akun baru dengan status `is_activated = false`
7. **Email aktivasi dikirim otomatis** ke alamat email user
8. User login sementara dengan akun yang belum diaktivasi

#### Aktivasi Akun:
1. User menerima email aktivasi dengan link aktivasi
2. User mengklik link aktivasi dalam email
3. Sistem memverifikasi token aktivasi:
   - Jika valid dan belum kedaluwarsa: akun diaktivasi
   - Jika tidak valid atau kedaluwarsa: tampilkan error
4. Setelah aktivasi berhasil, user dapat menggunakan semua fitur

#### Kirim Ulang Email Aktivasi:
1. User dapat mengakses halaman `/account/resend-activation`
2. User memasukkan alamat email
3. Sistem mengirim ulang email aktivasi dengan token baru
4. Token lama otomatis tidak berlaku

### 7. Keamanan

- Password di-generate secara random untuk user Google OAuth
- Email otomatis terverifikasi untuk user Google
- User Google mendapat role 'admin' secara default
- Validasi input tetap diterapkan untuk data tambahan

### 8. Testing

#### Testing Login dengan Google (User Sudah Terdaftar):
1. Pastikan server Laravel berjalan: `php artisan serve`
2. Buka halaman login: `http://localhost:8000/login`
3. Klik tombol "Login dengan Google"
4. Login dengan akun Google yang sudah terdaftar
5. Verifikasi user berhasil login dan redirect ke dashboard
6. Cek bahwa `google_id` otomatis ditambahkan jika belum ada

#### Testing Registrasi dengan Google (User Baru):
1. Buka halaman registrasi: `http://localhost:8000/user/register`
2. Klik tombol "Daftar dengan Google"
3. Login dengan akun Google yang belum terdaftar
4. Lengkapi form registrasi (nama perusahaan, nomor telepon)
5. Verifikasi user berhasil dibuat dengan status `is_activated = false`
6. Cek email aktivasi terkirim
7. Klik link aktivasi di email
8. Verifikasi akun berhasil diaktivasi

#### Testing Middleware Aktivasi:
1. Login dengan akun yang belum diaktivasi
2. Coba akses halaman yang memerlukan aktivasi (misal: `/home`)
3. Verifikasi auto-redirect ke halaman resend activation
4. Test form resend activation email

### 9. Troubleshooting

**Error: "Client ID not found"**
- Pastikan GOOGLE_CLIENT_ID sudah diset di .env
- Pastikan config cache sudah di-clear: `php artisan config:clear`

**Error: "Redirect URI mismatch"**
- Pastikan redirect URI di Google Console sama dengan GOOGLE_REDIRECT_URI di .env
- Pastikan tidak ada trailing slash

**Error: "Invalid client secret"**
- Pastikan GOOGLE_CLIENT_SECRET benar
- Generate ulang client secret jika perlu

### 10. Catatan Penting

- Untuk production, ganti URL callback sesuai domain production
- Simpan Google credentials dengan aman
- Pertimbangkan untuk menambahkan rate limiting pada OAuth routes
- Test thoroughly sebelum deploy ke production