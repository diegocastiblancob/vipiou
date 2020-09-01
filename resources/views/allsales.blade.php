@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <a class="btn float-left mb-3" href="{{route('venta')}}">Nueva venta</a>
            <button type="button" class="btn mb-5 float-right">Exportar a Excel</button>
            <table class="table table-striped mt-5 mb-5">
                <thead class="cabeza-tabla">
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Objeto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Financiación</th>
                        <th scope="col">Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                    <tr>
                        <td>{{$sale->name_customer}} {{$sale->lastname_customer}}</td>
                        <td>{{$sale->sale_target}}</td>
                        <td>{{$sale->sale_price}}</td>
                        <td>{{$sale->sale_credit}}</td>
                        <td>{{$sale->sale_date}}</td>
                        <td>
                            <a href="venta/{{$sale->sale_id}}">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection