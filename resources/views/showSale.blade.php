@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn float-right mb-3" style="font-size: 11pt;" data-toggle="modal" data-target="#ModalEditarContrato">Editar Información</button>
            <button type="button" class="btn float-right mb-3" style="font-size: 11pt;">
                Ver archivo contrato</button>
            <table class="table table-striped mb-5">
                <thead>
                    <tr>
                        <th scope="col">Cliente</th>
                        <td>{{$sale->customer->name_customer}} {{$sale->customer->lastname_customer}}</td>
                        <th scope="col">Fecha</th>
                        <td scope="col">{{$sale->sale_date}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Objeto</th>
                        <td scope="col">{{$sale->sale_target}}</td>
                        <th scope="col">Precio</th>
                        <td scope="col">{{$sale->sale_price}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Descripcion</th>
                        <td scope="col">{{$sale->sale_description}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Financiación</th>
                        <td scope="col">{{$sale->sale_credit}}</td>
                        <th scope="col">Numero Cuotas</th>
                        <td scope="col">{{$sale->no_fees}}</td>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th scope="col">Concepto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale->credit as $credit)
                    <tr>
                        <td>{{$credit->no_fee}}</td>
                        <td>{{$credit->price_fee}}</td>
                        <td>{{$credit->statu_fee}}</td>
                        <td>{{$credit->date_expiration_fee}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal EDitar Contrato -->
<div class="modal fade" id="ModalEditarContrato" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Editar información de venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('venta.actualizar', ['id' => $sale->id]) }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Nombre del cliente</label>
                            <input id="id_customer" type="text" class="form-control" name="id_customer" value="{{$sale->customer->name_customer}} {{$sale->customer->lastname_customer}}" required disabled autofocus>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="titulo_venta" type="text" class="form-control @error('titulo_venta') is-invalid @enderror" name="titulo_venta" value="{{$sale->sale_target}}" required autofocus>
                            @error('titulo_venta')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input id="fecha_venta" type="date" class="form-control @error('fecha_venta') is-invalid @enderror" name="fecha_venta" value="{{$sale->sale_date}}" required autofocus>
                            @error('fecha_venta')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea id="descripcion_venta" rows="4" class="form-control @error('descripcion_venta') is-invalid @enderror" name="descripcion_venta" required>{{$sale->sale_description}}</textarea>
                            @error('descripcion_venta')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input id="precio_venta" type="text" class="form-control @error('precio_venta') is-invalid @enderror" name="precio_venta" value="{{$sale->sale_price}}" required autofocus>
                            @error('precio_venta')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <!-- @if($sale->sale_credit == 'SI')
                    <div id="financiar">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input id="initial_fee" type="text" class="form-control @error('initial_fee') is-invalid @enderror" name="initial_fee" placeholder="Cuota inicial" autocomplete="initial_fee" autofocus>
                            </div>
                            <div class="form-group col-md-6">
                                <input id="no_fees" type="text" class="form-control @error('no_fees') is-invalid @enderror" name="no_fees" placeholder="No. de cuotas" autocomplete="no_fees" autofocus>
                            </div>
                        </div>
                    </div>
                    @endif -->


                    <button type="submit" class="btn btn-primary float-right">Crear
                        venta</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection