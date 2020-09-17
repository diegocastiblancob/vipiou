@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="mt-3">Próximos cobros</h2>
            <table class="table table-striped mt-2 mb-5">
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
                    <tr>
                        <th>{{$credit->name_customer}} {{$credit->name_customer}}</th>
                        <td>{{$credit->sale_target}}</td>
                        <td>{{$credit->no_fee}}</td>
                        <td>{{$credit->price_fee}}</td>
                        <td>{{$credit->statu_fee}}</td>
                        <td>{{$credit->date_expiration_fee}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <h2 class="mt-3">Próximos pagos</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Concepto</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                    @if($expense->status_expense == 'PENDIENTE')
                    <tr>
                        <th>{{$expense->title_expense}}</th>
                        <td>{{$expense->name_type_expense}}</td>
                        <td>{{$expense->price_expense}}</td>
                        <td>{{$expense->status_expense}}</td>
                        <td>{{$expense->date_expense}}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection