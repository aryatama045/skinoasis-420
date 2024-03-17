@extends('frontend.skinoasis.layouts.master')

@section('title')
    {{ localize('Customer Dashboard') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')

@include('frontend.skinoasis.pages.users.partials.cssUser')

<section class="my-account pb-120">

    @include('frontend.skinoasis.pages.users.partials.profileWidget')

    <div class="container mt-8">
        <div class="row">
            <div class="col-lg-8" >
                <div class="user-content rounded shadow-box bg-white py-5 mb-3">
                    <div class="p-4 ">
                        <ul class="nav nav-pills justify-content-center" id="tabs-6" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-21-tab" data-toggle="tab" href="#tab-21" role="tab" aria-controls="tab-21" aria-selected="true">ARTICLE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-23-tab" data-toggle="tab" href="#tab-23" role="tab" aria-controls="tab-23" aria-selected="false">REVIEW</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-22-tab" data-toggle="tab" href="#tab-22" role="tab" aria-controls="tab-22" aria-selected="false">VIDEO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-24-tab" data-toggle="tab" href="#tab-24" role="tab" aria-controls="tab-24" aria-selected="false">PHOTO</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab-content-6">
                            <div class="tab-pane fade active show" id="tab-21" role="tabpanel" aria-labelledby="tab-21-tab">
                                <!-- Article -->
                                @include('frontend.skinoasis.pages.users.content.articleList')
                            </div>

                            <div class="tab-pane fade" id="tab-22" role="tabpanel" aria-labelledby="tab-22-tab">
                                <!-- Video -->
                                @include('frontend.skinoasis.pages.users.content.feedVideo')
                            </div>

                            <div class="tab-pane fade" id="tab-23" role="tabpanel" aria-labelledby="tab-23-tab">
                                <!-- Review -->
                                @include('frontend.skinoasis.pages.users.content.reviewList')
                            </div>

                            <div class="tab-pane fade" id="tab-24" role="tabpanel" aria-labelledby="tab-24-tab">
                                <!-- Photo -->
                                @include('frontend.skinoasis.pages.users.content.feedPhoto')
                            </div>

                        </div><!-- End .tab-content -->
                    </div>
                </div>
            </div>

            <div class="col-lg-4" >
                <div class="icondiv rounded shadow-box bg-white ">
                    <img src="{{ staticAsset('frontend/skinoasis/assets/images/icons/icon-send.JPG') }}" alt="icon" class="icon-img">
                    <div class="icon-content">
                        <h5 class="mb-3">INVITE YOUR FRIENDS</h5>
                        <p class="text-dark mb-2">
                            Bagikan link referral ke temanmu via media sosial, kontak, atau email.
                        </p>
                        <!-- <ul class="list-inline small text-muted mt-3 mb-0">
                            <li class="list-inline-item"><i class="fa fa-comment-o mr-2"></i>12 Comments</li>
                            <li class="list-inline-item"><i class="fa fa-heart-o mr-2"></i>200 Likes</li>
                        </ul> -->
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="icondiv rounded shadow-box bg-white mt-5">
                    <img src="{{ staticAsset('frontend/skinoasis/assets/images/icons/icon-form.JPG') }}" alt="icon" class="icon-img">
                    <div class="icon-content">
                        <h5 class="mb-3">REGISTRATION & VERIFICATION</h5>
                        <p class="text-dark mb-2">
                            Setelah berhasil mendaftarkan diri melalui link referral, memverifikasi nomor HP, dan melengkapi Profile, temanmu akan mendapatkan voucher 20% untuk belanja cantik pertamanya di SKINOASIS
                        </p>
                        <!-- <ul class="list-inline small text-muted mt-3 mb-0">
                            <li class="list-inline-item"><i class="fa fa-comment-o mr-2"></i>12 Comments</li>
                            <li class="list-inline-item"><i class="fa fa-heart-o mr-2"></i>200 Likes</li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="cta cta-horizontal mt-lg-7 mb-3 rounded shadow-box bg-white p-4">
            <div class="row align-items-center">
                <div class="col-lg-4 col-xl-3 offset-xl-1">
                    <h3 class="text-green text-capitalize">INVITE VIA EMAIL </h3>
                </div>

                <div class="col-lg-8 col-xl-7">
                    <form action="#">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Enter your Email Address" aria-label="Email Adress" required="">
                            <div class="input-group-append">
                                <button class="btn btn-rounded btn-sm text-uppercase btn-outline-green-dark" type="submit"><span class="text-capitalize"> kirim email</span><i class="icon-long-arrow-right"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="mt-lg-5 rounded shadow-box bg-white p-4">
                    <div class="icondiv">
                        <img src="{{ staticAsset('frontend/skinoasis/assets/images/icons/icon-send.JPG') }}" alt="icon" class="icon-img">
                        <div class="icon-content">
                            <h5 class="mb-3">SHARE QR CODE</h5>
                            <p class="text-dark mb-2">
                                Bagikan kode QR untuk ajak temanmu
                            </p>
                            <button class="btn btn-rounded btn-sm text-uppercase btn-outline-green-dark" >
                                <span class="text-capitalize"> Share Image</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mt-lg-5 mt-sm-5 rounded shadow-box bg-white p-4">
                    <div class="icondiv">
                        <img src="{{ staticAsset('frontend/skinoasis/assets/images/icons/icon-send.JPG') }}" alt="icon" class="icon-img">
                        <div class="icon-content">
                            <h5 class="mb-3">SHARE LINK</h5>
                            <p class="text-dark mb-2">
                                Bagikan Referral Anda via media Social
                            </p>
                            <div class="social-icons social-icons-color">
                                <a href="#" class="social-icon text-green" title="Whatsapp" target="_blank"><i class="icon-whatsapp"></i></a>
                                <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook"></i></a>
                                <a href="#" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                <a href="#" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-3 mb-5">
        <h5 class="title text-center text-uppercase text-green mb-5">
            <a href="#">Syarat & Ketentuan</a>
        </h5>

    </div>



</section>


@endsection


@section('scripts')
    <script>
        "use strict";
        // runs when the document is ready
        $(document).ready(function() {


            // Masonry / Grid layout fnction
            var layoutInit = function( container, selector, space ) {
                $(container).each(function () {
                    var $this = $(this);

                    $this.isotope({
                        itemSelector: selector,
                        layoutMode: ( $this.data('layout') ? $this.data('layout'): 'masonry' ),
                        masonry: {
                            columnWidth: space
                        }
                    });
                });
            }

            var isotopeFilter = function( filterNav, container) {
                $(filterNav).find('a').on('click', function(e) {
                    var $this = $(this),
                        filter = $this.attr('data-filter');

                    // Remove active class
                    $(filterNav).find('.active').removeClass('active');

                    // Init filter
                    $(container).isotope({
                        filter: filter,
                        transitionDuration: '0.7s'
                    });

                    // Add active class
                    $this.closest('li').addClass('active');
                    e.preventDefault();
                });
            }

            /* Masonry / Grid Layout & Isotope Filter for blog/portfolio etc... */
            if ( typeof imagesLoaded === 'function' && $.fn.isotope) {
                // Portfolio
                $('.portfolio-container').imagesLoaded(function () {
                    // Portfolio Grid/Masonry
                    layoutInit( '.portfolio-container', '.portfolio-item' ); // container - selector
                    // Portfolio Filter
                    isotopeFilter( '.portfolio-filter',  '.portfolio-container'); //filterNav - .container
                });

                // Blog
                $('.entry-container').imagesLoaded(function () {
                    // Blog Grid/Masonry
                    layoutInit( '.entry-container', '.entry-item' ); // container - selector
                    // Blog Filter
                    isotopeFilter( '.entry-filter',  '.entry-container'); //filterNav - .container
                });

                // Product masonry product-masonry.html
                $('.product-gallery-masonry').imagesLoaded(function () {
                    // Products Grid/Masonry
                    layoutInit( '.product-gallery-masonry', '.product-gallery-item' ); // container - selector
                });

                // Products - Demo 11
                $('.products-container').imagesLoaded(function () {
                    // Products Grid/Masonry
                    layoutInit( '.products-container', '.product-item' ); // container - selector
                    // Product Filter
                    isotopeFilter( '.product-filter',  '.products-container'); //filterNav - .container
                });

                layoutInit('.grid', '.grid-item', '.grid-space');
            }


        });
    </script>
@endsection

