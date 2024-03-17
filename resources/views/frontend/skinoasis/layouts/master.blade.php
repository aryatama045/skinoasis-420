<!DOCTYPE html>

@php
    $locale = str_replace('_', '-', app()->getLocale()) ?? 'en';
    $localLang = \App\Models\Language::where('code', $locale)->first();
    if ($localLang == null) {
        $localLang = \App\Models\Language::where('code', 'en')->first();
    }
@endphp
@if ($localLang->is_rtl == 1)
    <html dir="rtl" lang="{{ $locale }}" data-bs-theme="light">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
@endif


<head>
    <!--required meta tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!--meta-->
    <meta name="robots" content="index, follow">
    <meta name="description" content="{{ getSetting('global_meta_description') }}">
    <meta name="keywords" content="{{ getSetting('global_meta_keywords') }}">
    <meta name="author" content="skinoasis">
    <meta name="apple-mobile-web-app-title" content="Skinoasis">
    <meta name="application-name" content="Skinoasis">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ staticAsset('frontend/skinoasis/assets/images/icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    <!--favicon icon-->
    <link rel="icon" href="{{ uploadedAsset(getSetting('favicon')) }}" type="image/png" sizes="16x16">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ uploadedAsset(getSetting('favicon')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ uploadedAsset(getSetting('favicon')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ uploadedAsset(getSetting('favicon')) }}">


    <!--title-->
    <title>
        @yield('title', getSetting('system_title'))
    </title>

    @yield('meta')

    @if (!isset($detailedProduct) && !isset($blog))
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="{{ getSetting('global_meta_title') }}" />
        <meta itemprop="description" content="{{ getSetting('global_meta_description') }}" />
        <meta itemprop="image" content="{{ uploadedAsset(getSetting('global_meta_image')) }}" />

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="product" />
        <meta name="twitter:site" content="@publisher_handle" />
        <meta name="twitter:title" content="{{ getSetting('global_meta_title') }}" />
        <meta name="twitter:description" content="{{ getSetting('global_meta_description') }}" />
        <meta name="twitter:creator" content="@author_handle"/>
        <meta name="twitter:image" content="{{ uploadedAsset(getSetting('global_meta_image')) }}"/>
        <meta name="twitter:image" content="{{ uploadedAsset(getSetting('global_meta_image')) }}"/>

        <!-- Open Graph data -->
        <meta property="og:title" content="{{ getSetting('global_meta_title') }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ route('home') }}" />
        <meta property="og:image" content="{{ uploadedAsset(getSetting('global_meta_image')) }}" />
        <meta property="og:description" content="{{ getSetting('global_meta_description') }}" />
        <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
        <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
    @endif

    <!-- head-scripts -->
    @include('frontend.skinoasis.inc.head-scripts')
    <!-- head-scripts -->

    <!--build:css-->
    @include('frontend.skinoasis.inc.css', ['localLang' => $localLang])
    <!-- endbuild -->

    <!-- PWA  -->
    <meta name="theme-color" content="#6eb356"/>
    <link rel="apple-touch-icon" href="{{ staticAsset('/pwa.png') }}"/>
    <link rel="manifest" href="{{ staticAsset('/manifest.json') }}"/>

    <!-- recaptcha -->
    @if (getSetting('enable_recaptcha') == 1)
        {!! RecaptchaV3::initJs() !!}
    @endif
    <!-- recaptcha -->

</head>

<body>

    @php
        // for visitors to add to cart
        $tempValue = strtotime('now') . rand(10, 1000);
        $theTime = time() + 86400 * 365;
        if (!isset($_COOKIE['guest_user_id'])) {
            setcookie('guest_user_id', $tempValue, $theTime, '/'); // 86400 = 1 day
        }
    @endphp

    <div class="page-wrapper">


        <!--header section start-->
        @if (isset($exception))
            @if ($exception->getStatusCode() != 503)
                @include('frontend.skinoasis.inc.header')
            @endif
        @else
            @include('frontend.skinoasis.inc.header')
        @endif
        <!--header section end-->

        <!--breadcrumb section start-->
        @yield('breadcrumb')
        <!--breadcrumb section end-->

        <main class="main bg-white">

            @yield('contents')


        </main><!-- End .main -->


        <!--footer section start-->
        @if (isset($exception))
            @if ($exception->getStatusCode() != 503)
                @include('frontend.skinoasis.inc.footer')
                @include('frontend.skinoasis.inc.bottomToolbar')
            @endif
        @else
            @include('frontend.skinoasis.inc.footer')
            @include('frontend.skinoasis.inc.bottomToolbar')
        @endif
        <!--footer section end-->

    </div><!-- End .page-wrapper -->

    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- modals -->
    @include('frontend.skinoasis.pages.partials.products.quickViewModal')
    <!-- modals -->

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        @include('frontend.skinoasis.inc.navMobile')
    </div><!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="singin-email">Username or email address *</label>
                                            <input type="text" class="form-control" id="singin-email" name="singin-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password" class="form-control" id="singin-password" name="singin-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="#" class="forgot-link">Forgot Your Password?</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="register-email">Your email address *</label>
                                            <input type="email" class="form-control" id="register-email" name="register-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Password *</label>
                                            <input type="password" class="form-control" id="register-password" name="register-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login  btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->

    <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form2">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="{{ staticAsset('frontend/skinoasis/assets/images/popup/newsletter/logo.png') }}" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Skinoasis eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- .End .input-group -->
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div><!-- End .custom-checkbox -->
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="{{ staticAsset('frontend/skinoasis/assets/images/popup/newsletter/img-1.jpg') }}" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--build:js-->
    @include('frontend.skinoasis.inc.scripts')
        <!--endbuild-->

    <!--page's scripts-->
    @yield('scripts')
    <!--page's script-->

    <!--for pwa-->
    <script src="{{ url('/') . '/public/sw.js' }}"></script>
    <script>
        if (!navigator.serviceWorker?.controller) {
            navigator.serviceWorker?.register("./public/sw.js").then(function(reg) {
                // console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>
    <!--for pwa-->
</body>

</html>