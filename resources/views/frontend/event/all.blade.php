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
                            <a class="h3 text-white font-secondary" href="{{ route('frontend.event.index') }}">Events</a>
                        </li>
                    </ul>
                    <p class="text-lighten">
                        Semua acara dari Yayasan Sains Nusantara (YSN).
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- /page title -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center section-title justify-content-between">
                        <h2 class="mb-0 text-nowrap mr-3">Semua Events</h2>
                        <div class="border-top w-100 border-primary d-none d-sm-block"></div>
                    </div>
                </div>
            </div>
            <!-- event list -->
            <div class="row justify-content-center">
                @forelse($events as $event)
                    <!-- event item -->
                    <div class="col-lg-4 col-sm-6 mb-5">
                        <div class="card p-0 border-primary rounded-0 hover-shadow">
                            <img class="card-img-top rounded-0" src="{{ $event->image_url }}"
                                alt="{{ e($event->title) }}">
                            <div class="card-body">
                                <ul class="list-inline mb-2">
                                    <li class="list-inline-item">
                                        <i class="ti-calendar mr-1 text-color"></i>
                                        {{ $event->event_date ? $event->event_date->format('d-m-Y') : '' }}
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-time mr-1 text-color"></i>
                                        {{ $event->event_date ? $event->event_date->format('H:i') : '' }}
                                    </li>
                                </ul>
                                @if($event->category)
                                    <span class="badge bg-primary mb-2">{{ $event->category }}</span>
                                @endif
                                <a href="{{ route('frontend.event.show', $event->uuid) }}">
                                    <h4 class="card-title">{{ $event->title }}</h4>
                                </a>
                                @if($event->location)
                                    <p class="mb-2">
                                        <i class="ti-location-pin text-primary mr-1"></i>
                                        {{ e($event->location) }}
                                    </p>
                                @endif
                                <p class="card-text mb-4">
                                    {{ $event->description ? Str::limit($event->description, 100) : 'Deskripsi belum tersedia' }}
                                </p>
                                @if($event->registration_link)
                                    <a href="{{ $event->registration_link }}" target="_blank" class="btn btn-primary btn-sm">Register Now</a>
                                @else
                                    <a href="{{ route('frontend.event.show', $event->uuid) }}" class="btn btn-primary btn-sm">View Details</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="py-5">
                            <img src="{{ asset('assets/images/empty.png') }}" height="150" alt="No events">
                            <h4 class="text-muted mt-3">No Events</h4>
                            <p class="text-muted">Belum ada acara yang tersedia.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            <!-- /event list -->

            @if($events->hasPages())
            <div class="row">
                <div class="col-12 text-center">
                    <nav class="mt-4">
                        {{ $events->links('pagination::bootstrap-4') }}
                    </nav>
                </div>
            </div>
            @endif
        </div>
    </section>

@endsection
