@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn mb-5 float-right">Exportar a Excel</button>
            <table class="table table-striped mt-5">
                <thead class="cabeza-tabla">
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Proyecto</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha Entrega</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    @if($loop->index < 3) <tr data-toggle="modal" data-target="#Modal">
                        <th>{{$task->name_customer}} {{$task->lastname_customer}}</th>
                        <td>{{$task->title_task}}</td>
                        <td>{{$task->description_task}}</td>
                        <td>{{$task->date_task}}</td>
                        </tr>
                        @endif
                        @endforeach
                </tbody>
            </table>
            <a class="btn btn-entrar mb-5 float-right" href="{{route('tareas')}}">Ver todos los
                proyectos</a>
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
            <form method="POST" action="{{ route('tarea.crear') }}">
                @csrf
                <h2 class="text-light text-center">Detalle de proyecto</h2>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" class="text-light">Selecionar cliente</label>
                        <select class="form-control" id="id_customer" name="id_customer" required>
                            <option value="0" hidden></option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name_customer}} {{$customer->lastname_customer}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input id="title_task" type="text" class="form-control @error('title_task') is-invalid @enderror" name="title_task" placeholder="Nombre de la tarea" required autocomplete="title_task" autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <input id="date_task" type="date" class="form-control @error('date_task') is-invalid @enderror" name="date_task" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <textarea id="description_task" rows="4" class="form-control @error('description_task') is-invalid @enderror" name="description_task" required></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input id="action_task" type="text" class="form-control @error('action_task') is-invalid @enderror" name="action_task" placeholder="Próxima actividad" required autocomplete="action_task" autofocus>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" class="text-light">Selecionar fecha de la actividad</label>
                        <input id="date_action_task" type="date" class="form-control @error('date_action_task') is-invalid @enderror" name="date_action_task" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Agregar
                    tarea</button>
            </form>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>

@endsection