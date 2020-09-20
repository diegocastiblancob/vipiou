@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <a href="{{url('/download/egresos')}}" class="btn float-right">Exportar a excel</a>
            <table class="table table-striped mt-5">
                <thead class="cabeza-tabla">
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
                    @if($loop->index < 4) <tr>
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
            <a href="{{route('egresos')}}" class="btn btn-entrar mb-5 float-right">Ver todos los egresos</a>
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
            <form method="POST" action="{{ route('egreso.crear') }}">
                @csrf
                <h2 class="text-light text-center">Detalle de egresos</h2>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" class="text-light">Selecionar Categoria</label>
                        <select class="form-control" id="categoria" name="categoria" required>
                            <option value="" hidden></option>
                            <option value="Servicios">Servicios</option>
                            @foreach($typesExpenses as $typesExpense)
                            <option value="{{$typesExpense->name_type_expenses}}">{{$typesExpense->name_type_expenses}}</option>
                            @endforeach
                        </select>
                        @error('categoria')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <button type="button" class="btn text-light" data-toggle="modal" data-target="#categoriaModal">Agregar
                            nueva categoria</button>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input id="titulo_egreso" type="text" class="form-control @error('titulo_egreso') is-invalid @enderror" name="titulo_egreso" placeholder="Concepto del egreso" required autocomplete="título_egreso" autofocus>
                        @error('titulo_egreso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input id="fecha_egreso" type="date" class="form-control" name="fecha_egreso" required>
                        @error('fecha_egreso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <textarea id="descripcion_egreso" rows="4" class="form-control @error('descripcion_egreso') is-invalid @enderror" name="descripcion_egreso" required></textarea>
                        @error('descripcion_egreso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input id="precio_egreso" type="text" class="form-control @error('precio_egreso') is-invalid @enderror" name="precio_egreso" placeholder="Monto del egreso" required autocomplete="precio_egreso" autofocus>
                        @error('precio_egreso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="status_expense" name="status_expense">
                        <label class="form-check-label text-light" for="gridCheck">
                            Pendiente de pago
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Agregar Egreso</button>
            </form>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>



<!-- Modal Categoria-->
<div class="modal fade" id="categoriaModal" tabindex="-1" role="dialog" aria-labelledby="categoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoriaModalLabel">Agregar nueva categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('categotia.crear') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="name_type_expenses">Nombre nueva categoria</label>
                            <input id="name_type_expenses" type="text" class="form-control @error('name_type_expenses') is-invalid @enderror" name="name_type_expenses" placeholder="Nombre nueva categoria" required autocomplete="name_type_expenses" autofocus>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Descripción de nueva categoria</label>
                            <textarea id="description_type_expenses" class="form-control @error('description_type_expenses') is-invalid @enderror" name="description_type_expenses" required></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection