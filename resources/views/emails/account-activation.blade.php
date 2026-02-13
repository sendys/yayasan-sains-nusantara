<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Aktivasi Akun</title>
</head>

<body style="margin:0;padding:0;background-color:#f4f6f8;font-family:Arial,Helvetica,sans-serif;color:#333;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8;padding:20px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,0.05);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#28a745;padding:25px;text-align:center;color:#ffffff;">
                            <h1 style="margin:0;font-size:22px;">Fintek Indonesia</h1>
                            <p style="margin:8px 0 0;font-size:14px;">Aktivasi Akun Pengguna</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:30px;">
                            <p style="margin-top:0;">Halo <strong>{{ $user->name }}</strong>,</p>

                            <p>
                                Terima kasih telah mendaftar di <strong>Fintek Indonesia</strong>.
                                Akun Anda telah berhasil dibuat dengan detail berikut:
                            </p>

                            <table cellpadding="0" cellspacing="0" width="100%" style="margin:15px 0;font-size:14px;">
                                <tr>
                                    <td width="120"><strong>Nama</strong></td>
                                    <td>: {{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>: {{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal</strong></td>
                                    <td>: {{ $user->created_at->format('d F Y H:i') }}</td>
                                </tr>
                            </table>

                            <p>
                                Untuk mengaktifkan akun dan mulai menggunakan layanan kami,
                                silakan klik tombol di bawah ini:
                            </p>

                            <!-- Button -->
                            <table role="presentation" cellpadding="0" cellspacing="0" align="center"
                                style="margin:25px auto;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $activationUrl }}" target="_blank" style="
                                            background-color:#28a745;
                                            color:#ffffff;
                                            display:inline-block;
                                            font-family:Arial, Helvetica, sans-serif;
                                            font-size:14px;
                                            font-weight:bold;
                                            line-height:48px;
                                            text-align:center;
                                            text-decoration:none;
                                            width:220px;
                                            border-radius:6px;
                                            -webkit-text-size-adjust:none;
               ">
                                            Aktivasi Akun
                                        </a>

                                    </td>
                                </tr>
                            </table>

                            <!-- Warning -->
                            <div style="background-color:#fff3cd;border:1px solid #ffeeba;
                                        color:#856404;padding:15px;border-radius:5px;
                                        font-size:13px;">
                                <strong>Perhatian:</strong><br>
                                Link aktivasi ini hanya berlaku selama <strong>24 jam</strong>.
                                Jika melewati batas waktu, Anda perlu melakukan pendaftaran ulang.
                            </div>

                            <p style="margin-top:20px;font-size:14px;">
                                Jika tombol di atas tidak berfungsi, silakan salin dan tempel
                                tautan berikut ke browser Anda:
                            </p>

                            <p style="background-color:#f1f3f5;padding:10px;border-radius:4px;
                                      font-size:12px;word-break:break-all;">
                                {{ $activationUrl }}
                            </p>

                            <p style="font-size:14px;">
                                Jika Anda merasa tidak pernah mendaftar di Fintek Indonesia,
                                silakan abaikan email ini.
                            </p>

                            <p style="margin-bottom:0;">
                                Hormat kami,<br>
                                <strong>Tim Fintek Indonesia</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f8f9fa;padding:15px;text-align:center;
                                   font-size:12px;color:#6c757d;">
                            Email ini dikirim secara otomatis, mohon tidak membalas email ini.<br>
                            &copy; {{ date('Y') }} Fintek Indonesia. Seluruh hak cipta dilindungi.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>