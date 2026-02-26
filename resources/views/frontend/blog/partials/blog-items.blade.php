@foreach($blogs as $blog)
                <article class="col-lg-4 col-sm-6 mb-5">
                    <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow h-100">

                        {{-- Image --}}
                        <img class="card-img-top rounded-0"
                             src="{{ $blog->image_url }}"
                             alt="{{ $blog->title }}">

                        <div class="card-body d-flex flex-column">

                            {{-- Meta --}}
                            <ul class="list-inline mb-3">
                                <li class="list-inline-item mr-3 ml-0">
                                    {{ $blog->published_at->format('F d, Y') }}
                                </li>
                                <li class="list-inline-item mr-3 ml-0">
                                    By {{ $blog->author ?? 'Admin' }}
                                </li>
                            </ul>

                            {{-- Title --}}
                            <a href="{{ route('blog.show', $blog->slug) }}">
                                <h4 class="card-title">
                                    {{ $blog->title }}
                                </h4>
                            </a>

                            {{-- Excerpt --}}
                            <p class="card-text">
                                {{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 120) }}
                            </p>

                            {{-- Button --}}
                            <a href="{{ route('blog.show', $blog->slug) }}"
                               class="btn btn-primary btn-sm mt-auto">
                                Read More
                            </a>

                        </div>
                    </div>
                </article>
           
            @endforeach
