<!-- Plugins JS File -->
<script src="{{ staticAsset('frontend/default/assets/js/vendors/jquery-3.6.4.min.js') }}"></script>
<!-- Plugins JS File -->
<script src="{{ staticAsset('frontend/skinoasis/assets/js/jquery.min.js') }}"></script>
<script src="{{ staticAsset('frontend/default/assets/js/vendors/jquery-ui.min.js') }}"></script>
<script src="{{ staticAsset('frontend/skinoasis/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ staticAsset('frontend/skinoasis/assets/js/jquery.hoverIntent.min.js') }}"></script>

<script src="{{ staticAsset('frontend/skinoasis/assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ staticAsset('frontend/skinoasis/assets/js/superfish.min.js') }}"></script>
<script src="{{ staticAsset('frontend/skinoasis/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ staticAsset('frontend/skinoasis/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ staticAsset('frontend/skinoasis/assets/js/isotope.pkgd.min.js') }}"></script>

<script src="{{ staticAsset('frontend/skinoasis/assets/js/wNumb.js') }}"></script>
<script src="{{ staticAsset('frontend/skinoasis/assets/js/nouislider.min.js') }}"></script>
<script src="{{ staticAsset('frontend/skinoasis/assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ staticAsset('frontend/skinoasis/assets/js/jquery.elevateZoom.min.js') }}"></script>

<script src="{{ staticAsset('frontend/default/assets/js/vendors/swiper-bundle.min.js') }}"></script>
<script src="{{ staticAsset('frontend/default/assets/js/vendors/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ staticAsset('frontend/default/assets/js/vendors/simplebar.min.js') }}"></script>
<script src="{{ staticAsset('frontend/default/assets/js/vendors/parallax-scroll.js') }}"></script>
<script src="{{ staticAsset('frontend/default/assets/js/vendors/isotop.pkgd.min.js') }}"></script>
<script src="{{ staticAsset('frontend/default/assets/js/vendors/countdown.min.js') }}"></script>
<script src="{{ staticAsset('frontend/default/assets/js/vendors/range-slider.js') }}"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Main JS File -->

<script src="{{ staticAsset('frontend/skinoasis/assets/main.js') }}"></script>

<script src="{{ staticAsset('frontend/skinoasis/assets/js/main.js') }}"></script>
<script src="{{ staticAsset('frontend/skinoasis/assets/js/main.min.js') }}"></script>

<script src="{{ staticAsset('frontend/default/assets/js/vendors/counterup.min.js') }}"></script>
<script src="{{ staticAsset('frontend/default/assets/js/vendors/clipboard.min.js') }}"></script>


<script src="{{ staticAsset('frontend/common/js/toastr.min.js') }}"></script>
<script src="{{ staticAsset('frontend/common/js/select2.js') }}"></script>
<script src="{{ staticAsset('frontend/default/assets/js/app.js') }}"></script>

<script src="{{ staticAsset('frontend/skinoasis/assets/js/demos/demo-18.js') }}"></script>


<!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/65a09b838d261e1b5f5225bd/1hjtluuil';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script> -->
<!--End of Tawk.to Script-->

<script>
    "use strict"

    // runs when the document is ready
    $(document).ready(function() {
        initIsotop();

        AOS.init();

        // zoom
        if ( $.fn.elevateZoom ) {
            $('#product-zoom').elevateZoom({
                gallery:'product-zoom-gallery',
                galleryActiveClass: 'active',
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 400,
                zoomWindowFadeOut: 400,
                responsive: true
            });

            // On click change thumbs active item
            $('.product-gallery-item').on('click', function (e) {
                $('#product-zoom-gallery').find('a').removeClass('active');
                $(this).addClass('active');

                e.preventDefault();
            });

            var ez = $('#product-zoom').data('elevateZoom');

            // Open popup - product images
            $('#btn-product-gallery').on('click', function (e) {
                if ( $.fn.magnificPopup ) {
                    $.magnificPopup.open({
                        items: ez.getGalleryList(),
                        type: 'image',
                        gallery:{
                            enabled:true
                        },
                        fixedContentPos: false,
                        removalDelay: 600,
                        closeBtnInside: false
                    }, 0);

                    e.preventDefault();
                }
            });
        }

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

    // tooltip
    $(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });

    //isotop filter grid 
    function initIsotop() {
        var $filter_grid = $(".filter_group").isotope({});
        $(".filter-btns").on("click", "button", function() {
            var filterValue = $(this).attr("data-filter");
            $filter_grid.isotope({
                filter: filterValue,
            });
            $(this).parent().find("button.active").removeClass("active");
            $(this).addClass("active");
        });
    }


    // copy coupon code
    $(function() {
        new ClipboardJS('.copy-text');
    });
    $(".copyBtn").each(function() {
        $(this).on("click", function() {
            $(this).html('{{ 'Copied' }}');
        });
    });

    // change language
    function changeLocaleLanguage(e) {
        var locale = e.dataset.flag;
        $.post("{{ route('backend.changeLanguage') }}", {
            _token: '{{ csrf_token() }}',
            locale: locale
        }, function(data) {
            setTimeout(() => {
                location.reload();
            }, 300);
        });
    }

    // change currency
    function changeLocaleCurrency(e) {
        var currency_code = e.dataset.currency;
        $.post("{{ route('backend.changeCurrency') }}", {
            _token: '{{ csrf_token() }}',
            currency_code: currency_code
        }, function(data) {
            setTimeout(() => {
                location.reload();
            }, 300);
        });
    }

    // change location
    function changeLocation(e) {
        var location_id = e.dataset.location;
        $.post("{{ route('backend.changeLocation') }}", {
            _token: '{{ csrf_token() }}',
            location_id: location_id
        }, function(data) {
            setTimeout(() => {
                location.reload();
            }, 300);
        });
    }


    // showRejectionReason
    function showRejectionReason(reason) {
        $('.reason').empty();
        $('#refundRejectionModal').modal('show');
        $('.reason').html(reason);
    }

    // show product details in modal
    function showProductDetailsModal(productId) {
        $('#quickview_modal .product-info').html(null);
        $('.data-preloader-wrapper>div').addClass('spinner-border');
        $('.data-preloader-wrapper').addClass('min-h-400');
        $('#quickview_modal').modal('show');

        $.post('{{ route('products.showInfo') }}', {
            _token: '{{ csrf_token() }}',
            id: productId
        }, function(data) {
            setTimeout(() => {
                $('.data-preloader-wrapper>div').removeClass('spinner-border');
                $('.data-preloader-wrapper').removeClass('min-h-400');
                $('#quickview_modal .product-info').html(data);
                TT.ProductSliders();
                cartFunc();
            }, 200);
        });
    }

    $('#quickview_modal').on('hide.bs.modal', function(e) {
        $('#quickview_modal .product-info').html(null);
    });

    // address modal select2
    function addressModalSelect2(parent = '.addAddressModal') {
        $('.select2Address').select2({
            dropdownParent: $(parent)
        });
    }
    addressModalSelect2();

    // ajax toast
    function notifyMe(level, message) {
        if (level == 'danger') {
            level = 'error';
        }
        toastr.options = {
            "timeOut": "5000",
            "closeButton": true,
            "positionClass": "toast-top-center",
        };
        toastr[level](message);
    }

    // laravel flash as toast messages
    @foreach (session('flash_notification', collect())->toArray() as $message)
        notifyMe("{{ $message['level'] }}", "{{ $message['message'] }}");
    @endforeach


    @if (!empty($errors->all()))
        @foreach ($errors->all() as $error)
            notifyMe("error", '{{ $error }}')
        @endforeach
    @endif


    // get selected variation information
    function getVariationInfo() {
        if ($('.add-to-cart-form input[name=quantity]').val() > 0 && isValidForAddingToCart()) {
            let data = $('.add-to-cart-form').serializeArray();
            $.ajax({
                type: "POST",
                url: '{{ route('products.getVariationInfo') }}',
                data: data,
                success: function(response) {

                    $('.all-pricing').addClass('d-none');
                    $('.variation-pricing').removeClass('d-none');
                    $('.variation-pricing').html(response.data.price);

                    $('.add-to-cart-form input[name=product_variation_id]').val(response.data
                        .id);
                    $('.add-to-cart-form input[name=quantity]').prop('max', response.data.stock);

                    if (response.data.stock < 1) {
                        $('.add-to-cart-btn').prop('disabled', true);
                        $('.add-to-cart-btn .add-to-cart-text').html(TT.localize.outOfStock);
                    } else {
                        $('.add-to-cart-btn').prop('disabled', false);
                        $('.add-to-cart-btn .add-to-cart-text').html(TT.localize.addToCart);
                        $('.qty-increase-decrease input[name=quantity]').val(1);
                    }
                }
            });
        }
    }

    // check if it can be added to cart
    function isValidForAddingToCart() {

        var count = 0;
        $('.variation-for-cart').each(function() {
            // how many variations
            count++;
        });

        if ($('.product-radio-btn input:radio:checked').length == count) {
            return true;
        }

        return false;
    }

    // cart func
    function cartFunc() {
        // on selection of variation
        $('.product-radio-btn input').on('change', function() {
            getVariationInfo();
        });

        // increase qty
        $('.qty-increase-decrease .increase').on('click', function() {
            var prevValue = $('.product-qty input[name=quantity]').val();
            var maxValue = $('.product-qty input[name=quantity]').attr('max');
            if (maxValue == undefined || parseInt(prevValue) < parseInt(maxValue)) {
                $('.qty-increase-decrease input[name=quantity]').val(parseInt(prevValue) + 1)
            }
        });

        // decrease qty
        $('.qty-increase-decrease .decrease').on('click', function() {
            var prevValue = $('.product-qty input[name=quantity]').val();
            if (prevValue > 1) {
                $('.qty-increase-decrease input[name=quantity]').val(parseInt(prevValue) - 1)
            }
        });

        // add to cart form submit
        $('.add-to-cart-form').on('submit', function(e) {
            e.preventDefault();
            if (isValidForAddingToCart()) {
                $('.add-to-cart-btn').prop('disabled', true);
                $('.add-to-cart-btn .add-to-cart-text').html(TT.localize.addingToCart);

                // add to cart here
                let data = $('.add-to-cart-form').serializeArray();
                $.ajax({
                    type: "POST",
                    url: '{{ route('carts.store') }}',
                    data: data,
                    success: function(data) {
                        $('.add-to-cart-btn').prop('disabled', false);
                        $('.add-to-cart-btn .add-to-cart-text').html(TT.localize.addToCart);
                        updateCarts(data);
                        notifyMe(data.alert, data.message);
                    }
                });

            } else {
                optionsAlert();
            }
        })
    }
    cartFunc();

    // without variation form submit
    function directAddToCartFormSubmit($this) {
        // add to cart here
        let parent = $($this).closest('.direct-add-to-cart-form');

        parent.find('.direct-add-to-cart-btn').prop('disabled', true);

        let text = parent.find('.add-to-cart-text').html();
        parent.find('.add-to-cart-text').html(TT.localize.pleaseWait);


        let data = parent.serializeArray();
        $.ajax({
            type: "POST",
            url: '{{ route('carts.store') }}',
            data: data,
            success: function(data) {
                parent.find('.direct-add-to-cart-btn').prop('disabled', false);

                if (text.includes("Buy Now")) {
                    parent.find('.add-to-cart-text').html(TT.localize.buyNow);
                } else {
                    parent.find('.add-to-cart-text').html(TT.localize.addToCart);
                }
                updateCarts(data);
                notifyMe(data.alert, data.message);
            }
        });
    }

    // please choose all the available options
    function optionsAlert() {
        notifyMe('warning', TT.localize.optionsAlert);
    }

    // handleCartItem
    function handleCartItem(action, id) {
        let data = {
            _token: "{{ csrf_token() }}",
            action: action,
            id: id,
        };

        $.ajax({
            type: "POST",
            url: '{{ route('carts.update') }}',
            data: data,
            success: function(data) {
                if (data.success == true) {

                    $('.apply-coupon-btn').removeClass('d-none');
                    $('.clear-coupon-btn').addClass('d-none');
                    $('.apply-coupon-btn').prop('disabled', false);
                    $('.apply-coupon-btn').html(TT.localize.applyCoupon);
                    updateCarts(data);
                    if (action == 'increase' && data.message) {
                        notifyMe(data.alert, data.message);
                    }
                }
            }
        });
    }

    // coupon-form form submit
    $('.coupon-form').on('submit', function(e) {
        e.preventDefault();
        $('.apply-coupon-btn').prop('disabled', true);
        $('.apply-coupon-btn').html(TT.localize.pleaseWait);

        // apply coupon here
        let data = $('.coupon-form').serializeArray();
        $.ajax({
            type: "POST",
            url: '{{ route('carts.applyCoupon') }}',
            data: data,
            success: function(data) {
                if (data.success == false) {
                    notifyMe('error', data.message);
                    $('.apply-coupon-btn').prop('disabled', false);
                    $('.apply-coupon-btn').html(TT.localize.applyCoupon);
                } else {
                    // append clear button 
                    $('.coupon-input').prop('disabled', false);
                    $('.apply-coupon-btn').addClass('d-none');
                    $('.clear-coupon-btn').removeClass('d-none');

                    $('.apply-coupon-btn').prop('disabled', false);
                    $('.apply-coupon-btn').html(TT.localize.applyCoupon);

                    updateCouponPrice(data);

                }
            }
        });
    })

    // clear-coupon-btn clicked
    $('.clear-coupon-btn').on('click', function(e) {
        e.preventDefault();
        // append clear button 
        $('.coupon-input').prop('disabled', false);
        $('.apply-coupon-btn').removeClass('d-none');
        $('.clear-coupon-btn').addClass('d-none');

        $.ajax({
            type: "GET",
            url: '{{ route('carts.clearCoupon') }}',
            success: function(data) {
                updateCouponPrice(data);
            }
        });
    })

    function updateCouponPrice(data) {
        $('.coupon-discount-wrapper').toggleClass('d-none');
        $('.coupon-discount-price').html(data.couponDiscount);
    }

    // update carts markup
    function updateCarts(data) {
        $('.cart-counter').empty();
        $('.sub-total-price').empty();

        $('.cart-navbar-wrapper .simplebar-content').empty();
        $('.cart-listing').empty();

        if (data.cartCount > 0) {
            $('.cart-counter').removeClass('d-none');
        } else {
            $('.cart-counter').addClass('d-none');
        }

        $('.cart-counter').html(data.cartCount);
        $('.sub-total-price').html(data.subTotal);
        $('.cart-navbar-wrapper .simplebar-content').html(data.navCarts);
        $('.cart-listing').html(data.carts);
        $('.coupon-discount-wrapper').addClass('d-none');
        $('.checkout-sidebar').empty();

    }

    // get logistics to check out
    function getLogistics(city_id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: "{{ route('checkout.getLogistic') }}",
            type: 'POST',
            data: {
                city_id: city_id
            },
            success: function(data) {
                $('.checkout-sidebar').empty();
                $('.checkout-logistics').empty();
                $('.checkout-logistics').html(data.logistics);
                $('.checkout-sidebar').html(data.summary);
            }
        });
    }

    //  get logistics to check out -- onchange
    $(document).on('change', '[name=chosen_logistic_zone_id]', function() {
        var chosen_logistic_zone_id = $(this).val();
        getShippingAmount(chosen_logistic_zone_id);
    });

    // get logistics to check out
    function getShippingAmount(logistic_zone_id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: "{{ route('checkout.getShippingAmount') }}",
            type: 'POST',
            data: {
                logistic_zone_id: logistic_zone_id
            },
            success: function(data) {
                $('.checkout-sidebar').empty();
                $('.checkout-sidebar').html(data);
            }
        });
    }

    //  submit checkout form
    $(document).on('submit', '.checkout-form', function(e) {
        // shipping address not selected
        if ($('.checkout-form input[name=shipping_address_id]:checked').length == 0) {
            notifyMe('error', '{{ localize('Please select shipping address') }}');
            e.preventDefault();;
            return false;
        }

        // logistic not selected
        if ($('.checkout-form input[name=chosen_logistic_zone_id]:checked').length == 0) {
            notifyMe('error', '{{ localize('Please select logistic') }}');
            e.preventDefault();;
            return false;
        }

        // billing address not selected
        if ($('.checkout-form input[name=billing_address_id]:checked').length == 0) {
            notifyMe('error', '{{ localize('Please select billing address') }}');
            e.preventDefault();;
            return false;
        }
    });

    // add to wishlist
    function addToWishlist(productId) {
        @if (auth()->check())
            @if (auth()->user()->user_type == 'customer')
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: "POST",
                    url: '{{ route('customers.wishlist.store') }}',
                    data: {
                        product_id: productId
                    },
                    success: function(data) {
                        notifyMe('success', data.message);
                    }
                });
            @else
                notifyMe('danger', '{{ localize('Only customer can add products to wishlist') }}');
            @endif
        @else
            notifyMe('warning', '{{ localize('Please login first') }}');
        @endif
    }
</script>

