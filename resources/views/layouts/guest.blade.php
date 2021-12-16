{{-- throw new Exception("Error Processing Request", 1); --}}
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
<body class="bg-secondary d-flex align-items-center justify-content-center animated fadeInDown" @if (session('status')) { onload="toastmessage()"  }@endif>
    <div>
        {{ $slot }}
    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>

        <!-- Mainly scripts -->
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/Bootstrap/bootstrap.min.js') }}"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
        <script src="{{ asset('js/toast-message.js') }}"></script>

        <script src="{{ asset('js/metisMenu/jquery.metisMenu.js') }}"></script>
        <script src="{{ asset('js/slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('js/inspinia.js') }}" crossorigin="anonymous"></script>

        <!-- Customs and plugin-->
        <script src="{{ asset('js/pace/pace.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>

        <!-- jQuery UI -->
        <script src="{{ asset('js/toastr/toastr.min.js') }}"></script>

        <!-- toastr (notificaciones) -->
        <script src="{{ asset('https://kit.fontawesome.com/6aa6c40f89.js') }}"></script>
</body>
</html>
