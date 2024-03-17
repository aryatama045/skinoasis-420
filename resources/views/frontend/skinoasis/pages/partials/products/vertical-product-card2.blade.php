<div class="product product-7 text-center ">
    <figure class="product-media">

        @php
            $discountPercentage = discountPercentage($product);
        @endphp

        @if ($discountPercentage > 0)
            <span class="product-label label-new">
                -{{ discountPercentage($product) }}% <span class="text-uppercase">{{ localize('Off') }}</span>
            </span>
        @endif
        

        
        <img src="{{ uploadedAsset($product->thumbnail_image) }}" alt="{{ $product->collectLocalization('name') }}"
                class="product-image">
        

        <div class="product-action-vertical">
            <!-- Add Wishlist -->
            @if (Auth::check() && Auth::user()->user_type == 'customer')
                <a href="javascript:void(0);" class="btn-product-icon btn-wishlist btn-expandable"
                    onclick="addToWishlist({{ $product->id }})"> </a>
            @elseif(!Auth::check())
                <a href="javascript:void(0);" class="btn-product-icon btn-wishlist btn-expandable"
                    onclick="addToWishlist({{ $product->id }})">
                </a>
            @endif

            <!-- Quick view -->
            <a href="javascript:void(0);" class="btn-product-icon btn-quickview" onclick="showProductDetailsModal({{ $product->id }})"></a>
            <!-- <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a> -->

            <!-- Compare -->
            <!-- <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a> -->

        </div><!-- End .product-action-vertical -->

        <!-- <div class="product-action">
            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
        </div> -->
        <!-- End .product-action -->

    </figure><!-- End .product-media -->

    <div class="product-body">

        @if (getSetting('enable_reward_points') == 1)
            <span class="fs-xxs fw-bold" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-title="{{ localize('Reward Points') }}">
                <i class="fas fa-medal"></i> {{ $product->reward_points }}
            </span>
        @endif

        <!--product category start-->
        @if ($product->categories()->count() > 0)
            <div class="product-cat">
                @foreach ($product->categories as $category)
                    <a href="{{ route('products.index') }}?&category_id={{ $category->id }}"
                        class="text-muted fs-xxs">{{ $category->collectLocalization('name') }}</a>
                @endforeach
            </div>
        @endif
        <!-- End .product-cat -->


        <h3 class="product-title">
            <a href="{{ route('products.show', $product->slug) }}">
                {{ $product->collectLocalization('name') }}
            </a>
        </h3><!-- End .product-title -->
        
        <div class="product-price">
            @include('frontend.default.pages.partials.products.pricing', [
                'product' => $product,
                'onlyPrice' => true,
            ])
        </div><!-- End .product-price -->

        @isset($showSold)
            <div class="card-progressbar mb-2 mt-3 rounded-pill">
                <span class="card-progress bg-primary" data-progress="{{ sellCountPercentage($product) }}%"
                    style="width: {{ sellCountPercentage($product) }}%;"></span>
            </div>
            <p class="mb-0 fw-semibold">{{ localize('Total Sold') }}: <span
                    class="fw-bold text-secondary">{{ $product->total_sale_count }}/{{ $product->sell_target }}</span>
            </p>
        @endisset


        @php
            $isVariantProduct = 0;
            $stock = 0;
            if ($product->variations()->count() > 1) {
                $isVariantProduct = 1;
            } else {
                $stock = $product->variations[0]->product_variation_stock ? $product->variations[0]->product_variation_stock->stock_qty : 0;
            }
        @endphp

        
            
            
            

            <div class="ratings-container">
            @if ($isVariantProduct)
                <a href="javascript:void(0);" class="btn btn-outline-secondary btn-md border-secondary d-block mt-4"
                    onclick="showProductDetailsModal({{ $product->id }})">{{ localize('Add to Cart') }}</a>
            @else
                <form action="" class="direct-add-to-cart-form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="product_variation_id" value="{{ $product->variations[0]->id }}">
                    <input type="hidden" value="1" name="quantity">

                    @if (!$isVariantProduct && $stock <= 0)
                        <a href="javascript:void(0);"
                            class="btn btn-outline-secondary btn-md border-secondary d-block mt-4 w-100">{{ localize('Out of Stock') }}</a>
                    @else
                        <a href="javascript:void(0);"
                            onclick="directAddToCartFormSubmit(this)"class="btn btn-outline-secondary btn-md border-secondary d-block mt-4 w-100 direct-add-to-cart-btn add-to-cart-text">
                            {{ localize('Add to Cart') }}</a>
                    @endif
                </form>
            @endif
                
            </div><!-- End .rating-container -->
        

    </div><!-- End .product-body -->
</div><!-- End .product -->