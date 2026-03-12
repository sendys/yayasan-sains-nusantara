<section class="section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center section-title justify-content-between">
                    <h2 class="mb-0 text-nowrap mr-3">Publikasi</h2>
                    <div class="border-top w-100 border-primary d-none d-sm-block"></div>
                    <div>
                        <a href="{{ route('frontend.event.index') }}" class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block">see
                            all</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            {{-- @forelse($events as $event)
            <!-- event -->
            <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                <div class="card border-0 rounded-0 hover-shadow">
                    <div class="card-img position-relative">
                        <img class="card-img-top rounded-0" src="{{ $event->image_url }}"
                            alt="{{ e($event->title) }}">
                        <div class="card-date">
                            <span>{{ $event->event_date ? $event->event_date->format('d') : '' }}</span><br>
                            {{ $event->event_date ? $event->event_date->format('F') : '' }}
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- location -->
                        <p><i class="ti-location-pin text-primary mr-2"></i>{{ $event->location ?? 'Online' }}</p>
                        <a href="{{ route('frontend.event.show', $event->uuid) }}">
                            <h4 class="card-title">{{ $event->title }}</h4>
                        </a>
                    </div>
                </div>
            </div>
            @empty --}}
            <!-- event (static fallback if no events) -->
            <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                <div class="card border-0 rounded-0 hover-shadow">
                    <div class="card-img position-relative">
                        <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/events/event-1.jpg') }}"
                            alt="event thumb">
                        <div class="card-date"><span>18</span><br>December</div>
                    </div>
                    <div class="card-body">
                        <!-- location -->
                        <p><i class="ti-location-pin text-primary mr-2"></i>Harvard, Usa</p>
                        <a href="{{ route('frontend.event.index') }}">
                            <h4 class="card-title">Toward a public philosophy of justice</h4>
                        </a>
                    </div>
                </div>
            </div>
            <!-- event -->
            <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                <div class="card border-0 rounded-0 hover-shadow">
                    <div class="card-img position-relative">
                        <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/events/event-2.jpg') }}"
                            alt="event thumb">
                        <div class="card-date"><span>21</span><br>December</div>
                    </div>
                    <div class="card-body">
                        <!-- location -->
                        <p><i class="ti-location-pin text-primary mr-2"></i>Cambridge, USA</p>
                        <a href="{{ route('frontend.event.index') }}">
                            <h4 class="card-title">Research seminar in clinical science.</h4>
                        </a>
                    </div>
                </div>
            </div>
            <!-- event -->
            <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
                <div class="card border-0 rounded-0 hover-shadow">
                    <div class="card-img position-relative">
                        <img class="card-img-top rounded-0" src="{{ asset('assets/fe/images/events/event-3.jpg') }}"
                            alt="event thumb">
                        <div class="card-date"><span>23</span><br>December</div>
                    </div>
                    <div class="card-body">
                        <!-- location -->
                        <p><i class="ti-location-pin text-primary mr-2"></i>Dhanmondi Lake, Dhaka</p>
                        <a href="{{ route('frontend.event.index') }}">
                            <h4 class="card-title">Firefly training in trauma-informed yoga</h4>
                        </a>
                    </div>
                </div>
            </div>
           {{--  @endforelse --}}
        </div>
        <!-- mobile see all button -->
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('frontend.event.index') }}" class="btn btn-sm btn-primary-outline d-sm-none d-inline-block">see all</a>
            </div>
        </div>
    </div>
</section>
