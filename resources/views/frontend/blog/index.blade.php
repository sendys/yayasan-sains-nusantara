@extends('layouts.frontend')

@section('content')

    <!-- page title -->
    <section class="page-title-section overlay"
        data-background="{{ asset('assets/fe/images/backgrounds/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item">
                            <a class="h3 text-white font-secondary" href="{{ route('frontend.blog.index') }}">Artikel</a>
                        </li>
                    </ul>
                    <p class="text-lighten">
                        Dukungan Anda sangat berarti bagi Yayasan Sains Nusantara (YSN).
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <section class="section bg-light py-5">
        <div class="container">
            <div class="row mb-5">
                <!-- Kolom Kiri: Informasi Donasi -->
                <div class="col-12">
                    <div class="text-center mb-4">
                        <h3></h3>
                        <div class="divider mx-auto mb-4"></div>
                    </div>

                    <div class="mx-auto text-justify">
                        <hr class="my-2">
                        <br>

                        <div class="row" id="blog-container">
                            @include('frontend.blog.partials.blog-items')
                        </div>

                        @if ($blogs->hasMorePages())
                        <div class="text-center mt-4">
                            <button class="btn btn-primary btn-sm mt-auto" id="load-more">
                                <span id="load-more-text">Load More</span>

                                <span id="load-more-spinner" class="spinner-border spinner-border-sm ms-2 d-none"
                                    role="status"></span>
                            </button>
                        </div>
                        @endif

                    </div>
                </div>

              
            </div>
        </div>
</section>

<script>
let page = 2;
const loadMoreBtn = document.getElementById('load-more');
const spinner = document.getElementById('load-more-spinner');
const buttonText = document.getElementById('load-more-text');

loadMoreBtn?.addEventListener('click', function() {

    // Disable button
    loadMoreBtn.disabled = true;

    // Show spinner
    spinner.classList.remove('d-none');
    buttonText.innerText = "Loading...";

    fetch("?page=" + page, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(data => {

        if(data.trim() === '') {
            loadMoreBtn.remove();
            return;
        }

        document.getElementById('blog-container')
            .insertAdjacentHTML('beforeend', data);

        page++;

        // Enable button again
        loadMoreBtn.disabled = false;
        spinner.classList.add('d-none');
        buttonText.innerText = "Load More";

    })
    .catch(() => {
        loadMoreBtn.disabled = false;
        spinner.classList.add('d-none');
        buttonText.innerText = "Load More";
        alert("Terjadi kesalahan, coba lagi.");
    });

});
</script>

@endsection
