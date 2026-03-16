@extends('layouts.app')

@section('content')
    <?php
    $sub_title = 'View';
    $title = 'Detail Event';
    ?>
    @include('layouts.partials.page-title')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-lg-8">
                            <h3 class="header-title mb-3">{{ $event->title }}</h3>

                            <!-- Event Image -->
                            @if ($event->image && Storage::disk('public')->exists($event->image))
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                    class="img-fluid rounded mb-4"
                                    style="max-height: 400px; object-fit: cover; width: 100%;">
                            @else
                                <div class="bg-light rounded mb-4 d-flex align-items-center justify-content-center"
                                    style="height: 300px;">
                                    <div class="text-center">
                                        <i class="mdi mdi-image-off" style="font-size: 4rem; color: #ccc;"></i>
                                        <p class="text-muted mt-2">No image</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Description Section -->
                            @if ($event->description)
                                <div class="mb-4">
                                    <h5 class="mb-2">Description</h5>
                                    <p class="text-muted">{{ $event->description }}</p>
                                </div>
                            @endif

                            <!-- Content Section -->
                            @if ($event->content)
                                <div class="mb-4">
                                    <h5 class="mb-2">Full Content</h5>
                                    <div class="border-start border-4 border-primary ps-3">
                                        {!! nl2br(e($event->content)) !!}
                                    </div>
                                </div>
                            @endif

                            <!-- Metadata -->
                            <div class="row mt-4 pt-3 border-top">
                                <div class="col-md-6">
                                    <small class="text-muted">Created</small>
                                    <p class="mb-2">
                                        <i class="mdi mdi-calendar-clock me-1"></i>
                                        {{ $event->created_at->format('d F Y H:i') }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted">Last Updated</small>
                                    <p class="mb-2">
                                        <i class="mdi mdi-pencil me-1"></i>
                                        {{ $event->updated_at->format('d F Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar Info -->
                        <div class="col-lg-4">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">
                                        <i class="mdi mdi-information-outline me-2"></i>Event Information
                                    </h5>

                                    <!-- Status -->
                                    <div class="mb-4">
                                        <small class="text-muted d-block mb-2">Status</small>
                                        <div>
                                            @switch($event->status)
                                                @case('published')
                                                    <span class="badge bg-success">
                                                        <i class="mdi mdi-check-circle me-1"></i>Published
                                                    </span>
                                                @break

                                                @case('draft')
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="mdi mdi-pencil me-1"></i>Draft
                                                    </span>
                                                @break

                                                @case('cancelled')
                                                    <span class="badge bg-danger">
                                                        <i class="mdi mdi-cancel me-1"></i>Cancelled
                                                    </span>
                                                @break

                                                @case('completed')
                                                    <span class="badge bg-info">
                                                        <i class="mdi mdi-check-all me-1"></i>Completed
                                                    </span>
                                                @break

                                                @default
                                                    <span class="badge bg-secondary">Unknown</span>
                                            @endswitch
                                        </div>
                                    </div>

                                    <!-- Event Date & Time -->
                                    <div class="mb-4">
                                        <small class="text-muted d-block mb-2">Event Date & Time</small>
                                        <div class="fw-bold">
                                            <i class="mdi mdi-calendar me-2 text-primary"></i>
                                            {{ $event->formatted_event_date ?? 'Not set' }}
                                        </div>
                                    </div>

                                    <!-- Location -->
                                    <div class="mb-4">
                                        <small class="text-muted d-block mb-2">Location</small>
                                        <div>
                                            <i class="mdi mdi-map-marker me-2 text-danger"></i>
                                            <span class="fw-bold">{{ $event->location ?? 'Not specified' }}</span>
                                        </div>
                                    </div>

                                    <!-- Category -->
                                    @if ($event->category)
                                        <div class="mb-4">
                                            <small class="text-muted d-block mb-2">Category</small>
                                            <div>
                                                <span class="badge bg-primary">{{ $event->category }}</span>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Registration Link -->
                                    @if ($event->registration_link)
                                        <div class="mb-4">
                                            <small class="text-muted d-block mb-2">Registration Link</small>
                                            <a href="{{ $event->registration_link }}" target="_blank"
                                                class="btn btn-sm btn-primary w-100">
                                                <i class="mdi mdi-open-in-new me-1"></i> Open Registration
                                            </a>
                                        </div>
                                    @endif

                                    <!-- Participants -->
                                    @if ($event->max_participants)
                                        <div class="mb-4">
                                            <small class="text-muted d-block mb-2">Participants Quota</small>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="fw-bold">{{ $event->current_participants }} /
                                                    {{ $event->max_participants }}</span>
                                                @if ($event->is_full)
                                                    <span class="badge bg-danger">Full</span>
                                                @else
                                                    <span class="badge bg-success">{{ $event->available_slots }} slots
                                                        left</span>
                                                @endif
                                            </div>
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ ($event->current_participants / $event->max_participants) * 100 }}%"
                                                    aria-valuenow="{{ $event->current_participants }}" aria-valuemin="0"
                                                    aria-valuemax="{{ $event->max_participants }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Publish Date -->
                                    <div class="mb-4">
                                        <small class="text-muted d-block mb-2">Published Date</small>
                                        <div>
                                            @if ($event->published_at)
                                                <i class="mdi mdi-calendar-check me-1 text-success"></i>
                                                {{ $event->published_at->format('d F Y H:i') }}
                                            @else
                                                <span class="text-muted">Not published yet</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- UUID -->
                                    <div class="mb-3">
                                        <small class="text-muted d-block mb-2">UUID</small>
                                        <small class="text-monospace">{{ $event->uuid }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="row mt-4 pt-3 border-top">
                        <div class="col-12">
                            <a href="{{ route('admin.event.index') }}" class="btn btn-secondary">
                                <i class="mdi mdi-arrow-left me-1"></i> Back to List
                            </a>
                            <a href="{{ route('admin.event.edit', $event->uuid) }}" class="btn btn-warning">
                                <i class="mdi mdi-pencil me-1"></i> Edit
                            </a>
                            <button type="button" class="btn btn-danger btn-delete-event"
                                data-event-uuid="{{ $event->uuid }}" data-event-title="{{ $event->title }}">
                                <i class="mdi mdi-delete me-1"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Event Form (Hidden) -->
    <form id="deleteEventForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButton = document.querySelector('.btn-delete-event');
            if (deleteButton) {
                deleteButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const eventUuid = this.getAttribute('data-event-uuid');
                    const eventTitle = this.getAttribute('data-event-title');

                    Swal.fire({
                        title: 'Delete Event?',
                        html: `Are you sure you want to delete <strong>"${eventTitle}"</strong>?<br><small class="text-muted">This action cannot be undone.</small>`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, Delete!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById('deleteEventForm');
                            form.action = `{{ route('admin.event.destroy', '') }}/${eventUuid}`;
                            form.submit();
                        }
                    });
                });
            }
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    timer: 5000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif

    @php
        use Illuminate\Support\Facades\Storage;
    @endphp
@endsection
