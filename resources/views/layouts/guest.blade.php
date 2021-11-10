<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="stylesheet" href="{{ asset('css/Bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/MyStyles.css') }}">

</head>
<body class="bg-secondary d-flex align-items-center justify-content-center animated fadeInDown">
    <div>
        {{ $slot }}
    </div>

    <!--  -->    <!-- Scripts externos -->    <!--  -->
    <script src="{{ asset('js/Bootstrap/bootstrap.min.js') }}"></script>
</body>
</html>
