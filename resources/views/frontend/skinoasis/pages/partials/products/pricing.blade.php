@if (productBasePrice($product) == discountedProductBasePrice($product))
    @if (productBasePrice($product) == productMaxPrice($product))
        <span class="fw-semibold price-product mt-lg-4 mb-lg-3 ">{{ formatPrice(productBasePrice($product)) }}</span>
    @else
        <span class="fw-semibold price-product mt-lg-4 mb-lg-3 ">{{ formatPrice(productBasePrice($product)) }} - {{ formatPrice(productMaxPrice($product)) }}</span>

    @endif
@else
    @if (discountedProductBasePrice($product) == discountedProductMaxPrice($product))
        <span class="fw-semibold price-product mt-lg-4 mb-lg-3 ">{{ formatPrice(discountedProductBasePrice($product)) }}</span>
    @else
        <span class="fw-semibold price-product mt-lg-4 mb-lg-3 ">{{ formatPrice(discountedProductBasePrice($product)) }} - {{ formatPrice(discountedProductMaxPrice($product)) }}</span>
    @endif

    @if (isset($br))
        <br>
    @endif

    @if (!isset($onlyPrice) || $onlyPrice == false)
        @if (productBasePrice($product) == productMaxPrice($product))
            <span
                class="fw-semibold price-product mt-lg-4 mb-lg-3 deleted text-muted {{ isset($br) ? '' : 'ms-1' }}">{{ formatPrice(productBasePrice($product)) }}</span>
        @else
            <span class="fw-semibold price-product mt-lg-4 mb-lg-3 deleted text-muted {{ isset($br) ? '' : 'ms-1' }}">{{ formatPrice(productBasePrice($product)) }} - {{ formatPrice(productMaxPrice($product)) }}</span>

        @endif
    @endif
@endif

<!-- @if ($product->unit)
    <small>/{{ $product->unit->collectLocalization('name') }}</small>
@endif -->
