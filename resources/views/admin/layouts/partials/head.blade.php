<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Informasi Manajemen Dukungan Pendidikan 'AnakNegeri'">
    <meta name="author" content="Pandhu Weni">
    <meta name="keyword" content="Dukungan untuk pendidikan Indonesia">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin | @yield('title')</title>

    <link href="{{ asset('core/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('core/css/simple-line-icons.css') }}" rel="stylesheet">
    @include('components.favicons')
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    @yield('plugincss')
</head>