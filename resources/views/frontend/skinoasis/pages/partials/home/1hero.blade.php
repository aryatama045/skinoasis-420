<!-- Slider -->
<div class="intro-slider-container ">
    <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" data-owl-options='{"dots": true, "nav": false}'>

    @foreach ($sliders as $slider)
        @if ($slider->display_on == 1)
        <div class="intro-slide " style="background-image: url({{ uploadedAsset($slider->image) }});">
            <div class="container">
                <div class="intro-content text-center" data-aos="fade-up">
                    <!-- <h3 class="intro-subtitle cross-txt text-primary">{{ $slider->sub_title }}</h3> -->
                    <h1 class="intro-title text-white">{{ $slider->title }}</h1><!-- End .intro-title -->
                    <div class="intro-text text-white">{{ $slider->text }}</div><!-- End .intro-text -->


                    <div class="intro-action cross-txt">
                        <a href="{{ $slider->link }}" class="btn btn-outline-white">
                            <span>Discover More</span>
                        </a>
                    </div>
                </div>
            </div><!-- End .intro-content -->
        </div><!-- End .intro-slide -->
        @endif
    @endforeach
    </div><!-- End .intro-slider owl-carousel owl-simple -->

    <span class="slider-loader text-white"></span><!-- End .slider-loader -->
</div><!-- End .intro-slider-container -->