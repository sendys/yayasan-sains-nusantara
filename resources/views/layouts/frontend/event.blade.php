<section class="section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center section-title justify-content-between">
                    <h2 class="mb-0 text-nowrap mr-3">{{ __('publikasi.title') }}</h2>
                    <div class="border-top w-100 border-primary d-none d-sm-block"></div>
                    <div>
                        <a href="{{ route('frontend.event.all') }}"
                            class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block">
                            See all
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            @forelse($events ?? [] as $event)
                <div class="col-lg-4 col-sm-6 mb-4 d-flex">
                    <div class="card border-0 rounded-0 hover-shadow news-card w-100">

                        <!-- IMAGE -->
                        <div class="card-img-wrapper">
                            <img src="{{ $event->image_url }}" loading="lazy" alt="{{ e($event->title) }}">

                            <div class="card-date">
                                <span>{{ $event->event_date ? $event->event_date->format('d') : '' }}</span><br>
                                {{ $event->event_date ? $event->event_date->format('M') : '' }}
                            </div>
                        </div>

                        <!-- BODY -->
                        <div class="card-body d-flex flex-column">
                            <p class="mb-2 text-muted">
                                <i class="ti-location-pin text-primary mr-2"></i>
                                {{ $event->location ?? 'Online' }}
                            </p>

                            <a href="{{ route('frontend.event.show', $event->uuid) }}">
                                <h5 class="card-title">
                                    {{ $event->title }}
                                </h5>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Belum ada data</p>
            @endforelse
        </div>

        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('frontend.event.all') }}"
                    class="btn btn-sm btn-primary-outline d-sm-none d-inline-block">
                    Lihat semua
                </a>
            </div>
        </div>
    </div>
</section>
