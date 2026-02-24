<nav class="navbar navbar-expand-lg navbar-light p-0">
    <a class="navbar-brand" href="/">
        <h3 class="text-white font-weight-bold">YAYASAN SAINS NUSANTARA</h3>
    </a>
    <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
        aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item active">
                <a class="nav-link" href="/">Beranda</a>
            </li>
            <li class="nav-item @@events">
                <a class="nav-link" href="events.html">Berita</a>
            </li>
            <li class="nav-item @@events">
                <a class="nav-link" href="events.html">Publikasi</a>
            </li>
            <li class="nav-item @@blog">
                <a class="nav-link" href="{{ route('partner') }}">Partner</a>
            </li>
            <li class="nav-item dropdown view">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Tentang Kami
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('sejarah') }}">Sejarah</a>
                    <a class="dropdown-item" href="{{ route('tentang') }}">Visi &amp; Misi</a>
                    <a class="dropdown-item" href="{{ route('pengurus') }}">Kepengurusan</a>
                    <a class="dropdown-item" href="{{ route('legalitas') }}">Legalitas</a>
                    <a class="dropdown-item" href="#">Kotak</a>
                </div>
            </li>
        </ul>
    </div>
</nav>