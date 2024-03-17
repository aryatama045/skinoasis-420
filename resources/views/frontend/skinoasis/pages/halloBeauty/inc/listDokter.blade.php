<div class="hallo-beauty rounded bg-white pt-5 pb-5 " data-aos="fade-up">
    <div class="row">
        <div class="col-12">

            <div class="row">
                <div class="col-12 col-lg-7 mb-5">
                    <div class="heading text-left">
                        <h3 class="text-uppercase ls-2px fw-normal ff">Cari Dokter</h3>

                        <!-- Search Key -->
                        <form class="search-form d-flex align-items-center mt-4" action="{{ route('halloBeauty.listdokter') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control search-key" placeholder="KETIK NAMA DOKTER"
                                    @isset($searchKey)
                                    value="{{ $searchKey }}"
                                    @endisset>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="row">

                @foreach ($dokter as $dokters) 
                    <?php $nmd = str_replace(' ', '-', $dokters->name); ?>
                <div class="col-lg-4 col-sm-6 p-5">
                    <div class="dokter-content rounded">
                        <div class="posts-list">
                            <figure>
                                <a href="{{ route('halloBeauty.dokter', $nmd ) }}">
                                    <img class="rounded-circle" src="{{ staticAsset('frontend/skinoasis/assets/images/dokter.png') }}" alt="post">
                                </a>
                            </figure>

                            <div>
                                <h3 class="font-weight-bold ff">{{ $dokters->name }}</h3>
                                <span class="text-black">Dokter Kulit - Dokter Estetika</span>
                            </div>
                        </div>
                        <div class="separator mt-2 mb-2"></div>

                        <div class="text-left mt-4 mb-4">
                            <h3 class="font-weight-bold ff">KLINIK BEAUTY CENTRE</h3>
                            <span>Tersedia : <span class="text-black">Tersedia hari ini</span></span>

                            <h2 class="mt-8 font-weight-bolder ff">Rp. 250.000</h2>
                        </div>

                        <div class="card-content text-center">
                            <a href="" class="btn btn-outline-yellow btn-rounded btn-sm ls-1px text-uppercase mt-4 w-75">
                                {{ localize('Konsultasi Online') }}</a> <br>
                            <a href="{{ route('halloBeauty.dokter', $nmd) }}" class="btn btn-outline-yellow btn-rounded btn-sm ls-1px text-uppercase mt-4 w-75">
                                {{ localize('Pesan Janji Temu') }}</a>
                        </div>

                    </div>
                </div>
                @endforeach

                <div class="mt-5">
                    {{ $dokter->appends(request()->input())->links() }}
                </div>
            </div>

            @include('frontend.skinoasis.pages.halloBeauty.inc.navbarBottom')


        </div>
    </div>
</div>