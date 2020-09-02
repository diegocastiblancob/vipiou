<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Vipiou</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" >
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @guest
                @if (Route::has('register'))
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('/loadimage/LOGO-VIPIOU.png') }}" width="180" alt="">
                </a>
                @endif
                @else
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ url('/loadimage/LOGO-VIPIOU.png') }}" width="180" alt="">
                </a>
                @endguest
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @guest
                    @if (Route::has('register'))
                    @endif
                    @else
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Clientes <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('cliente') }}">
                                    {{ __('Clientes') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('propuesta') }}">
                                    {{ __('Propuestas') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('tarea') }}">
                                    {{ __('Tareas') }}
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Contabilidad <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('venta') }}">
                                    {{ __('Ventas') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('egreso') }}">
                                    {{ __('Egresos') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('ingreso') }}">
                                    {{ __('Ingresos') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('cartera') }}">
                                    {{ __('Cartera') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                    @endguest

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/#tutoriales') }}">Tutoriales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/#premiun') }}">Premiun</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('cuenta') }}">
                                    {{ __('Mi cuenta') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="page-footer font-small mb-1" style="background-color: #CEEDEC;">
            <div class="container">
                <!-- Copyright -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 mt-2">
                        <div class="footer-copyright text-left py-3">Para evaluar tu experiencia contáctanos en
                            <a href="https://mail.google.com/mail/u/0/" target="_blank">soporte@primernombre.com</a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        <div class="row">
                            <div class="col-12 float-right">
                                <a class="float-right">Derechos reservados a:</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 float-right">
                                <a class="float-left">Políticas</a>
                                <img src="{{url('loadimage/Logo_primernombre.png')}}" width="182" height="47" class="float-right" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Copyright -->
            </div>
        </footer>
        <!-- Footer -->
    </div>
</body>

</html>