<nav class="navbar navbar-expand-lg navbar-light p-0">
    <a class="navbar-brand" href="/">
        <h3 class="text-white">SAINS NUSANTARA</h3>
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
            <li class="nav-item dropdown view">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tentang Kami
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('tentang') }}">Sejarah</a>
                    <a class="dropdown-item" href="">Tim YSN</a>
                    <a class="dropdown-item" href="">Legalitas</a>

                </div>
            </li>
            <li class="nav-item dropdown view">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Divisi
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="">Environmental Service Project (ESP)</a>
                    <a class="dropdown-item" href="">Social Study</a>
                    <a class="dropdown-item" href="">Education</a>
                </div>
            </li>
            <!-- <li class="nav-item @@courses">
              <a class="nav-link" href="courses.html">Divisi</a>
            </li> -->
            <li class="nav-item @@events">
                <a class="nav-link" href="events.html">Publikasi</a>
            </li>
            <li class="nav-item @@blog">
                <a class="nav-link" href="blog.html">Sainspedia</a>
            </li>
            <li class="nav-item @@blog">
                <a class="nav-link" href="blog.html">Partner</a>
            </li>
            <li class="nav-item @@contact">
                <a class="nav-link" href="contact.html">Kontak</a>
            </li>
        </ul>
    </div>
</nav>
