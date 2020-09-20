@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn float-right mb-3" style="font-size: 11pt;" data-toggle="modal" data-target="#ModalEditar">Editar Información</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Cliente</th>
                        <td>{{$task->customer->name_customer}} {{$task->customer->lastname_customer}}</td>
                        <th scope="col">Fecha de inicio</th>
                        <td scope="col">{{$task->date_task}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Título</th>
                        <td colspan="3">{{$task->title_task}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Descripción</th>
                        <td colspan="3">{{$task->description_task}}</td>
                    </tr>
                </thead>
            </table>
            <table class="table mt-5">
                @if (session('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
                @endif
                <thead>
                    <tr>
                        <th scope="col">Actividades</th>
                        <th scope="col">Fecha de notificación</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($task->task_action as $action)
                    <tr>
                        <form method="POST" action="/accion/tarea/actualizar/{{$action->id}}">
                            @csrf
                            <td class="col-lg-6">
                                <div class="form-group">
                                    <input id="task_id" type="text" class="form-control" name="task_id" value="{{$task->id}}" required hidden>
                                    <input id="action_task" type="text" class="form-control @error('action_task') is-invalid @enderror" name="action_task" value="{{$action->action_task}}" required autofocus>
                                </div>
                            </td>
                            <td class="col-lg-4">
                                <div class="form-group">
                                    <input id="date_action_task" type="date" class="form-control" name="date_action_task" value="{{$action->date_action_task}}" required>
                                </div>
                            </td>
                            <td class="col-lg-1">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="col-lg-1">
                                <div class="form-group">
                                    <a href="{{route('acciontask.eliminar', ['id'=>$action->id])}}" class="btn btn-secondary float-right">
                                        X
                                    </a>
                                </div>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="cajas mb-5">
                <form method="POST" action="{{ route('acciontask.crear') }}">
                    @csrf
                    <h4 class="text-center text-light mb-3">Crear nuevas actividades</h4>
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="" class="text-light">Nombre de la acción</label>
                            <input id="action_task" type="text" class="form-control @error('action_task') is-invalid @enderror" name="action_task" placeholder="Nombre de la acción" required autocomplete="action_task" autofocus>
                            <input id="task_id" type="text" class="form-control" name="task_id" value="{{$task->id}}" required hidden>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="" class="text-light">Selecionar fecha de notificación</label>
                            <input id="date_action_task" type="date" class="form-control" name="date_action_task" required>
                        </div>
                        <div class="form-group col-md-2">
                            <button type="submit" class="btn btn-primary float-right mt-4">Agregar
                                Actividad</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modale Editar-->
<div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Editar información de la tarea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('tarea.actualizar', ['id' => $task->id]) }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Cliente</label>
                            <input id="name_customer" type="text" class="form-control" name="name_customer" value="{{$task->customer->name_customer}}" required disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="titulo_tarea" type="text" class="form-control @error('titulo_tarea') is-invalid @enderror" name="titulo_tarea" value="{{$task->title_task}}" required autofocus>
                            @error('titulo_tarea')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input id="fecha_tarea" type="date" class="form-control @error('fecha_tarea') is-invalid @enderror" name="fecha_tarea" value="{{$task->date_task}}" required>
                            @error('fecha_tarea')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea id="descripcion_tarea" rows="4" class="form-control @error('descripcion_tarea') is-invalid @enderror" name="descripcion_tarea" required>{{$task->description_task}}</textarea>
                            @error('descripcion_tarea')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Agregar
                        tarea</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection