@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="{{route('egresos')}}" class="btn mb-5 float-left">Egresos</a>
            <button type="button" class="btn mb-5 float-right" data-toggle="modal" data-target="#editarEstadoModal">Editar egreso</button>
            <button type="button" class="btn mb-5 float-right">Exportar a Excel</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Concepto</th>
                        <td>{{$expense->title_expense}}</td>
                        <th scope="col">Fecha</th>
                        <td scope="col">{{$expense->date_expense}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Categoria</th>
                        <td scope="col">{{$expense->name_type_expense}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Descripción</th>
                        <td scope="col">{{$expense->description_expense}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Monto del egreso</th>
                        <td scope="col">{{$expense->price_expense}}</td>
                        <th scope="col">Estado</th>
                        <td scope="col">{{$expense->status_expense}}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal editar estado-->
<div class="modal fade" id="editarEstadoModal" tabindex="-1" role="dialog" aria-labelledby="editarEstadoModallLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarEstadoModalLabel">Editar egreso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('egreso.actualizar', ['id' => $expense->id]) }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Categoria</label>
                            <input id="" type="text" class="form-control" name="" value="{{$expense->name_type_expense}}" required disabled autofocus>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Concepto</label>
                            <input id="titulo_egreso" type="text" class="form-control @error('titulo_egreso') is-invalid @enderror" name="titulo_egreso" value="{{$expense->title_expense}}" required autofocus>
                            @error('titulo_egreso')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Fecha del egreso</label>
                            <input id="fecha_egreso" type="date" class="form-control" name="fecha_egreso" value="{{$expense->date_expense}}" required>
                            @error('fecha_egreso')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Monto del egreso</label>
                            <input id="precio_egreso" type="text" class="form-control @error('precio_egreso') is-invalid @enderror" name="precio_egreso" value="{{$expense->price_expense}}" required autofocus>
                            @error('precio_egreso')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-check col-md-6">
                            <label for="">Estado de egreso</label>
                            <select class="form-control" id="status_expense" name="status_expense" required>
                                <option value="{{$expense->status_expense}}" hidden>{{$expense->status_expense}}</option>
                                <option value="PENDIENTE">PENDIENTE</option>
                                <option value="PAGADO">PAGADO</option>
                            </select>
                            @error('status_expense')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Actualizar Egreso</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection