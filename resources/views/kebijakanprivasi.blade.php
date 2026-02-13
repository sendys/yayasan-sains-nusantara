<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Penggunaan - Fintek Mutiara Indonesia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #ffffff;
            color: #333;
            line-height: 1.6;
            user-select: none;
            /* Tidak bisa blok/seleksi teks */
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        header {
            background: linear-gradient(135deg, #008177ff 0%);
            padding: 0.5rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            /* ✅ perbaikan: sebelumnya "0 rem" (error syntax) */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Logo di kiri atas */
        .logo {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
            cursor: pointer;
            /* ✅ Supaya tampak bisa diklik */
            user-select: none;
            /* Tidak bisa di-block tapi tetap bisa diklik */
        }

        .logo img {
            height: 32px;
            width: auto;
            display: block;
        }

        /* Menu navigasi kanan */
        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
            user-select: none;
            cursor: pointer;
            /* ✅ Pastikan bisa diklik */
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        /* Konten utama */
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        h1 {
            font-size: 2rem;
            color: #1f2937;
            margin-bottom: 1rem;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        h2 {
            font-size: 1.5rem;
            color: #374151;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e5e7eb;
        }

        h3 {
            font-size: 1.2rem;
            color: #4b5563;
            margin-top: 1.5rem;
            margin-bottom: 0.8rem;
        }

        p {
            margin-bottom: 1rem;
            text-align: justify;
        }

        ul {
            margin-left: 2rem;
            margin-bottom: 1rem;
        }

        li {
            margin-bottom: 0.5rem;
        }

        strong {
            color: #1f2937;
        }

        .contact-box {
            background: #f9fafb;
            border-left: 4px solid #6b7280;
            padding: 1.5rem;
            margin-top: 2rem;
            border-radius: 4px;
        }

        .date {
            text-align: center;
            color: #9ca3af;
            font-size: 0.9rem;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .nav-links {
                gap: 1rem;
                font-size: 0.9rem;
            }

            h1 {
                font-size: 1.6rem;
            }

            .container {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                {{-- <img src="{{ asset('assets/images/logo-dark.png') }}" alt="Logo Fintek" /> --}}
                <span> Fintek Mutiara Indonesia</span>

            </div>

        </nav>
    </header>

    <div class="container">
        <h1>Kebijakan Penggunaan Aplikasi</h1>
        <p class="subtitle">Terms of Use - Fintek Mutiara Indonesia</p>

        <h2>1. Pendahuluan</h2>
        <p>Selamat datang di aplikasi web <strong>Fintek Mutiara Indonesia</strong>. Dokumen ini menjelaskan
            syarat dan ketentuan penggunaan layanan kami ("Kebijakan Penggunaan"). Dengan mengakses atau menggunakan
            aplikasi/web Fintek Mutiara Indonesia, Anda dianggap telah membaca, memahami, dan menyetujui untuk terikat
            dengan kebijakan ini.</p>
        <p>Apabila Anda tidak menyetujui sebagian atau seluruh isi kebijakan ini, harap untuk tidak menggunakan layanan
            kami.</p>

        <h2>2. Definisi</h2>
        <ul>
            <li><strong>"Pengguna"</strong> adalah individu atau badan hukum yang mengakses dan/atau menggunakan layanan
                kami.</li>
            <li><strong>"Layanan"</strong> berarti seluruh fitur dan fungsi yang disediakan melalui aplikasi/web Fintek
                Mutiara Indonesia.</li>
            <li><strong>"Data Pribadi dan Data Keuangan"</strong> berarti seluruh informasi pengguna, termasuk namun
                tidak terbatas pada data identitas, transaksi, dan informasi finansial.</li>
        </ul>

        <h2>3. Lingkup Layanan</h2>
        <p>Fintek Mutiara Indonesia menyediakan platform layanan keuangan digital untuk membantu pengguna dalam
            mengelola, mencatat, atau melakukan transaksi keuangan tertentu. Kami <strong>bukan lembaga keuangan yang
                memberikan nasihat investasi atau menjamin keuntungan finansial</strong> apa pun. Pengguna setuju untuk
            menggunakan layanan ini hanya untuk keperluan yang sah dan sesuai hukum Republik Indonesia.</p>

        <h2>4. Persyaratan Akun & Keamanan</h2>
        <ul>
            <li>Pengguna wajib berusia minimal 17 tahun dan memiliki kapasitas hukum yang sah.</li>
            <li>Pengguna bertanggung jawab penuh atas keamanan akun, kata sandi, dan seluruh aktivitas yang terjadi
                melalui akun tersebut.</li>
            <li>Kami berhak menangguhkan atau menonaktifkan akun yang terindikasi melakukan pelanggaran hukum, penipuan,
                atau pelanggaran kebijakan ini.</li>
        </ul>

        <h2>5. Transaksi & Risiko</h2>
        <ul>
            <li>Seluruh transaksi keuangan yang dilakukan melalui aplikasi dilakukan atas risiko dan tanggung jawab
                pengguna.</li>
            <li>Fintek Mutiara Indonesia tidak bertanggung jawab atas kerugian yang timbul akibat kesalahan pengguna,
                gangguan jaringan, atau perubahan regulasi.</li>
            <li>Informasi dan simulasi keuangan yang ditampilkan dalam aplikasi bersifat <strong>informasi umum</strong>
                dan <strong>tidak dapat dianggap sebagai nasihat keuangan resmi</strong>.</li>
        </ul>

        <h2>6. Data & Privasi</h2>
        <p>Kami menghormati privasi pengguna dan mematuhi ketentuan perlindungan data pribadi yang berlaku di Indonesia
            (UU No. 27 Tahun 2022). Kami mengumpulkan dan menggunakan data pribadi hanya untuk keperluan operasional
            layanan dan peningkatan kualitas sistem. Selengkapnya diatur dalam <strong>Kebijakan Privasi Fintek Mutiara
                Indonesia</strong>.</p>

        <h2>7. Hak & Kewajiban Perusahaan</h2>
        <ul>
            <li>Kami berhak mengubah, memperbarui, atau menghentikan sebagian/seluruh layanan kapan pun tanpa
                pemberitahuan sebelumnya.</li>
            <li>Kami wajib menjaga keamanan data pengguna dan menjalankan standar perlindungan konsumen sesuai ketentuan
                OJK dan Kominfo.</li>
        </ul>

        <h2>8. Larangan Penggunaan</h2>
        <p>Pengguna dilarang:</p>
        <ul>
            <li>Menggunakan layanan untuk aktivitas yang melanggar hukum, termasuk pencucian uang, penipuan, atau
                distribusi konten ilegal.</li>
            <li>Menyalahgunakan akses aplikasi untuk memperoleh data pengguna lain.</li>
            <li>Menggandakan, menjual, atau memodifikasi bagian mana pun dari sistem tanpa izin tertulis dari Fintek
                Mutiara Indonesia.</li>
        </ul>

        <h2>9. Penafian & Batasan Tanggung Jawab</h2>
        <p>Fintek Mutiara Indonesia tidak bertanggung jawab atas kerugian langsung atau tidak langsung akibat:</p>
        <ul>
            <li>Kesalahan penggunaan layanan oleh pengguna,</li>
            <li>Gangguan teknis, virus, atau serangan siber,</li>
            <li>Ketidaksesuaian informasi dari pihak ketiga.</li>
        </ul>
        <p>Kami berupaya menjaga layanan tetap aman dan andal, namun tidak dapat menjamin layanan bebas dari kesalahan
            atau gangguan.</p>

        <h2>10. Perubahan Ketentuan</h2>
        <p>Kami dapat memperbarui Kebijakan Penggunaan ini sewaktu-waktu. Versi terbaru akan diumumkan melalui situs web
            resmi dan berlaku sejak tanggal diperbarui. Pengguna diimbau untuk meninjau kebijakan ini secara berkala.
        </p>

        <h2>11. Hukum yang Berlaku & Penyelesaian Sengketa</h2>
        <p>Kebijakan ini tunduk dan ditafsirkan berdasarkan hukum Republik Indonesia. Setiap perselisihan yang timbul
            dari penggunaan aplikasi akan diselesaikan terlebih dahulu secara musyawarah, dan jika tidak tercapai, akan
            diselesaikan melalui Pengadilan Negeri.</p>


        <!-- <p class="date">Terakhir diperbarui: November 2025</p> -->
        <p class="date" id="last-updated"></p>
</body>

</html>

<script>
    // Tanggal otomatis
    const dateElement = document.getElementById("last-updated");
    const bulan = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    const now = new Date();
    dateElement.textContent = `Terakhir diperbarui: ${bulan[now.getMonth()]} ${now.getFullYear()}`;

    // Nonaktifkan klik kanan
    document.addEventListener("contextmenu", e => e.preventDefault());

    // Nonaktifkan shortcut copy/paste/devtools
    document.addEventListener("keydown", e => {
        if (
            e.key === "F12" ||
            (e.ctrlKey && (e.key === "c" || e.key === "u" || e.key === "s" || e.key === "p")) ||
            (e.ctrlKey && e.shiftKey && e.key === "I")
        ) {
            e.preventDefault();
        }
    });

    // Nonaktifkan drag teks
    document.addEventListener("dragstart", e => e.preventDefault());
</script>
</body>

</html>
