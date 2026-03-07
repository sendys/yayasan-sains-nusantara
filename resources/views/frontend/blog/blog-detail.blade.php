@extends('layouts.frontend')

@section('content')

<!-- Page Title -->
<section class="page-title-section overlay"
    data-background="{{ asset('assets/fe/images/backgrounds/page-title.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item">
                        <a class="h3 text-white font-secondary"
                           href="{{ route('frontend.blog.index') }}">
                            Artikel
                        </a>
                    </li>
                </ul>
                <p class="text-lighten">
                    Dukungan Anda sangat berarti bagi Yayasan Sains Nusantara (YSN).
                </p>
            </div>
        </div>
    </div>
</section>
<!-- /Page Title -->


<section class="section bg-light py-5">
    <div class="container">
        <div class="row">

            <!-- ================= LEFT CONTENT ================= -->
            <div class="col-lg-8 mb-4">

                <div class="blog-details bg-white p-4 rounded shadow-sm">

                    <img src="{{ $blog->image ? asset('storage/'.$blog->image) : asset('assets/fe/images/blog/default.jpg') }}"
                         alt="{{ e($blog->title) }}"
                         class="img-fluid rounded mb-4">

                    <ul class="list-inline mb-3 text-muted">
                        <li class="list-inline-item mr-3 ml-0">
                            <i class="mdi mdi-calendar"></i>
                            {{ $blog->published_at 
                                ? $blog->published_at->format('F d, Y') 
                                : $blog->created_at->format('F d, Y') }}
                        </li>

                        <li class="list-inline-item mr-3">
                            <i class="mdi mdi-account"></i>
                            {{ $blog->author ?? 'Admin' }}
                        </li>
                    </ul>

                    <h2 class="mb-3">{{ $blog->title }}</h2>

                    @if($blog->excerpt)
                        <p class="lead mb-4">{{ $blog->excerpt }}</p>
                    @endif

                    <div class="blog-content">
                        {!! $blog->content !!}
                    </div>

                </div>
            </div>


            <!-- ================= RIGHT SIDEBAR ================= -->
            <div class="col-lg-4">

                <div class="sidebar">

                    <div class="widget bg-white p-4 rounded shadow-sm">
                        <h4 class="widget-title mb-4">Recent Posts</h4>

                        @if($relatedBlogs->count() > 0)

                            @foreach($relatedBlogs as $related)
                                <div class="media mb-3">

                                    <img src="{{ $related->image ? asset('storage/'.$related->image) : asset('assets/fe/images/blog/default.jpg') }}"
                                         alt="{{ e($related->title) }}"
                                         class="mr-3 rounded"
                                         style="width:80px; height:60px; object-fit:cover;">

                                    <div class="media-body">
                                        <a href="{{ route('frontend.blog.show', $related->slug) }}">
                                            <h6 class="mt-0 mb-1">{{ $related->title }}</h6>
                                        </a>

                                        <small class="text-muted">
                                            {{ $related->published_at 
                                                ? $related->published_at->format('F d, Y') 
                                                : $related->created_at->format('F d, Y') }}
                                        </small>
                                    </div>

                                </div>
                            @endforeach

                        @else
                            <p class="text-muted mb-0">No related posts.</p>
                        @endif

                    </div>

                </div>

            </div>
            <!-- ================= END SIDEBAR ================= -->

        </div>
    </div>
</section>

@endsection
