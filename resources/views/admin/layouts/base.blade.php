<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ asset('css/themes/admin/base/theme.css') }}">
    @yield('head-assets')

    <title>Admin</title>
</head>

<body>
    <div class="page-breadcrumbs">
        @yield('breadcrumbs')
    </div>
    <div class="page-content">
        @yield('content')
    </div>
    <script src="{{ asset('lib/jquery/jquery-3.6.1.min.js') }}"></script>
    @yield('body-assets')
    <script src="{{ asset('js/themes/admin/base/main.js') }}"></script>
</body>

</html>