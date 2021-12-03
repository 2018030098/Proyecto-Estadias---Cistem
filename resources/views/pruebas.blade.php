<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Bootstrap5 -->
        <link rel="stylesheet" href="{{ asset('css/Bootstrap/bootstrap.min.css') }}">
        
        <!-- Toastr style -->
        <link rel="stylesheet" href="{{ asset('css/plugins/toastr/toastr.min.css') }}">

        <!-- Gritter -->
        <link rel="stylesheet" href="{{ asset('css/plugins/gritter/jquery.gritter.css') }}">

        <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/MyStyles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/plugins/iCheck/custom.css') }}">
</head>
<body class="gray-bg p-5">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Pruebas') }} </h2>
    <hr>
    <form action="{{ route('prueba.shows') }}" method="get">
        <button type="submit" class="form-check">
            <input class="form-check-input abc-radio-primary" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
            <label class="form-check-label" for="exampleRadios1">
                Default radio
            </label>
        </button>
        <button type="submit" class="form-check">
            <input class="form-check-input abc-radio-primary" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
            <label class="form-check-label" for="exampleRadios2">
                Second default radio
            </label>
        </button>
    </form>
<hr>
    <script src="{{ mix('js/app.js') }}" defer></script>

        <!-- Mainly scripts -->
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/Bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/Bootstrap/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('js/metisMenu/jquery.metisMenu.js') }}"></script>
        <script src="{{ asset('js/slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('js/inspinia.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/toast-message.js') }}"></script>

        <!-- Customs and plugin-->
        <script src="{{ asset('js/pace/pace.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui/jquery-ui.min.js') }}"></script>

        <!-- jQuery UI -->
        <script src="{{ asset('js/toastr/toastr.min.js') }}"></script>

        <!-- toastr (notificaciones) -->
        <script src="{{ asset('https://kit.fontawesome.com/6aa6c40f89.js') }}"></script>

        <!-- iCheck (Check buttons) -->
        <script src="{{ asset('js/iCheck/icheck.min.js') }}"></script>
</body>
</html>

