@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="{{url('/download/ingresos')}}" class="btn float-right">Exportar a excel</a>
            <table class="table table-striped mt-5 mb-2">
                <thead class="cabeza-tabla">
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Venta</th>
                        <th scope="col">Concepto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($credits as $credit)
                    @if($loop->index < 4 and $credit->statu_fee == 'PAGO') <tr>
                            <th>{{$credit->name_customer}} {{$credit->name_customer}}</th>
                            <td>{{$credit->sale_target}}</td>
                            <td>{{$credit->no_fee}}</td>
                            <td>{{$credit->price_fee}}</td>
                            <td>{{$credit->statu_fee}}</td>
                            <td>{{$credit->date_expiration_fee}}</td>
                        </tr>
                        @endif
                        @endforeach
                        @foreach($incomes as $income)
                        @if($loop->index < 2) <tr>
                            <th>Otro ingreso</th>
                            <td>{{$income->target_income}}</td>
                            <td>PAGO DE CONTADO</td>
                            <td>{{$income->price_income}}</td>
                            <td>PAGO</td>
                            <td>{{$income->date_income}}</td>
                            </tr>
                            @endif
                            @endforeach
                </tbody>
            </table>
            <a href="{{route('ingresos')}}" class="btn mb-5 float-right">Ver todos los ingresos</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 mt-3 mb-5 cajas">
            @if (session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
            <form method="POST" action="{{ route('ingreso.crear') }}">
                @csrf
                <h2 class="text-light">Registrar nuevo ingreso</h2>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="" class="text-light">Concepto del ingreso</label>
                        <input id="titulo_ingreso" type="text" class="form-control @error('titulo_ingreso') is-invalid @enderror" name="titulo_ingreso" placeholder="Concepto del ingreso" required autocomplete="titulo_ingreso" autofocus>
                        @error('titulo_ingreso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="text-light">Fecha</label>
                        <input id="fecha_ingreso" type="date" class="form-control @error('fecha_ingreso') is-invalid @enderror" name="fecha_ingreso" required autocomplete="fecha_ingreso" autofocus>
                        @error('fecha_ingreso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" class="text-light">Descripción</label>
                        <textarea id="descripcion_ingreso" rows="4" class="form-control @error('descripcion_ingreso') is-invalid @enderror" name="descripcion_ingreso" required></textarea>
                        @error('descripcion_ingreso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" class="text-light">Precio</label>
                        <input id="precio_ingreso" type="text" class="form-control @error('precio_ingreso') is-invalid @enderror" name="precio_ingreso" placeholder="Monto del ingreso" required autocomplete="precio_ingreso" autofocus>
                        @error('precio_ingreso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Agregar Pago</button>
            </form>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>

@endsection