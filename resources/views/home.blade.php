@extends('layouts.app')

@section('content')
<div class="container-fluid containerHome">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="image_logo p-5">
                <img src="{{ route('loadimage', ['filename'=>Auth::user()->logo_company]) }}" class="w-100" alt="">
                <p class="text-center text-light">
                    Bienvenido {{ Auth::user()->name }} <span class="caret"></span>
                </p>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center mt-4">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <div class="col-lg-3">
            <div class="card card-menu">
                <div class="card-body">
                    <a href="{{route('cliente')}}">
                        <div class="img-menu text-center">
                            <img src="{{ url('/loadimage/Clientes.png') }}" width="120" alt="">
                        </div>
                        <h5 class="card-title text-center text-light mt-3">Clientes</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
            <div class="card card-menu">
                <div class="card-body">
                    <a href="{{route('ventas')}}">
                        <div class="img-menu text-center">
                            <img src="{{ url('/loadimage/ventas.png') }}" width="100" alt="">
                        </div>
                        <h5 class="card-title text-center text-light mt-1">Ventas</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
            <div class="card card-menu">
                <div class="card-body">
                    <a href="{{route('egresos')}}">
                        <div class="img-menu text-center">
                            <img src="{{ url('/loadimage/Egresos.png') }}" width="100" alt="">
                        </div>
                        <h5 class="card-title text-center text-light mt-3">Egresos</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-lg-3">
            <div class="card card-menu">
                <div class="card-body">
                    <a href="{{route('cliente-a-clientes')}}">

                        <div class="img-menu text-center">
                            <img src="{{ url('/loadimage/seguimiento-a-clientes.png') }}" width="80" alt="">
                        </div>
                        <h5 class="card-title text-center text-light mt-3">Seguimiento a clientes</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
            <div class="card card-menu">
                <div class="card-body">
                    <a href="{{route('cobros-y-pagos')}}">

                        <div class="img-menu text-center mt-3">
                            <img src="{{ url('/loadimage/cobros-y-pagos.png') }}" width="120" alt="">
                        </div>
                        <h5 class="card-title text-center text-light mt-3">Cobros y pagos</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
            <div class="card card-menu">
                <div class="card-body">
                    <a href="{{route('reporte')}}">
                        <div class="img-menu text-center">
                            <img src="{{ url('/loadimage/reportes.png') }}" width="100"" alt="">
                    </div>
                    <h5 class=" card-title text-center text-light mt-3">Reportes</h5>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>
@endsection