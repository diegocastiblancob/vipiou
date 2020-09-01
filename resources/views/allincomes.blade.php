@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
        <a href="{{route('ingreso')}}" class="btn mb-5 float-left">Crear nuevo ingreso</a>
            <button type="button" class="btn mb-5 float-right">Exportar a Excel</button>
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
                        <th>{{$credit->name_customer}} {{$credit->name_customer}}</th>
                        <td>{{$credit->sale_target}}</td>
                        <td>{{$credit->no_fee}}</td>
                        <td>{{$credit->price_fee}}</td>
                        <td>{{$credit->statu_fee}}</td>
                        <td>{{$credit->date_expiration_fee}}</td>
                        </tr>
                        @endforeach
                        @foreach($incomes as $income)
                            <th>Otro ingreso</th>
                            <td>{{$income->target_income}}</td>
                            <td>PAGO DE CONTADO</td>
                            <td>{{$income->price_income}}</td>
                            <td>PAGO</td>
                            <td>{{$income->date_income}}</td>
                            </tr>
                            @endforeach
                </tbody>
            </table>
            <a href="{{route('ingreso')}}" class="btn mb-5 float-right">Crear nuevo ingreso</a>
        </div>
    </div>
</div>

@endsection