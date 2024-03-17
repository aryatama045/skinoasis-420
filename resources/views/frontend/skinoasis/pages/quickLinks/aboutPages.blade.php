@extends('frontend.skinoasis.layouts.master')

@section('title')
    {{ localize('About Us') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection



@section('contents')

    <!--hero section start-->
    @include('frontend.skinoasis.pages.partials.home.1hero',[
                'sliders' => $sliders,
            ])
    <!--hero section end-->

    <div class="container bg-white mb-10">
        <div class="row">
            <div class="col-lg-12">
                <div class="about-text-header entry-content">
                    {!! $page->collectLocalization('content') !!}
                </div>
            </div>
        </div>

        @include('frontend.skinoasis.pages.quickLinks.bottomAbout')

    </div>

    <div class="mb-2"></div>




@endsection
