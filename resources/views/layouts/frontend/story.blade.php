{{--  <section class="section bg-cover" data-background="{{ asset('assets/fe/images/backgrounds/success-story.jpg') }}">
     <div class="container">
         <div class="row">
             <div class="col-lg-6 col-sm-4 position-relative success-video">
                 <a class="play-btn venobox" href="https://www.youtube.com/watch?v=K-P_XNfzp_A" data-vbtype="video">
                     <i class="ti-control-play"></i>
                 </a>
             </div>
             <div class="col-lg-6 col-sm-8">
                 <div class="bg-white p-5">
                     <h2 class="section-title">{{ __('story.title') }}</h2>
                     <p style="text-align: justify;">{{ __('story.description') }}</p>
                     <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</p> -->
                 </div>
             </div>
         </div>
     </div>
 </section> --}}

<section class="section bg-light">
    <div class="container">

        <!-- Title -->
        <div class="row">
            <div class="col-12 text-left">
                <h2 class="section-title">Dokumentasi</h2>
                <p>Dokumentasi program dan kegiatan Yayasan Sains Nusantara</p>
            </div>
        </div>

        <!-- Gallery -->
        <div class="row">

            @for ($i = 1; $i <= 6; $i++)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <img src="{{ asset('assets/fe/images/kegiatan/kegiatan-' . $i . '.jpg') }}" class="card-img-top"
                            alt="Kegiatan {{ $i }}">

                        <div class="card-body text-center">
                            <h5 class="card-title">Kegiatan {{ $i }}</h5>
                        </div>
                    </div>
                </div>
            @endfor

        </div>

        <!-- Button -->
        <div class="row">
            <div class="col-12 text-center mt-4">
                <a href="#" class="btn btn-outline-primary">
                    Lihat Semua Kegiatan
                </a>
            </div>
        </div>

    </div>
</section>
