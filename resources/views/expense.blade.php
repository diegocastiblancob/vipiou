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
                    @if($loop->index < 4)
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
                        <select class="form-control" id="name_type_expense" name="name_type_expense" required>
                            <option value="0" hidden></option>
                            @foreach($typesExpenses as $typesExpense)
                            <option value="{{$typesExpense->name_type_expenses}}">{{$typesExpense->name_type_expenses}}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn text-light" data-toggle="modal" data-target="#categoriaModal">Agregar
                            nueva categoria</button>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input id="title_expense" type="text" class="form-control @error('title_expense') is-invalid @enderror" name="title_expense" placeholder="Concepto del egreso" required autocomplete="title_expense" autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <input id="date_expense" type="date" class="form-control" name="date_expense" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <textarea id="description_expense" rows="4" class="form-control @error('description_expense') is-invalid @enderror" name="description_expense" required>
                        </textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input id="price_expense" type="text" class="form-control @error('price_expense') is-invalid @enderror" name="price_expense" placeholder="Monto del egreso" required autocomplete="price_expense" autofocus>
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
                            <label for="">Descripcion de nueva categoria</label>
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