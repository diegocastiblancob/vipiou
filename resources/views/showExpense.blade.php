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
                        <th scope="col">Descripcion</th>
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
                            <input id="title_expense" type="text" class="form-control @error('title_expense') is-invalid @enderror" name="title_expense" value="{{$expense->title_expense}}" required autocomplete="title_expense" autofocus>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="">Fecha del egreso</label>
                            <input id="date_expense" type="date" class="form-control" name="date_expense" value="{{$expense->date_expense}}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="">Monto del egreso</label>
                            <input id="price_expense" type="text" class="form-control @error('price_expense') is-invalid @enderror" name="price_expense" value="{{$expense->price_expense}}" required autocomplete="price_expense" autofocus>
                        </div>
                        <div class="form-check col-md-6">
                        <label for="">Estado de egreso</label>
                            <select class="form-control" id="status_expense" name="status_expense" required>
                                <option value="{{$expense->status_expense}}" hidden>{{$expense->status_expense}}</option>
                                <option value="PENDIENTE">PENDIENTE</option>
                                <option value="PAGADO">PAGADO</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Actualizar Egreso</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection