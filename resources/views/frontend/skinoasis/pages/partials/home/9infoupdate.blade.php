<!-- Info Update -->
<div class="bg-lime pt-5 pb-5" data-aos="fade-up">
    <div class="container">
        <div class="heading-ig text-center">
            <h4>FIND UPDATE INFORMATION ABOUT <img src="{{ staticAsset('frontend/skinoasis/assets/images/logo-hashtag.png') }}" alt="Logo Hastag" width="50" class="logo-hashtag"> HERE!</h4><!-- End .title -->
        </div><!-- End .heading -->

        <div class="owl-carousel owl-simple mb-3" data-toggle="owl"
            data-owl-options='{
                "nav": false,
                "dots": false,
                "items": 5,
                "margin": 20,
                "loop": false,
                "responsive": {
                    "0": {
                        "items":2
                    },
                    "360": {
                        "items":2
                    },
                    "600": {
                        "items":3
                    },
                    "992": {
                        "items":4
                    },
                    "1200": {
                        "items":5
                    }
                }
            }'>

            @foreach ($blogs as $blog)
            <div class="instagram-feed">
                <img class="thumb-info" src="{{ uploadedAsset($blog->thumbnail_image) }}" alt="img">
                <div class="instagram-feed-content">
                    <a href="{{ route('home.blogs.show', $blog->slug) }}">
                        <i class="icon-eye-o"></i> Read More</a>
                </div>
                <p class="text-dark fw-bolder mt-lg-2 p-3"> {{ optional($blog->blog_category)->name }} </p>
            </div>
            @endforeach
        </div><!-- End .owl-carousel -->

        <div class="more-container text-center">
            <a href="{{ route('home.blogs') }}" class="btn btn-sm text-capitalize btn-outline-primary-2 btn-outline-green-skin"> Lihat Lainnya</a>
        </div>
    </div><!-- End .container -->
</div><!-- End .bg-lighter pt-5 pb-5 -->