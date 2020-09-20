@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center">Información del cliente</h3>
            <a class="btn float-left" href="{{route('cliente')}}">Todos los clientes</a>
            <button class="btn float-right" data-toggle="modal" data-target="#ModalEditar">Editar información personal</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <td>{{$customer->name_customer}} {{$customer->lastname_customer}}</td>
                        <th scope="col">No. de identificación</th>
                        <td scope="col">{{$customer->identification_customer}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Ciudad</th>
                        <td scope="col">{{$customer->city_customer}}</td>
                        <th scope="col">Celular</th>
                        <td scope="col">{{$customer->phone_customer}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Página Web</th>
                        <td scope="col">{{$customer->website_customer}}</td>
                        <th scope="col">Email</th>
                        <td scope="col">{{$customer->email_customer}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Dirección</th>
                        <td scope="col">{{$customer->address_customer}}</td>
                        <th scope="col">Empresa</th>
                        <td scope="col">{{$customer->company_customer}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Estado del cliente</th>
                        @if($customer->status_customer==2)<th scope="col">Cliente Actual</th>@endif
                        @if($customer->status_customer==3)<th scope="col">Cliente Potencial</th>@endif
                    </tr>
                </thead>
            </table>
            <table class="table mt-3">
                <thead class="cabeza-tabla">
                    <tr>
                        <th colspan="4">Ventas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customer->sale as $sale)
                    <tr>
                        <td>{{$sale->sale_target}}</td>
                        <td>{{$sale->sale_description}}</td>
                        <td>{{$sale->sale_date}}</td>
                        <td>
                            <a class="btn" href="{{route('venta.detalle', ['id'=>$sale->id])}}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table mt-3">
                <thead class="cabeza-tabla">
                    <tr>
                        <th colspan="4">Propuestas </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customer->proposal as $proposal)
                    <tr>
                        <td>{{$proposal->title_proposal}}</td>
                        <td>{{$proposal->description_proposal}}</td>
                        <td>{{$proposal->date_proposal}}</td>
                        <td>
                            <a class="btn" href="{{route('propuesta.detalle', ['id'=>$proposal->id])}}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table mt-3">
                <thead class="cabeza-tabla">
                    <tr>
                        <th colspan="4">Tareas </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customer->task as $task)
                    <tr>
                        <td>{{$task->title_task}}</td>
                        <td>{{$task->description_task}}</td>
                        <td>{{$task->date_task}}</td>
                        <td>
                            <a class="btn" href="{{route('tarea.detalle', ['id'=>$task->id])}}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Editar-->
<div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true" *ngIf="cliente!=null">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Editar información del cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('cliente.actualizar') }}">
                    @csrf
                    <div class="form-row mt-3">
                        <div class="input-group mb-3 col-md-6">
                            <input id="nombre_cliente" type="text" class="form-control @error('nombre_cliente') is-invalid @enderror" name="nombre_cliente" value="{{$customer->name_customer}}" required autofocus>
                            @error('nombre_cliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3 col-md-6">
                            <input id="apellido_cliente" type="text" class="form-control @error('apellido_cliente') is-invalid @enderror" name="apellido_cliente" value="{{$customer->lastname_customer}}" required autofocus>
                            @error('apellido_cliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3 col-md-2">
                            <input hidden id="id" type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{$customer->id}}" required autocomplete="id" autofocus>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group mb-3 col-md-6" include="form-input-select()">
                            <input id="identificacion_cliente" type="text" class="form-control @error('identificacion_cliente') is-invalid @enderror" name="identificacion_cliente" value="{{$customer->identification_customer}}" required autofocus>
                            @error('identificacion_cliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3 col-md-6">
                            <input id="ciudad_cliente" type="text" class="form-control @error('ciudad_cliente') is-invalid @enderror" name="ciudad_cliente" value="{{$customer->city_customer}}" required autofocus>
                            @error('ciudad_cliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group mb-3 col-md-6">
                            <input id="direccion_cliente" type="text" class="form-control @error('direccion_cliente') is-invalid @enderror" name="direccion_cliente" value="{{$customer->address_customer}}" required autofocus>
                            @error('direccion_cliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3 col-md-6">
                            <input id="telefono_cliente" type="text" class="form-control @error('telefono_cliente') is-invalid @enderror" name="telefono_cliente" value="{{$customer->phone_customer}}" required autofocus>
                            @error('telefono_cliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group mb-3 col-md-6">
                            <input id="email_customer" type="text" class="form-control @error('email_customer') is-invalid @enderror" name="email_customer" value="{{$customer->email_customer}}" required autocomplete="email_customer" autofocus>
                            @error('email_customer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3 col-md-6">
                            <input id="empresa_cliente" type="text" class="form-control @error('empresa_cliente') is-invalid @enderror" name="empresa_cliente" value="{{$customer->company_customer}}" required autofocus>
                            @error('empresa_cliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group mb-3 col-md-6">
                            <input id="website_cliente" type="text" class="form-control @error('website_cliente') is-invalid @enderror" name="website_cliente" value="{{$customer->website_customer}}" required autofocus>
                            @error('website_cliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3 col-md-6">
                            <select id="estado_cliente" type="text" class="form-control @error('estado_cliente') is-invalid @enderror" name="estado_cliente" value="{{$customer->status_customer}}" required>
                                <option value="" hidden>Estado Del Cliente</option>
                                <option value="2">Cliente</option>
                                <option value="3">Cliente potencial</option>
                            </select>
                            @error('estado_cliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Agregar cliente</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection