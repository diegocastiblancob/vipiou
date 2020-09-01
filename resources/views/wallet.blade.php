@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn mb-5 float-right">Exportar a Excel</button>
            <table class="table table-striped mt-5 mb-5">
                <thead class="cabeza-tabla">
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Venta</th>
                        <th scope="col">Concepto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Camiar estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($credits as $credit)
                    <tr>
                        <th>{{$credit->name_customer}} {{$credit->name_customer}}</th>
                        <td>{{$credit->sale_target}}</td>
                        <td>{{$credit->no_fee}}</td>
                        <td>{{$credit->price_fee}}</td>
                        <td>{{$credit->statu_fee}}</td>
                        <td>{{$credit->date_expiration_fee}}</td>
                        <td><a href="{{route('cartera.actualizar', ['id' => $credit->credit_id])}}" class="btn btn-primary float-right">PAGAR</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection