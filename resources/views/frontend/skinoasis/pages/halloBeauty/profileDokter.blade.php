@extends('frontend.skinoasis.layouts.master')

@section('title')
    {{ localize('Home') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('contents')

    <!--listdokter section start-->
    @include('frontend.skinoasis.pages.halloBeauty.inc.dokter')
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


            // Date Picker benar
            $('#dtJadwal').datetimepicker({
                format: 'YYYY-MM-DD',
            });
        });
    </script>
@endsection
