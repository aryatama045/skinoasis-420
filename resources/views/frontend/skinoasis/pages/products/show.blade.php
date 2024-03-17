@extends('frontend.skinoasis.layouts.master')

@php
    $detailedProduct = $product;
@endphp

@section('title')
    @if ($detailedProduct->meta_title)
        {{ $detailedProduct->meta_title }}
    @else
        {{ localize('Product Details') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
    @endif
@endsection

@section('meta_description')
    {{ $detailedProduct->meta_description }}
@endsection

@section('meta_keywords')
    @foreach ($detailedProduct->tags as $tag)
        {{ $tag->name }} @if (!$loop->last)
            ,
        @endif
    @endforeach
@endsection

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">
    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">
    <meta itemprop="image" content="{{ uploadedAsset($detailedProduct->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">
    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploadedAsset($detailedProduct->meta_img) }}">
    <meta name="twitter:data1" content="{{ formatPrice($detailedProduct->min_price) }}">
    <meta name="twitter:label1" content="Price">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />
    <meta property="og:type" content="og:product" />
    <meta property="og:url" content="{{ route('products.show', $detailedProduct->slug) }}" />
    <meta property="og:image" content="{{ uploadedAsset($detailedProduct->meta_img) }}" />
    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />
    <meta property="og:site_name" content="{{ getSetting('meta_title') }}" />
    <meta property="og:price:amount" content="{{ formatPrice($detailedProduct->min_price) }}" />
    <meta property="product:price:currency" content="{{ env('DEFAULT_CURRENCY') }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endsection

@section('breadcrumb-contents')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ localize('Home') }}</a></li>
        <li class="breadcrumb-item">{{ localize('Products') }}</li>
        <li class="breadcrumb-item active" aria-current="page">{{ localize('Product Details') }}</li>
    </ol>
@endsection

@section('contents')

    <!-- <div class="page-header text-center" style="background-image: url('{{ staticAsset('frontend/skinoasis/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title"> <span> @yield('title', getSetting('system_title'))</span></h1>
        </div>
    </div> -->
    <br>
    <center>
        <div>
            <img src="{{ staticAsset('frontend/skinoasis/assets/images/page-header-bg.png') }}" style="max-width: 83%">
        </div>
    </center><br><br>

    <!--breadcrumb-->
    @include('frontend.skinoasis.inc.breadcrumb')
    <!--breadcrumb-->

    <div class="container">
        <div class="product-details-top gstore-product-quick-view bg-white rounded-3 py-6 px-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery product-gallery-vertical">
                        <div class="row">
                            @php
                                if (!is_null($product->gallery_images)) {
                                    $galleryImages = explode(',', $product->gallery_images);
                                } else {
                                    $galleryImages = [];
                                    $galleryImages[] = $product->thumbnail_image;
                                }
                            @endphp
                            <figure class="product-main-image">

                                @foreach ($galleryImages as $galleryImage)
                                @if ($loop->first)
                                <img id="product-zoom" src="{{ uploadedAsset($galleryImage) }}?thumb"
                                        data-zoom-image="{{ uploadedAsset($galleryImage) }}?thumb" alt="{{ $product->collectLocalization('name') }}">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                                @endif
                                @endforeach

                            </figure><!-- End .product-main-image -->

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                @foreach ($galleryImages as $galleryImage)
                                <a class="product-gallery-item <?php if ($loop->first) { ?>active<?php } ?>"
                                    href="#" data-image="{{ uploadedAsset($galleryImage) }}"
                                    data-zoom-image="{{ uploadedAsset($galleryImage) }}">
                                    <img src="{{ uploadedAsset($galleryImage) }}" alt="product side">
                                </a>
                                @endforeach

                            </div><!-- End .product-image-gallery -->
                        </div><!-- End .row -->
                    </div><!-- End .product-gallery -->
                </div><!-- End .col-md-6 -->

                <div class="col-md-6">
                    <div class="row g-4">
                        <div class="product-details">
                            <h1 class="product-title mt-xs-3">{{ $product->collectLocalization('name') }}</h1><!-- End .product-title -->


                            <div class="product-price">
                                @include('frontend.default.pages.partials.products.pricing', compact('product'))
                            </div><!-- End .product-price -->

                            <!-- selected variation pricing -->
                            <div class="pricing variation-pricing mt-2 d-none">
                            </div>
                            <!-- selected variation pricing -->

                            <div class="product-content">
                                <p>{{ $product->collectLocalization('short_description') }}</p>
                            </div><!-- End .product-content -->

                            @if (!empty($product->pdf))
                                <a href="{{ uploadedAsset($product->pdf) }}" target="_blank" class="btn btn-rounded btn-sm mb-1 text-uppercase btn-outline-green-dark"> Download PDF</a>
                                <div class="separator mt-4 mb-2"></div>
                            @endif


                            <form action="" class="add-to-cart-form">
                                @php
                                    $isVariantProduct = 0;
                                    $stock = 0;
                                    if ($product->variations()->count() > 1) {
                                        $isVariantProduct = 1;
                                    } else {
                                        $stock = $product->variations[0]->product_variation_stock ? $product->variations[0]->product_variation_stock->stock_qty : 0;
                                    }
                                @endphp

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="product_variation_id"
                                    @if (!$isVariantProduct) value="{{ $product->variations[0]->id }}" @endif>

                                <!-- variations -->
                                @include('frontend.default.pages.partials.products.variations', compact('product'))
                                <!-- variations -->

                                <div class="d-flex align-items-center gap-3 flex-wrap mt-5">
                                    <div class="product-details-quantity">
                                        <div class="product-qty qty-increase-decrease d-flex align-items-center">
                                            <button type="button" class="decrease">-</button>
                                            <input type="text" readonly value="1" name="quantity" min="1"
                                                @if (!$isVariantProduct) max="{{ $stock }}" @endif>
                                            <button type="button" class="increase">+</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="align-items-center mt-5">
                                    <div class="product-details-action">
                                        <button type="submit" class="btn btn-rounded btn-sm text-uppercase btn-outline-green-dark btn-product btn-cart add-to-cart-btn"
                                            @if (!$isVariantProduct && $stock < 1) disabled @endif>

                                            <span class="add-to-cart-text">
                                                @if (!$isVariantProduct && $stock < 1)
                                                    {{ localize('Out of Stock') }}
                                                @else
                                                    {{ localize('Add to Cart') }}
                                                @endif
                                            </span>
                                        </button>

                                        <button type="button" class="mt-xs-2 btn btn-rounded btn-sm text-uppercase btn-outline-green-dark btn-product btn-wishlist" title="Wishlist"
                                            onclick="addToWishlist({{ $product->id }})">
                                            Add to Wishlist
                                        </button>
                                    </div>


                                    <div class="flex-grow-1"></div>
                                    @if (getSetting('enable_reward_points') == 1)
                                        <span class="fw-bold" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="{{ localize('Reward Points') }}">
                                            <i class="fas fa-medal"></i> {{ $product->reward_points }}
                                        </span>
                                    @endif
                                </div>

                            <div class="product-details-footer">
                                    <!--product category start-->
                                    @if ($product->categories()->count() > 0)
                                        <div class="tt-category-tag mt-4 mt-4">
                                            @foreach ($product->categories as $category)
                                                <a href="{{ route('products.index') }}?&category_id={{ $category->id }}"
                                                    class="text-muted fs-xxs">{{ $category->collectLocalization('name') }}</a>
                                            @endforeach
                                        </div>
                                    @endif
                                    <!--product category end-->
                                </form>

                                <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div>
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div>
                </div><!-- End .col-md-6 -->
            </div><!-- End .row -->
        </div><!-- End .product-details-top -->
        <div class="product-details-tab">
            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{ $review->count() }})</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                    @if ($product->description)
                        {!! $product->collectLocalization('description') !!}
                    @else
                        <div class="text-dark text-center border py-2">{{ localize('Not Available') }}
                        </div>
                    @endif
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content">
                        <h3 class="mb-2">{{ localize('Additional Information') }}:</h3>
                        <table class="w-100 product-info-table">
                            @foreach (generateVariationOptions($product->variation_combinations) as $variation)
                            <tr>
                                <td class="text-dark fw-semibold">{{ $variation['name'] }}</td>
                                <td>
                                    @foreach ($variation['values'] as $value)
                                        {{ $value['name'] }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        </table>

                        <br><br>
                        @if ($product->additional_info)
                            {!! $product->additional_info !!}
                        @else
                            <div class="text-dark text-center border py-2">{{ localize('Not Available') }}
                            </div>
                        @endif
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                    <div class="reviews">
                        <h3>Reviews ({{ $review->count() }})</h3>
                        @if (count($review) >  0)
                        <div class="review">
                            @foreach ($review as $testimoni)
                            <div class="row no-gutters">
                                <div class="col-auto">
                                    <h4><a href="#">{{$testimoni->name_user }}</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val"
                                                @if ($testimoni->rating==1)
                                                    style="width: 20%;"
                                                @elseif ($testimoni->rating==2)
                                                    style="width: 40%;"
                                                @elseif ($testimoni->rating==3)
                                                    style="width: 60%;"
                                                @elseif ($testimoni->rating==4)
                                                    style="width: 80%;"
                                                @elseif ($testimoni->rating==5)
                                                    style="width: 100%;"
                                                @endif
                                            >
                                            </div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                    </div><!-- End .rating-container -->
                                    <span class="review-date">{{ getTimeAgo($testimoni->tanggal) }}</span>
                                </div><!-- End .col -->
                                <div class="col">
                                    <h4>{!! $testimoni->title !!}</h4>
                                    <div class="review-content">
                                        <p>{!! $testimoni->comment !!} </p>
                                    </div><!-- End .review-content -->
                                </div><!-- End .col-auto -->
                            </div><!-- End .row -->
                            @endforeach
                        </div><!-- End .review -->
                        @else
                            <div class="text-dark text-center border py-2">{{ localize('Not Available') }}
                            </div>
                        @endif
                    </div><!-- End .reviews -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .product-details-tab -->

        <!--related product slider start -->
        @include('frontend.skinoasis.pages.partials.products.related-products', [
            'relatedProducts' => $relatedProducts,
        ])
        <!--related products slider end-->
    </div><!-- End .container -->
@endsection
