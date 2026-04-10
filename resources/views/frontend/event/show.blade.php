@extends('layouts.frontend')

@section('content')

    <style>
        .event-content {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            line-height: 1.9;
            color: #555;
            text-align: justify;
        }
    </style>

    <!-- page title -->
    <section class="page-title-section overlay"
        data-background="{{ asset('assets/fe/images/backgrounds/page-title.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-inline custom-breadcrumb">
                        <li class="list-inline-item">
                            <a class="h3 text-white font-secondary" href="{{ route('frontend.event.index') }}">{{ __('publikasi.title') }}</a>
                        </li>
                    </ul>
                    <p class="text-lighten">
                        {{ $event->title }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <section class="section bg-light py-5">
        <div class="container">
            <div class="row">

                <!-- ================= LEFT CONTENT ================= -->
                <div class="col-lg-8 mb-4">

                    <div class="event-details bg-white p-4 rounded shadow-sm">

                        <img src="{{ $event->image_url }}" alt="{{ e($event->title) }}" class="img-fluid rounded mb-4"
                            style="max-height: 400px; width: 100%; object-fit: cover;">

                        <ul class="list-inline mb-3 text-muted">
                            <li class="list-inline-item mr-3 ml-0">
                                <i class="mdi mdi-calendar"></i>
                                {{ $event->event_date ? $event->event_date->format('F d, Y') : '' }}
                            </li>
                            <li class="list-inline-item mr-3">
                                <i class="mdi mdi-clock"></i>
                                {{ $event->event_date ? $event->event_date->format('H:i') : '' }} WITA
                            </li>
                            @if($event->location)
                                <li class="list-inline-item mr-3">
                                    <i class="mdi mdi-map-marker"></i>
                                    {{ $event->location }}
                                </li>
                            @endif
                        </ul>

                        @if($event->category)
                            <span class="badge bg-primary mb-3">{{ $event->category }}</span>
                        @endif

                        <h2 class="mb-3">{{ $event->title }}</h2>

                        @if($event->description)
                            <p class="lead mb-4">{{ $event->description }}</p>
                        @endif

                        @if($event->content)
                            <div class="event-content">
                                {!! nl2br(e($event->content)) !!}
                            </div>
                        @endif

                        <!-- Registration Button -->
                        @if($event->registration_link)
                            <div class="mt-4 p-4 bg-primary rounded text-white">
                                <h4 class="text-white">Pendaftaran</h4>
                                <p class="mb-3">Segera daftarkan diri Anda untuk mengikuti acara ini!</p>
                                <a href="{{ $event->registration_link }}" target="_blank" class="btn btn-light btn-lg">
                                    <i class="mdi mdi-clipboard-check mr-2"></i> Daftar Sekarang
                                </a>
                            </div>
                        @endif

                        <!-- Participant Info -->
                        @if($event->max_participants)
                            <div class="mt-4">
                                <h5>Informasi Peserta</h5>
                                <div class="progress" style="height: 25px;">
                                    @php
                                        $percentage = ($event->current_participants / $event->max_participants) * 100;
                                    @endphp
                                    <div class="progress-bar bg-{{ $event->is_full ? 'danger' : 'success' }}" role="progressbar"
                                        style="width: {{ $percentage }}%" aria-valuenow="{{ $event->current_participants }}"
                                        aria-valuemin="0" aria-valuemax="{{ $event->max_participants }}">
                                        {{ $event->current_participants }} / {{ $event->max_participants }}
                                    </div>
                                </div>
                                <p class="mt-2 text-muted">
                                    @if($event->is_full)
                                        <span class="text-danger">Mohon maaf, kuota peserta telah penuh.</span>
                                    @else
                                        Tersisa {{ $event->available_slots }} slot lagi!
                                    @endif
                                </p>
                            </div>
                        @endif

                    </div>
                </div>


                <!-- ================= RIGHT SIDEBAR ================= -->
                <div class="col-lg-4">

                    <div class="sidebar">

                        <!-- Event Info Widget -->
                        <!--  <div class="widget bg-white p-4 rounded shadow-sm mb-4">
                                        <h4 class="widget-title mb-4">Detail Acara</h4>

                                        <div class="mb-3">
                                            <label class="text-muted small">Tanggal & Waktu</label>
                                            <div class="fw-bold">
                                                <i class="mdi mdi-calendar text-primary mr-2"></i>
                                                {{ $event->event_date ? $event->event_date->format('d F Y') : '-' }}
                                            </div>
                                            <div class="ms-4">
                                                {{ $event->event_date ? $event->event_date->format('H:i') : '' }} WITA
                                            </div>
                                        </div>

                                        @if($event->location)
                                            <div class="mb-3">
                                                <label class="text-muted small">Lokasi</label>
                                                <div>
                                                    <i class="mdi mdi-map-marker text-primary mr-2"></i>
                                                    {{ $event->location }}
                                                </div>
                                            </div>
                                        @endif

                                        @if($event->category)
                                            <div class="mb-3">
                                                <label class="text-muted small">Kategori</label>
                                                <div>
                                                    <span class="badge bg-primary">{{ $event->category }}</span>
                                                </div>
                                            </div>
                                        @endif

                                        @if($event->max_participants)
                                            <div class="mb-3">
                                                <label class="text-muted small">Kuota</label>
                                                <div>
                                                    {{ $event->current_participants }} / {{ $event->max_participants }} peserta
                                                </div>
                                            </div>
                                        @endif
                                    </div> -->

                        <!-- Related Events Widget -->
                        @if($relatedEvents->count() > 0)
                            <div class="widget bg-white p-4 rounded shadow-sm">
                                <h4 class="widget-title mb-4">Kegiatan Terkait</h4>

                                @foreach($relatedEvents as $related)
                                    <div class="media mb-3">

                                        <img src="{{ $related->image_url }}" alt="{{ e($related->title) }}" class="mr-3 rounded"
                                            style="width:80px; height:60px; object-fit:cover;">

                                        <div class="media-body">
                                            <a href="{{ route('frontend.event.show', $related->uuid) }}">
                                                <h6 class="mt-0 mb-1">{{ $related->title }}</h6>
                                            </a>

                                            <small class="text-muted">
                                                {{ $related->event_date ? $related->event_date->format('F d, Y') : '' }}
                                            </small>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        @endif

                    </div>

                </div>
                <!-- ================= END SIDEBAR ================= -->

            </div>
        </div>
    </section>

@endsection