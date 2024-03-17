<section class="gallery bg-white position-relative overflow-hidden z-1">
    <div class="video-banner video-banner-poster text-left" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="video-poster content-right">
                        <img style="border-radius: 0 !important;" src="{{ staticAsset('frontend/skinoasis/assets/images/banners/banner3-1.png') }}" alt="poster">
                        <div class="video-poster-content">
                            <a href="https://www.youtube.com/watch?v=vBPgmASQ1A0" class="btn-video btn-iframe"><i class="icon-play"></i></a>
                        </div><!-- End .video-poster-content -->
                    </div><!-- End .video-poster -->
                </div><!-- End .col-md-6 -->

                <div class="col-md-6 mb-3 mb-md-0">
                    <h3 class="video-banner-title fw-bold h3">
                        <span class="fw-light">TRENDING 2</span>
                        Always Make Room for a Little Beauty in Your Life
                    </h3><!-- End .video-banner-title -->
                    <p>Our beauty box is a set of best full-size products that are top sellers in out online shop.
                        We want you to be able to try everything at once and make sure that our selection of products is about quality.</p>
                    <a href="#" class="btn btn-rounded btn-sm text-uppercase btn-outline-green-dark"> Shop Now</a>
                </div><!-- End .col-md-6 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div>

    <div class="video-banner video-banner-poster text-left mt-10 pb-5" data-aos="fade-up">
        <div class="container">
            <div class="row ">

                <div class="col-md-4 mb-3 mb-md-0">
                    <h3 class="video-banner-title fw-bold h3">
                        <span class="fw-light">TRENDING 3</span>
                        Always Make Room for a Little Beauty in Your Life
                    </h3><!-- End .video-banner-title -->
                    <p>Our beauty box is a set of best full-size products that are top sellers in out online shop.
                        We want you to be able to try everything at once and make sure that our selection of products is about quality.</p>
                    <a href="#" class="btn btn-rounded btn-sm text-uppercase btn-outline-green-dark btn-bottom-c d-none d-sm-block"> Shop Now</a>
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="video-poster">
                        <img style="border-radius: 0 !important;" src="{{ staticAsset('frontend/skinoasis/assets/images/banners/banner3-1.png') }}" alt="poster">
                    </div><!-- End .video-poster -->
                </div><!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="owl-carousel owl-theme owl-testimonials mt-lg-1" data-toggle="owl"
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
                            <div class="testimonial-two text-center bg-white">
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

                    <div class="owl-carousel owl-theme owl-testimonials mt-lg-9 mt-sm-5" data-toggle="owl"
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
                            <div class="testimonial-two text-center bg-white">
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
                </div><!-- End .col-md-4 -->


            </div><!-- End .row -->
        </div><!-- End .container -->
    </div>
</section>
