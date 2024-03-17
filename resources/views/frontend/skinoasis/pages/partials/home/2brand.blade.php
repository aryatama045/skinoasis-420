<!-- Brands -->
<div class="bg-white deal-container pt-5 pb-3">

    <h2 class="title text-center brands" data-aos="fade-up">
        “Skin Oasis product is a high-tech and newest product from Korea”
    </h2>
    <div class="brands-border owl-carousel owl-simple mb-5" data-aos="fade-up" data-toggle="owl"
        data-owl-options='{
            "nav": false,
            "dots": false,
            "margin": 10,
            "loop": false,
            "responsive": {
                "0": {
                    "items":2
                },
                "420": {
                    "items":3
                },
                "600": {
                    "items":4
                },
                "900": {
                    "items":5
                },
                "1024": {
                    "items":6
                }
            }
        }'>

        @foreach($brands as $brandPrd)
            <a class="brand" href="{{ route('products.index') }}?&brand_id={{ $brandPrd->id }}">
                <img src="{{ uploadedAsset($brandPrd->brand_image) }}" alt="Brand Name">
            </a>
        @endforeach
    </div><!-- End .owl-carousel -->
</div>