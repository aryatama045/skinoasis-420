<div class="row mt-6 justify-content-center">
    <div class="col-md-12">
        <div class="heading">
            <div class="heading subtitle-about">
                @if (url()->current() == url('pages/about-us'))
                    <span class="fw-bolder">
                        <a class="text-dark" href="{{url('pages/about-us')}}">SKINOASIS</a>
                    </span>
                @else
                    <span class="fw-normal">
                        <a class="text-dark" href="{{url('pages/about-us')}}">SKINOASIS</a>
                    </span>
                @endif

                <span class="title-separator">|</span>
                @if (url()->current() == url('pages/pion-tech'))
                    <span class="fw-bolder">
                        <a class="text-dark" href="{{url('pages/pion-tech')}}">PION TECH</a>
                    </span>
                @else
                    <span class="fw-normal">
                        <a class="text-dark" href="{{url('pages/pion-tech')}}">PION TECH</a>
                    </span>
                @endif
                <span class="title-separator">|</span>
                @if (url()->current() == url('pages/vegetology'))
                    <span class="fw-bolder">
                        <a class="text-dark" href="{{url('pages/vegetology')}}">VEGETOLOGY</a>
                    </span>
                @else
                    <span class="fw-normal">
                        <a class="text-dark" href="{{url('pages/vegetology')}}">VEGETOLOGY</a>
                    </span>
                @endif
                <span class="title-separator">|</span>
                @if (url()->current() == url('pages/shinsiaview'))
                    <span class="fw-bolder">
                        <a class="text-dark" href="{{url('pages/shinsiaview')}}">SHINSIAVIEW</a>
                    </span>
                @else
                    <span class="fw-normal">
                        <a class="text-dark" href="{{url('pages/shinsiaview')}}">SHINSIAVIEW</a>
                    </span>
                @endif
                <span class="title-separator">|</span>
                @if (url()->current() == url('pages/leaf-coco'))
                    <span class="fw-bolder">
                        <a class="text-dark" href="{{url('pages/leaf-coco')}}">LEAF & COCO</a>
                    </span>
                @else
                    <span class="fw-normal">
                        <a class="text-dark" href="{{url('pages/leaf-coco')}}">LEAF & COCO</a>
                    </span>
                @endif
                <span class="title-separator">|</span>
                @if (url()->current() == url('pages/bain-co'))
                    <span class="fw-bolder">
                        <a class="text-dark" href="{{url('pages/bain-co')}}">BAIN & CO</a>
                    </span>
                @else
                    <span class="fw-normal">
                        <a class="text-dark" href="{{url('pages/bain-co')}}">BAIN & CO</a>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>