<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Skote::printAttrs('html') }} {{ Skote::printClasses('html') }}>
<head>
    <meta charset="utf-8"/>

    {{-- Title Section --}}
    <title>{{ config('app.name') }} | @yield('title', $page_title ?? 'Backend')</title>

    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ @csrf_token() }}">
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset( config('layout.resources.favicon') ) }}"/>

    {{-- Fonts --}}
    {{ Skote::getGoogleFontsInclude() }}

    {{-- Includable CSS --}}
    @yield('styles')

<!-- Global Theme Styles (used by all pages)  -->
    @foreach(config('layout.resources.css') as $style)
        <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
@endforeach

<!-- Toastr Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}">
</head>

<body data-sidebar="dark" data-layout-mode="light">

@if (config('layout.pages-loader.type') != '')
    @include('layout.partials._page-loader')
@endif

@include('layout.base._layout')

{{-- Global Theme JS Bundle (used by all pages)  --}}
@foreach(config('layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
@endforeach

{{-- Includable JS --}}
@yield('scripts')


<!-- toastr plugin -->
<script src="{{ asset('assets/libs/toastr/build/toastr.min.js') }}"></script>
<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    @if(!empty($errors->toArray()))
    toastr.error("{{ $errors->first() }}")
    @endif

    @if(session()->has('message'))
    toastr.success("{{ session()->get('message') }}")
    @endif
</script>
</body>
</html>

