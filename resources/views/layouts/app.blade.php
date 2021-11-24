<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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

        @livewireStyles
    </head>
    <body > <!-- class="font-sans antialiased"> -->

        @livewire('navigation-menu')

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="max-w-7xl bg-white mx-auto py-6 px-4 sm:px-6 lg:px-8 shadow">
                        {{ $header }}
                    </header>
                    

                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>

            @stack('modals')

        </div>
            <!-- Scripts -->
        @livewireScripts

        <script src="{{ mix('js/app.js') }}" defer></script>

        <!-- Mainly scripts -->
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <!-- <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/Bootstrap/bootstrap.min.js') }}"></script> -->
        <script src="{{ asset('js/Bootstrap/bootstrap.bundle.min.js') }}"></script>

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