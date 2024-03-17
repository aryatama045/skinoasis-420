<section class="gallery bg-white pt-10 pb-xs-15" >
    <div class="container mb-3">
        <div class="row">
            <div class="col-md-8">
                <div class="clearfix">
                    <div class="heading mt-3" data-aos="fade-up">
                        <h2 class="title-banner-2 mb-2">The ultimate dream of
                            <img class="img-fluid text-left d-inline p-2 mb-2"
                                src="https://skinoasis.solusiitkreasi.com/public/uploads/media/0szep88MhwsQEGt367sGBWvjDSTF99mm4XryAZAb.png" width="200" height="25"> is make people beauty, healthy and happy</h2>
                            <img class="col-md-8 float-md-end mb-3 ms-md-3"
                                src="{{ staticAsset('frontend/skinoasis/assets/images/banners/banner2.png') }}"  alt="Banner">
                    </div>
                    <div class="entry-content text-justify mt-lg-10 mb-6" data-aos="fade-up">
                        <p>
                            skin is our asset, and skincare is our investment. Now, the dream of having a truly healthy skin is not just a wishful thinking, through science, collaboration with experts, and our love & burning enthusiasm to create a finely-effective product and be an oasis for people who search a right skincare products for their skin,   could bring us closer to our ultimate dream
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 p-md-0 wow animate__animated animate__fadeInLeft" data-aos="fade-up">
                <div class="content-right">
                    <figure class="mb-md-12">
                        <img src="{{ staticAsset('frontend/skinoasis/assets/images/banners/banner3.png') }}" alt="Banner">
                    </figure>
                </div>
                <div class="owl-carousel owl-theme owl-testimonials" data-toggle="owl"
                    data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 20,
                        "loop": true,
                        "responsive": {
                            "1200": {
                                "nav": false
                            }
                        }
                    }'>
                    @foreach ($client_feedback as $feedback)

                    <div class="testimonial text-center bg-white">
                        <cite>
                            <span>
                                <ul class="star-rating d-inline-flex align-items-center text-warning">
                                    {{ renderStarRatingFront($feedback->rating) }}
                                </ul>
                            </span>
                        </cite>

                        <p>“{{ $feedback->review }}”</p>

                        <cite>
                            {{ $feedback->name }}
                        </cite>
                    </div><!-- End .testimonial -->
                    @endforeach

                </div><!-- End .testimonials-slider owl-carousel -->
            </div>
        </div>
    </div>

    <div class="video-banner video-banner-poster text-left mt-10" data-aos="fade-up">
        <div class="container">

            @forelse ($trending1 as $tr)

                @if($tr->placement == 1)

                <div class="row align-items-center">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <h3 class="video-banner-title fw-bold h3">
                            <span class="fw-light">TRENDING 1</span>
                            {{$tr->title}}
                        </h3><!-- End .video-banner-title -->
                        <p>{{$tr->short_description}}</p>
                        <a href="{{$tr->button_shop}}" class="btn btn-rounded btn-sm text-uppercase btn-outline-green-dark"> Shop Now</a>
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="banner2-cover-bottom">
                            <img src="{{ uploadedAsset($tr->thumbnail_image) }}" alt="poster">

                            <div class="video-poster-content">
                                <a href="{{$tr->video_link}}" class="btn-video btn-iframe"><i class="icon-play"></i></a>
                            </div><!-- End .video-poster-content -->	
                        </div><!-- End .video-poster -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
                @endif

            @empty

            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h3 class="video-banner-title fw-bold h3">
                        <span class="fw-light">TRENDING 1</span>
                        Always Make Room for a Little Beauty in Your Life
                    </h3><!-- End .video-banner-title -->
                    <p>Our beauty box is a set of best full-size products that are top sellers in out online shop.
                        We want you to be able to try everything at once and make sure that our selection of products is about quality.</p>
                    <a href="#" class="btn btn-rounded btn-sm text-uppercase btn-outline-green-dark"> Shop Now</a>
                </div><!-- End .col-md-6 -->

                <div class="col-md-6">
                    <div class="banner2-cover-bottom">
                        <img src="{{ staticAsset('frontend/skinoasis/assets/images/banners/banner2.png') }}" alt="poster">

                        <div class="video-poster-content">
                            <a href="https://www.youtube.com/watch?v=vBPgmASQ1A0" class="btn-video btn-iframe"><i class="icon-play"></i></a>
                        </div><!-- End .video-poster-content -->	
                    </div><!-- End .video-poster -->
                </div><!-- End .col-md-6 -->
            </div><!-- End .row -->
            @endforelse

        </div><!-- End .container -->
    </div>
</section>
