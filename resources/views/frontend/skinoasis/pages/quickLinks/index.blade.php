@extends('frontend.skinoasis.layouts.master')

@section('title')
    {{ localize('Quick Links') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('breadcrumb-contents')
    <ol class="breadcrumb ">
        <li class="breadcrumb-item fw-bold" aria-current="page"><a
                href="{{ route('home') }}">{{ localize('Home') }}</a></li>
        <li class="breadcrumb-item fw-bold" aria-current="page">{{ localize('Quick Links') }}</li>
    </ol>
@endsection

@section('contents')

    <!--pageheader-->
    @include('frontend.skinoasis.inc.pageHeader',
            ['title'=> getSetting('system_title')])
    <!--pageheader-->

    <!--breadcrumb-->
    @include('frontend.skinoasis.inc.breadcrumb')
    <!--breadcrumb-->

    <!--page section start-->
    <section class="blog-details py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-12">
                    <div class="blog-details-content bg-white rounded-2 py-6 px-5">
                        {!! $page->collectLocalization('content') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--page section end-->
@endsection
