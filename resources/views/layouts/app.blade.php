<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>

            @stack('modals')

            @livewireScripts
        </div>
    
        <!-- Scripts -->
            <!-- Mainly scripts -->
            <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('js/popper2.min.js') }}"></script>
        <script src="{{ asset('js/Bootstrap/bootstrap.min.js') }}"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->

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

<!-- 

    "/css/Boostrap/boostrap.min.css": "/css/boostrap.css",
    "/css/plugins/toastr/toastr.min.css": "/css/toastr.css",
    "/css/plugins/gritter/jquery.gritter.css": "/css/jquery.css",
    "/css/animate.css": "/css/animate.css",
    "/css/style.css": "/css/style.css",
    "/css/MyStyles.css": "/css/MyStyle.css",

    "/js/jquery-3.1.1.min.js": "/js/jquery.js",
    "/js/popper2.min.js": "/js/popper.js",
    "/js/Bootstrap/bootstrap.min.js": "/js/bootstrap.js",
    "/js/metisMenu/jquery.metisMenu.js": "/js/metismenu.js",
    "/js/slimscroll/jquery.slimscroll.min.js": "/js/slimscroll.js",
    "/js/inspinia.js": "/js/inspinia.js",
    "/js/pace/pace.min.js": "/js/peace.js",
    "/js/jquery-ui/jquery-ui.min.js": "/js/ui.js",
    "/js/toastr/toastr.min.js": "/js/toastr.js",
    "https://kit.fontawesome.com/6aa6c40f89.js": "/js/fontawesome.js"

 -->