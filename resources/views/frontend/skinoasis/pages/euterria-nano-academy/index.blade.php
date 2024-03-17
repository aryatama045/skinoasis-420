@extends('frontend.skinoasis.layouts.master')

@section('title')
    {{ localize('Blogs') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('breadcrumb-contents')
    <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item fw-bold" aria-current="page"><a
                href="{{ route('home') }}">{{ localize('Home') }}</a></li>
        <li class="breadcrumb-item fw-bold" aria-current="page"><a
                href="{{ route('home.blogs') }}">{{ localize('Blogs') }}</a></li>
    </ol>
@endsection

@section('contents')

    <!--blog details start-->
    <section class="blog-listing-section ptb-20">
        <div class="container">
            <div class="row g-4">
                @foreach ($blogs as $blog)
                <div class="col-xl-4 col-xl-pull-4">
                    <div class="blog-listing">
                        <article class="blog-card rounded-2 overflow-hidden bg-white p-5">
                            <div class="thumbnail overflow-hidden">
                                <a href="{{ route('home.blogs.show', $blog->slug) }}">
                                    <img src="{{ uploadedAsset($blog->banner) }}"
                                        alt="{{ $blog->collectLocalization('title') }}" class="img-fluid rounded-top">
                                </a>
                            </div>
                            <div class="blog-card-content p-0 mt-4">
                                <div class="blog-meta d-flex align-items-center gap-3 mb-2">
                                    <span class="fs-xs fw-medium"><i
                                            class="fa-solid fa-tags me-1"></i>{{ optional($blog->blog_category)->name }}</span>
                                    <span class="fs-xs fw-medium"><i
                                            class="fa-regular fa-clock me-1"></i>{{ date('M d, Y', strtotime($blog->created_at)) }}</span>
                                </div>
                                <a href="{{ route('home.blogs.show', $blog->slug) }}">
                                    <h2 class="h4 mb-3">{{ $blog->collectLocalization('title') }}</h2>
                                </a>
                                <p class="mb-0 mb-5">
                                    {{ $blog->short_description }}
                                    <a href="{{ route('home.blogs.show', $blog->slug) }}">Read more..</a>
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
                @endforeach

                <div class="mt-5">
                    {{ $blogs->appends(request()->input())->links() }}
                </div>
            </div>

        </div>
    </section>
    <!--blog details end-->
@endsection
