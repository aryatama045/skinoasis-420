@extends('frontend.skinoasis.layouts.master')

@section('title')
    {{ localize('Home') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')
    <!--hero section start-->
    @include('frontend.skinoasis.pages.halloBeauty.inc.1hero')
    <!--hero section end-->

    <!--info section start-->
    @include('frontend.skinoasis.pages.halloBeauty.inc.2info')
    <!--info section end-->

    <!--listdokter section start-->
    @include('frontend.skinoasis.pages.halloBeauty.inc.listDokter')
    <!--listdokter section end-->


@endsection

@section('scripts')
    <script>
        "use strict";

        // runs when the document is ready
        $(document).ready(function() {
            @if (\App\Models\Location::where('is_published', 1)->count() > 1)
                notifyMe('info', '{{ localize('Select your location if not selected') }}');
            @endif

        });
    </script>
@endsection