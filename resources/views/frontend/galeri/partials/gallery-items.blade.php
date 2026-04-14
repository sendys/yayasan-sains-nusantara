@php use Illuminate\Support\Str; @endphp

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
                        <div class="overlay-content">
                            <i class="ti-search"></i>
                            <p class="title">
                                {{ Str::limit($gallery->title, 40) }}
                            </p>
                        </div>
                    </div>

                </a>

                <!-- Info -->
                <div class="card-body">

                    <!-- Kategori -->
                    <span class="badge bg-warning">
                        {{ \App\Models\Gallery::getKategoriList()[$gallery->kategori] ?? $gallery->kategori }}
                    </span>

                    <!-- Title -->
                    <p class="mt-2 mb-0">
                        {{ Str::limit($gallery->title, 100) }}
                    </p>

                </div>

            </div>
        </div>
    @endforeach