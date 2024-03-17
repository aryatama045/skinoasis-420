<!-- Slider -->
<div class="intro-slider-container">
    <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" data-owl-options='{"dots": true, "nav": false}'>

    @foreach ($sliders as $slider)
        @if($slider->display_on == 2)
            <div class="intro-slide" style="background-image: url({{ uploadedAsset($slider->image) }});"></div>
        @endif
    @endforeach
    </div><!-- End .intro-slider owl-carousel owl-simple -->

    <span class="slider-loader text-white"></span><!-- End .slider-loader -->
</div><!-- End .intro-slider-container -->