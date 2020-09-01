@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="{{route('egreso')}}" class="btn mb-5 float-left">Nuevo egreso</a>
            <button type="button" class="btn mb-5 float-right">Exportar a Excel</button>
            <div class="contenido mt-5">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="realizados-tab" data-toggle="tab" href="#realizados" role="tab" aria-controls="realizados" aria-selected="true">Pagos realizados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="porPagar-tab" data-toggle="tab" href="#porPagar" role="tab" aria-controls="porPagar" aria-selected="false">Cuentas por pagar</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="realizados" role="tabpanel" aria-labelledby="realizados-tab">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Concepto</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expenses as $expense)
                                @if($expense->status_expense == 'PAGADO')
                                <tr>
                                    <th>{{$expense->title_expense}}</th>
                                    <td>{{$expense->name_type_expense}}</td>
                                    <td>{{$expense->price_expense}}</td>
                                    <td>{{$expense->status_expense}}</td>
                                    <td>{{$expense->date_expense}}</td>
                                    <td>
                                    <a href="{{route('egreso.detalle', ['id' => $expense->id])}}" class="btn">Ver</a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="porPagar" role="tabpanel" aria-labelledby="porPagar-tab">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Concepto</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col"></th>
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
                                    <td><a href="{{route('egreso.detalle', ['id' => $expense->id])}}" class="btn">Ver</a></td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-entrar mb-5 float-right">Ver todos los egresos</button>
        </div>
    </div>
</div>

@endsection