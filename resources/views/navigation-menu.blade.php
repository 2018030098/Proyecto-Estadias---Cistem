<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu bg_backimg" id="side-menu">
                <li class="nav-header w-100">
                    <div class="profile-element">
                        <a href="{{ route('dashboard') }}" class="text-decoration-none" href="home.php"> 
                            <div class="p-1 bg-light rounded">
                                <img src="{{ asset('img/logo.png')}}" alt="Imagen del logo" class="w-100">
                            </div>
                        </a>
                        <div class="sidebar-collapse">
                            <ul class="nav metismenu bg-transparent">
                                <li class="bg-transparent">
                                    <a class="text-decoration-none" href="#"> <!-- block m-t-xs font-bold text-center -->
                                        <span class="nav-label">
                                            Adrian
                                        </span>
                                        <b class="fa arrow"></b>
                                    </a>
                                    <ul class="nav nav-second-level collapse bg-transparent"> <!-- animated fadeInRight m-t-xs -->
                                        <li class="bg-transparent"><a class="text-decoration-none" href="{{ route('dashboard') }}"> <b class="fas fa-chalkboard"></b> <span> Inicio </span> </a></li>
                                        <li class="bg-transparent"><a class="text-decoration-none" href="{{ route('profile.show') }}"> <b class="fas fa-address-card"></b> <span>{{ __('Mi Perfil') }}</span> </a></li>
                                        
                                        <form action="{{ route('logout') }}" method="post">
                                            <hr>
                                            @csrf

                                            <li class="bg-transparent">
                                                <a href="{{ route('logout') }}" class="text-decoration-none" onclick="event.preventDefault(); this.closest('form').submit();"> 
                                                    <b class="fa fa-sign-out"></b> 
                                                    <span>{{ __('Cerrar Sesion') }}</span> 
                                                </a>
                                            </li>
                                        </form>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="logo-element">
                        <a class="text-decoration-none" href="{{ route('dashboard') }}">IN+</a>
                    </div>
                </li>
                <li class="{{ Request::is('social','social/*') ? 'active' : '' }}">
                    <a href="{{ route('social.index',['order'=>'0']) }}" class="text-decoration-none"> 
                        <i class="fab fa-trello"></i> 
                        <span class="nav-label">Social</span> 
                    </a>
                </li>
                <li class=''>
                    <a href="##" class="text-decoration-none ">
                        <i class="fas fa-chart-area"></i>
                        <span> Pagina 2</span>
                    </a>
                </li>
                <li class=''>
                    <a href="###" class="text-decoration-none ">
                        <i class="fas fa-columns"></i>
                        <span> Pagina 3</span>
                    </a>
                </li>
                <li class=''>
                    <a href="####" class="text-decoration-none ">
                        <i class="fas fa-bell"></i>
                        <span> Pagina 4</span>
                    </a>
                </li>
                <li class="{{ Request::is('prueba','prueba/*') ? 'active' : '' }}">
                    <a href="{{ route('prueba') }}" class="text-decoration-none"> 
                        <i class="fas fa-cogs"></i> 
                        <span class="nav-label"># Pruebas1 #</span> 
                    </a>
                </li>
                <li class="">
                    <a href="######" class="text-decoration-none ">
                        <i class="fas fa-cogs"></i>
                        <span> # Pruebas2 #</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary me-4" href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li style="padding: 20px">
                        <span class="m-r-sm text-muted welcome-message">Bienvenido</span>
                    </li>
                    <form action="{{ route('logout') }}" method="post" class="mt-3">
                        @csrf
                        <li>
                            <a href="{{ route('logout') }}" class="text-decoration-none m-r-sm " onclick="event.preventDefault(); this.closest('form').submit();"> 
                                <i class="fa fa-sign-out text-black-50 text-muted"></i> <span class="text-black text-muted">{{ __('Cerrar Sesion') }}</span>
                            </a>
                        </li>
                    </form>
                </ul>
            </nav>  
        </div>