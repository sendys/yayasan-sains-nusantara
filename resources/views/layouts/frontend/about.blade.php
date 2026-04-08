
<section class="section about-ysn">
    <div class="container">
        <div class="row">

            <!-- Kolom Kiri -->
            <div class="col-lg-5 mb-4">
                <h2 class="section-title">
                    {!! __('about.title') !!}
                </h2>

                <p style="text-align: justify;">
                    {{ __('about.description') }}
                </p>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-lg-7">

                <div class="row">

                    <div class="col-md-6 mb-4">
                        <div class="about-item">
                            <h5>
                                <a href="{{ route('tentang') }}">
                                    {{ __('about.about_us') }} >
                                </a>
                            </h5>
                            <p>
                                {{ __('about.about_us_desc') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="about-item">
                            <h5>
                                <a href="#">
                                    {{ __('about.what_we_do') }} >
                                </a>
                            </h5>
                            <p>
                                {{ __('about.what_we_do_desc') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="about-item">
                            <h5>
                                <a href="#">
                                    {{ __('about.where_we_work') }} >
                                </a>
                            </h5>
                            <p>
                                {{ __('about.where_we_work_desc') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="about-item">
                            <h5>
                                <a href="#">
                                    {{ __('about.support_us') }} >
                                </a>
                            </h5>
                            <p>
                                {{ __('about.support_us_desc') }}
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>
