<div class="vertical-product-card shadow-none rounded-2 position-relative swiper-slide {{ isset($bgClass) ? $bgClass : '' }}
animate__animated animate__fadeInUp animate__delay-2s">

    @php
        $discountPercentage = discountPercentage($product);
    @endphp

    @if ($discountPercentage > 0)
        <span class="offer-badge text-white fw-bold fs-xxs bg-danger position-absolute start-0 top-0">
            -{{ discountPercentage($product) }}% <span class="text-uppercase">{{ localize('Off') }}</span>
        </span>
    @endif

    <div class="thumbnail position-relative text-center p-4">
        <img src="{{ uploadedAsset($product->thumbnail_image) }}" alt="{{ $product->collectLocalization('name') }}"
            class="img-fluid fit-cover">
        <div class="product-btns position-absolute d-flex gap-2 flex-column">
            @if (Auth::check() && Auth::user()->user_type == 'customer')
                <a href="javascript:void(0);" class="rounded-btn"><i class="fa-regular fa-heart"
                        onclick="addToWishlist({{ $product->id }})"></i></a>
            @elseif(!Auth::check())
                <a href="javascript:void(0);" class="rounded-btn"><i class="fa-regular fa-heart"
                        onclick="addToWishlist({{ $product->id }})"></i></a>
            @endif


            <a href="javascript:void(0);" class="rounded-btn" onclick="showProductDetailsModal({{ $product->id }})"><i
                    class="fa-regular fa-eye"></i></a>
        </div>
    </div>
    <div class="card-content">
        @if (getSetting('enable_reward_points') == 1)
            <span class="fs-sm fw-bold" data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-title="{{ localize('Reward Points') }}">
                <i class="fas fa-medal"></i> {{ $product->reward_points }}
            </span>
        @endif
        <!--product category start-->
        <div class="mb-2 tt-category tt-line-clamp tt-clamp-1">
            @if ($product->categories()->count() > 0)
                @foreach ($product->categories as $category)
                    <a href="{{ route('products.index') }}?&category_id={{ $category->id }}"
                        class="d-inline-block text-muted fs-sm">{{ $category->collectLocalization('name') }}
                        @if (!$loop->last)
                            ,
                        @endif
                    </a>
                @endforeach
            @endif
        </div>
        <!--product category end-->

        <a href="{{ route('products.show', $product->slug) }}"
            class="card-title fw-semibold mb-4 tt-line-clamp tt-clamp-1">{{ $product->collectLocalization('name') }}
        </a>

        <h6 class="price">
            @include('frontend.skinoasis.pages.partials.products.pricing', [
                'product' => $product,
                'onlyPrice' => true,
            ])
        </h6>



        @php
            $isVariantProduct = 0;
            $stock = 0;
            if ($product->variations()->count() > 1) {
                $isVariantProduct = 1;
            } else {
                $stock = $product->variations[0]->product_variation_stock ? $product->variations[0]->product_variation_stock->stock_qty : 0;
            }
        @endphp

        @if ($isVariantProduct)
            <a href="javascript:void(0);" class="btn-product btn-cart mt-4"
                onclick="showProductDetailsModal({{ $product->id }})">
                {{ localize('Add to Cart') }}</a>
        @else
            <form action="" class="direct-add-to-cart-form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="product_variation_id" value="{{ $product->variations[0]->id }}">
                <input type="hidden" value="1" name="quantity">

                @if (!$isVariantProduct && $stock < 1)
                    <a href="javascript:void(0);"
                        class="btn-product btn-cart mt-4 w-100">{{ localize('Out of Stock') }}</a>
                @else
                    <a href="javascript:void(0);"
                        onclick="directAddToCartFormSubmit(this)"class="btn-product btn-cart mt-4 w-100 direct-add-to-cart-btn add-to-cart-text">
                        {{ localize('Add to Cart') }}</a>
                @endif
            </form>
        @endif

    </div>
</div>
