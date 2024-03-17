@extends('frontend.skinoasis.layouts.master')

@section('title')
    {{ localize('Campaign Products') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <!--campaign section start-->
        <div class="container">
            <div class="row justify-content-center g-4 mt-5">
                @php
                    $campaignProductIds = \App\Models\CampaignProduct::where('campaign_id', $campaign->id)->pluck('product_id');
                    $campaign_products = \App\Models\Product::whereIn('id', $campaignProductIds)
                        ->latest()
                        ->get();
                @endphp

                @foreach ($campaign_products as $product)
                    <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-10">
                        @include('frontend.skinoasis.pages.partials.products.trending-product-card', [
                            'product' => $product,
                            'bgClass' => 'bg-white',
                            'showSold' => true,
                        ])
                    </div>
                @endforeach
            </div>
    </section>
    <!--campaign section end-->
@endsection
