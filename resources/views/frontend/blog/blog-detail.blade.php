@extends('layouts.frontend')

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details">
                    <img src="{{ $blog->image ? asset('storage/'.$blog->image) : asset('assets/fe/images/blog/default.jpg') }}" 
                         alt="{{ $blog->title }}" 
                         class="img-fluid rounded mb-4">
                    
                    <ul class="list-inline mb-3">
                        <li class="list-inline-item me-3 ms-0">
                            <i class="mdi mdi-calendar"></i> 
                            {{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}
                        </li>
                        <li class="list-inline-item me-3 ms-0">
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

            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="widget">
                        <h4 class="widget-title">Recent Posts</h4>
                        @if($relatedBlogs->count() > 0)
                            <div class="related-posts">
                                @foreach($relatedBlogs as $related)
                                    <div class="media mb-3">
                                        <img src="{{ $related->image ? asset('storage/'.$related->image) : asset('assets/fe/images/blog/default.jpg') }}" 
                                             alt="{{ $related->title }}" 
                                             class="img-fluid rounded" 
                                             style="width: 80px; height: 60px; object-fit: cover;">
                                        <div class="media-body">
                                            <a href="{{ route('blog.show', $related->slug) }}">
                                                <h5 class="h6 mb-1">{{ $related->title }}</h5>
                                            </a>
                                            <p class="text-muted small mb-0">
                                                {{ $related->published_at ? $related->published_at->format('F d, Y') : $related->created_at->format('F d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">No related posts.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
