<div class="gshop-sidebar bg-white rounded-2 overflow-hidden">
    <!--Filter by search-->
    <div class="sidebar-widget search-widget bg-white py-5 px-4">
        <div class="widget-title d-flex">
            <h4 class="mb-0 flex-shrink-0">{{ localize('Search Now') }}</h4>
        </div>
        <div class="search-form d-flex align-items-center mt-4">
            <input type="hidden" name="view" value="{{ request()->view }}">
            <input type="text" id="search" name="search"
                @isset($searchKey)
       value="{{ $searchKey }}"
       @endisset
                placeholder="{{ localize('Search') }}">
            <button type="submit" class="submit-icon-btn-secondary"><i
                    class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>
    <!--Filter by search-->
    <!--Filter by Categories-->
    <div class="sidebar-widget category-widget bg-white py-5 px-4 border-top mobile-menu-wrapper scrollbar h-200px">
        <div class="widget-title d-flex">
            <h4 class="mb-0 flex-shrink-0 text-uppercase ls-1px">{{ localize('Categories') }}</h4>
        </div>
        <ul class="widget-nav mt-4">

            @php
                $product_listing_categories = getSetting('product_listing_categories') != null ? json_decode(getSetting('product_listing_categories')) : [];
                $categories = \App\Models\Category::whereIn('id', $product_listing_categories)->get();
            @endphp
            @foreach ($categories as $category)
                @php
                    $productsCount = \App\Models\ProductCategory::where('category_id', $category->id)->count();
                @endphp
                <li>
                    <a href="{{ route('products.allproduct') }}?&category_id={{ $category->id }}"
                        class="d-flex justify-content-between align-items-center text-capitalize">
                        {{ $category->collectLocalization('name') }}
                        <h5 class="fw-bold total-count">
                            {{ $productsCount }}
                        </h5>
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
    <!--Filter by Categories-->

    <!--Filter by Brand-->
    <div class="sidebar-widget category-widget bg-white py-5 px-4 border-top mobile-menu-wrapper scrollbar h-200px">
        <div class="widget-title d-flex">
            <h4 class="mb-0 flex-shrink-0 text-uppercase ls-1px">Brand</h4>
        </div>
        <ul class="widget-nav mt-4">

            @php
                $brands = \App\Models\Brand::get();
            @endphp
            @foreach ($brands as $merk)
                <li>
                    <a href="{{ route('products.allproduct') }}?&brand_id={{ $merk->id }}"
                        class="d-flex justify-content-between align-items-center text-capitalize">{{ $merk->collectLocalization('name') }}
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
    <!--Filter by Brand-->

    <!--Filter by Tags-->
    <div class="sidebar-widget tags-widget py-5 px-4 bg-white">
        <div class="widget-title d-flex">
            <h4 class="mb-0">{{ localize('Tags') }}</h4>
        </div>
        <div class="tt-category-tag mt-4 mt-4 d-flex gap-2 flex-wrap">
            @foreach ($tags as $tag)
                <a href="{{ route('products.index') }}?&tag_id={{ $tag->id }}" style="color: black;">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
    <!--Filter by Tags-->
</div>
