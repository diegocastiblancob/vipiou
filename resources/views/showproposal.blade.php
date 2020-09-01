@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <a class="btn float-left mb-3" href="{{route('propuestas')}}">Todas las propuestas</a>
            <button type="button" class="btn float-right mb-3" style="font-size: 11pt;" data-toggle="modal" data-target="#ModalEditar">Editar Información</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Cliente</th>
                        <td>{{$proposal->customer->name_customer}} {{$proposal->customer->lastname_customer}}</td>
                        <th scope="col">Fecha de envio</th>
                        <td scope="col">{{$proposal->date_proposal}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Titulo</th>
                        <td colspan="3">{{$proposal->title_proposal}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Descripción</th>
                        <td colspan="3">{{$proposal->description_proposal}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Ver Archivo Adjunto</th>
                        <td colspan="3">
                            <button type="button" class="btn">
                                <i class="fa fa-file float-left" style="color:#5BC4BF; font-size:30px" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                </thead>
            </table>
            <table class="table mt-4">
                @if (session('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
                @endif
                <thead>
                    <tr>
                        <th scope="col">Próximas actividades</th>
                        <th scope="col">Fecha de notificacion</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proposal->proposal_action as $action)
                    <tr>
                        <form method="POST" action="/accion/propuesta/actualizar/{{$action->id}}">
                            @csrf
                            <td class="col-lg-6">
                                <div class="form-group">
                                    <input id="proposal_id" type="text" class="form-control" name="proposal_id" value="{{$proposal->id}}" required hidden>
                                    <input id="action_proposal" type="text" class="form-control @error('action_proposal') is-invalid @enderror" name="action_proposal" value="{{$action->action_proposal}}" required autofocus>
                                </div>
                            </td>
                            <td class="col-lg-4">
                                <div class="form-group">
                                    <input id="date_action" type="date" class="form-control" name="date_action" value="{{$action->date_action}}" required>
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
                                    <a href="/accion/propuesta/eliminar/{{$action->id}}" class="btn btn-secondary float-right">
                                        X
                                    </a>
                                </div>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-12 cajas mb-5">

                <form method="POST" action="{{ route('accion.crear') }}">
                    @csrf
                    <h4 class="text-center text-light mb-3">Crear nueva actividad</h4>
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="" class="text-light">Nombre de la acción</label>
                            <input id="action_proposal" type="text" class="form-control @error('action_proposal') is-invalid @enderror" name="action_proposal" placeholder="Nombre de la acción" required autocomplete="action_proposal" autofocus>
                            <input id="proposal_id" type="text" class="form-control" name="proposal_id" value="{{$proposal->id}}" required hidden>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="" class="text-light">Selecionar fecha de notificación</label>
                            <input id="date_action" type="date" class="form-control" name="date_action" required>
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
<!-- Modal Editar-->
<div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" *ngIf="verPropuesta!=null">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Editar información de la propuesta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="actualizar/{{$proposal->id}}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Cliente</label>
                            <input id="name_customer" type="text" class="form-control" name="name_customer" value="{{$proposal->customer->name_customer}}" required disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="title_proposal" type="text" class="form-control @error('title_proposal') is-invalid @enderror" name="title_proposal" value="{{$proposal->title_proposal}}" required autocomplete="title_proposal" autofocus>
                        </div>
                        <div class="form-group col-md-6">
                            <input id="date_proposal" type="date" class="form-control @error('date_proposal') is-invalid @enderror" name="date_proposal" value="{{$proposal->date_proposal}}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea id="description_proposal" rows="4" class="form-control @error('description_proposal') is-invalid @enderror" name="description_proposal" value="{{$proposal->description_proposal}}" required></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <a href="" class="">Subir archivo</a>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Agregar propuesta</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection