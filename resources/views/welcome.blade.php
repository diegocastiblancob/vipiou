<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VIPIOU</title>

</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ url('/') }}">
                <img src="{{ url('/loadimage/LOGO-VIPIOU.png') }}" width="180" alt="">
            </a>
            <a href="{{ route('login') }}">Premiun</a>
            <a href="{{ route('login') }}">Tutoriales</a>
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                Laravel
            </div>

            <div class="links">
                <a href="https://laravel.com/docs">Docs</a>
                <a href="https://laracasts.com">Laracasts</a>
                <a href="https://laravel-news.com">News</a>
                <a href="https://blog.laravel.com">Blog</a>
                <a href="https://nova.laravel.com">Nova</a>
                <a href="https://forge.laravel.com">Forge</a>
                <a href="https://vapor.laravel.com">Vapor</a>
                <a href="https://github.com/laravel/laravel">GitHub</a>
            </div>
        </div>
    </div>
</body>

</html> -->
@extends('layouts.app')

@section('content')
<style>
    .caja {
        background: linear-gradient(180deg, #5BC4BF 0%, #2CACA6 100%);
        margin-top: 60px;
        margin-bottom: 50px;
        padding: 8%;
        color: #fff;
    }

    .btns {
        background-color: #C46EB5;
        color: #fff;
        font-size: 26pt;
        padding-left: 10%;
        padding-right: 10%;
        border-radius: 20px;
    }

    .btns:hover {
        background-color: #c146a1;
    }

    .image {
        position: absolute;
        margin-top: -50px;
    }

    p {
        font-size: 14pt;
    }

    .tutoriales {
        background: linear-gradient(89.7deg, #9DDCDA 0.11%, #CEEDEC 99.89%);
    }

    .active {
        background-color: #5BC4BF;
        border-color: #5BC4BF;
    }

    h2 {
        font-size: 30pt;
        color: #C46EB5;
    }

    .caja {
        background: linear-gradient(180deg, #5BC4BF 0%, #2CACA6 100%);
        margin-bottom: 50px;
        padding: 3% 5% 2% 5%;
        border-radius: 20px;
    }

    .titulo {
        margin-bottom: 25px;
        color: #000;
        margin-top: 20px;
    }

    .precio {
        font-size: 30pt;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h1 class="text-center titulo">Organiza y gestiona tu <br> empresa</h1>
            <p class="text-center mt-3">Lleva registros de ingresos, egresos y clientes.</p>
            <div class="caja text-center">
                <p class="mt-4 ml-5 mr-5 mb-5">Te obsequiamos 15 días de prueba para que disfrutes de nuestra plataforma, te convenzas y con un precio asequible puedas llevar control de tu empresa de una manera fácil.</p>
                <a class="btn btns mb-5" href="{{url('login')}}">Prueba gratis</a>
            </div>
        </div>
        <div class="col-lg-6 mb-5">
            <img src="{{ url('/loadimage/main.png') }}" class="image w-100" alt="">
        </div>
    </div>
</div>
<section id="tutoriales">
    <div class="container-fluid tutoriales">
        <div class="container">
            <div class="row">
                <div class="col-lg-1 mt-5 mb-5"></div>
                <div class="col-lg-4 mt-5 mb-5">
                    <ul class="list-group">
                        <li class="list-group-item mb-2 active">Introducción</li>
                        <li class="list-group-item mb-2">Seguimiento a clientes</li>
                        <li class="list-group-item mb-2">Estados de los proyectos</li>
                        <li class="list-group-item mb-2">Contratos</li>
                        <li class="list-group-item mb-2">Ingresos</li>
                        <li class="list-group-item mb-2">Egresos</li>
                        <li class="list-group-item mb-2">Consultas</li>
                    </ul>
                </div>
                <div class="col-lg-7 mt-5 mb-5">
                    <h3 class="text-center">Introducción</h3>
                    <p class="text-center">Conoce cómo funciona Vipiou y qué te ofrecemos </p>
                    <iframe class="w-100" height="335" src="https://www.youtube.com/embed/0JbbOtatLzk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="premiun" class="mt-5 mb-5">
    <div class="container">
        <h2 class="text-center">Premium</h2>
        <div class="row">
            <div class="col-lg-5 mt-5 mb-5">
                <h3 class="text-center">Te ofrecemos:</h3>
                <p class="text-left mt-5">* Consulta el estado financiero de tu empresa.</p>
                <p class="text-left">* Lleva el registro de ingresos, egresos y cuentas por pagar de tu compañía.</p>
                <p class="text-left">* Haz seguimiento de tus clientes y prospectos para que gestiones fácil y
                    eficientemente propuestas y contratos.</p>
            </div>
            <div class="col-lg-1 mt-5 mb-5"></div>
            <div class="col-lg-6 mt-4 mb-5">
                <div class="caja text-center">
                    <h5 class="">VALOR ANUAL DE INTRODUCCIÓN:</h5>
                    <p class="precio">$ 28.000 COP/mes</p>

                    <button class="btn btns mt-5 mb-2" data-toggle="modal" data-target="#Modal">Empezar</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Premium</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Si ya tienes una cuenta con VipioU puedes hacerte premium iniciando sesión!</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" href="{{url('login')}}">Iniciar
                    Sesion</a>
                <a class="btn btn-secondary" href="{{url('register')}}">No,
                    Registrarme</a>
            </div>
        </div>
    </div>
</div>
@endsection