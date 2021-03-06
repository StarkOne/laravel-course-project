<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>
    @yield('content')

    <!-- Custom scripts for this template -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>