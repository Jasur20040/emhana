<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=5.0, user-scalable=yes" />
    <meta name="description" content="{{ config('app.meta.description') }}">
    <meta name="keywords" content="{{ config('app.meta.keywords') }}">
    <title>{{ config('app.meta.title') }}</title>
    <link href="{{ config('app.meta.canonical') }}" rel="canonical" />
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('css/fontawesome-free/css/all.min.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('css/overlayScrollbars.min.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('css/onlyBootstrapModal.css') }}" rel="stylesheet" />
    {{-- кейңннен қосылған басы --}}
    <link rel="preload" href="{{ asset('css/fontawesome-free/css/all.min.css') }}" as="style" onload="this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="{{ asset('css/fontawesome-free/css/all.min.css') }}"></noscript>
    @if (Request::is('admin*'))
        <link rel="preload" href="{{ asset('css/adminlte.min.css') }}" as="style" onload="this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}"></noscript>
    @endif
    {{-- соңы --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @routes
    <script type="text/javascript" src="{{ asset('js/jquery-36.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/overlayScrollbars.min.js') }}" defer></script>
    @if (Request::is('admin*'))
        <script type="text/javascript" src="{{ asset('js/adminlte.min.js') }}" defer></script>
    @endif
    <script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    @vite('resources/sass/app.scss')
    @routes
    @inertiaHead
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @inertia
    @vite('resources/js/app.js')
</body>

</html>
