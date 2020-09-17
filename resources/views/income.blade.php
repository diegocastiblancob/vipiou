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
                        <input id="target_income" type="text" class="form-control @error('target_income') is-invalid @enderror" name="target_income" placeholder="Concepto del ingreso" required autocomplete="target_income" autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="text-light">Fecha</label>
                        <input id="date_income" type="date" class="form-control @error('date_income') is-invalid @enderror" name="date_income" required autocomplete="date_income" autofocus>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" class="text-light">Descripción</label>
                        <textarea id="description_income" rows="4" class="form-control @error('description_income') is-invalid @enderror" name="description_income" required></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" class="text-light">Precio</label>
                        <input id="price_income" type="text" class="form-control @error('price_income') is-invalid @enderror" name="price_income" placeholder="Monto del ingreso" required autocomplete="price_income" autofocus>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Agregar Pago</button>
            </form>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>

@endsection