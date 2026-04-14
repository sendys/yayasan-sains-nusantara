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
            <div class="col-12">
                <div class="d-flex align-items-center section-title justify-content-between">
                    <h2 class="mb-0 text-nowrap mr-3">{{ __('story.title') }}</h2>
                    <div class="border-top w-100 border-primary d-none d-sm-block"></div>
                    <div>
                        <a href={{ route('frontend.galeri.index') }} class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block">see
                            all</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gallery -->
        <div class="row">

            @foreach($galleries as $gallery)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm gallery-item">

                        <a class="venobox"
                        data-gall="kegiatan"
                        href="{{ $gallery->image_url }}"
                        data-title="{{ $gallery->title }}">

                            <img src="{{ $gallery->image_url }}"
                                class="card-img-top"
                                alt="{{ $gallery->title }}">

                            <!-- Overlay -->
                            <div class="overlay">
                                <i class="ti-search"></i>
                            </div>

                        </a>

                        <!-- Info -->
                        <div class="card-body">
                            <span class="badge bg-warning">
                                {{ \App\Models\Gallery::getKategoriList()[$gallery->kategori] ?? $gallery->kategori }}
                            </span>

                            <p class="mt-2">
                                {{ \Illuminate\Support\Str::limit($gallery->title, 100) }}
                            </p>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>

    </div>
</section>
