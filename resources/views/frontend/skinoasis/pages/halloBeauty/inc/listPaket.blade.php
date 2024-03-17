<div class="hallo-beauty rounded bg-white pt-5 pb-5 " data-aos="fade-up">
    <div class="row">
        <div class="col-12">

            <div class="row">

                @foreach ($products as $prd)
                <div class="col-lg-4 col-sm-6 p-5">
                    <div class="paket-content rounded">
                        <div class="col-4 mt-4" style="background-color: #108289; color: white; padding: 5px; border-radius: 10px;">
                            <center>Populer</center>
                        </div>
                        <div class="posts-list">
                            <div>
                                <h3 class="font-weight-bold ff">{{ $prd->namaproduk }}</h3>
                                <span class="text-black">{{ $prd->name }}</span>
                            </div>
                            <hr style="height: 1px; background-color: #000">
                            <h2 class="font-weight-bolder">{{ formatPrice(productBasePrice($prd)) }}</h2>
                        </div>
                        <div class="row" style="margin-left: 5px; margin-right: 5px">
                            <button type="button" style="border: 1px solid #ccc; color: black;" class="col-4 btn btn-rounded btn-sm btn-product btn-wishlist" title="Wishlist" onclick="addToWishlist({{ $prd->id }})">Wishlist</button>&nbsp;
                            <button type="button" style="border: 1px solid #4C6346; color: black;" class="btn btn-rounded btn-sm btn-product">Lihat Detail</button>
                            <button type="button" class="col-12 btn btn-rounded btn-sm btn-outline-green-dark btn-product mt-3" onclick="">+ Keranjang</button>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="mt-5">
                    {{ $products->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>