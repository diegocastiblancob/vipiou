@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center">Información del cliente</h3>
            <a class="btn float-left" href="/cliente">Todos los clientes</a>
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
                        <th colspan="4">Contratos</th>
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
                        <th colspan="4">Proyectos </th>
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
                            <input id="name_customer" type="text" class="form-control @error('name_customer') is-invalid @enderror" name="name_customer" value="{{$customer->name_customer}}" required autocomplete="name_customer" autofocus>
                        </div>
                        <div class="input-group mb-3 col-md-6">
                            <input id="lastname_customer" type="text" class="form-control @error('lastname_customer') is-invalid @enderror" name="lastname_customer" value="{{$customer->lastname_customer}}" required autocomplete="lastname_customer" autofocus>
                        </div>
                        <div class="input-group mb-3 col-md-2">
                            <input hidden id="id" type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{$customer->id}}" required autocomplete="id" autofocus>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group mb-3 col-md-6" include="form-input-select()">
                            <input id="identification_customer" type="text" class="form-control @error('identification_customer') is-invalid @enderror" name="identification_customer" value="{{$customer->identification_customer}}" required autocomplete="identification_customer" autofocus>
                        </div>
                        <div class="input-group mb-3 col-md-6">
                            <input id="city_customer" type="text" class="form-control @error('city_customer') is-invalid @enderror" name="city_customer" value="{{$customer->city_customer}}" required autocomplete="city_customer" autofocus>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group mb-3 col-md-6">
                            <input id="address_customer" type="text" class="form-control @error('address_customer') is-invalid @enderror" name="address_customer" value="{{$customer->address_customer}}" required autocomplete="address_customer" autofocus>
                        </div>
                        <div class="input-group mb-3 col-md-6">
                            <input id="phone_customer" type="text" class="form-control @error('phone_customer') is-invalid @enderror" name="phone_customer" value="{{$customer->phone_customer}}" required autocomplete="phone_customer" autofocus>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group mb-3 col-md-6">
                            <input id="email_customer" type="text" class="form-control @error('email_customer') is-invalid @enderror" name="email_customer" value="{{$customer->email_customer}}" required autocomplete="email_customer" autofocus>
                        </div>
                        <div class="input-group mb-3 col-md-6">
                            <input id="company_customer" type="text" class="form-control @error('company_customer') is-invalid @enderror" name="company_customer" value="{{$customer->company_customer}}" required autocomplete="company_customer" autofocus>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group mb-3 col-md-6">
                            <input id="website_customer" type="text" class="form-control @error('website_customer') is-invalid @enderror" name="website_customer" value="{{$customer->website_customer}}" required autocomplete="website_customer" autofocus>
                        </div>
                        <div class="input-group mb-3 col-md-6">
                            <select id="status_customer" type="text" class="form-control @error('status_customer') is-invalid @enderror" name="status_customer" value="{{$customer->status_customer}}" required>
                                <option value="0" hidden>Estado Del Cliente</option>
                                <option value="2">Cliente</option>
                                <option value="3">Cliente potencial</option>
                            </select>
                        </div>
                    </div>

                    <!--  <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check_propuesta" name="check_propuesta">
                        <label class="form-check-label text-light" for="gridCheck">
                            Deseo asociar una propuesta comercial
                        </label>
                    </div>
                </div> -->
                    <button type="submit" class="btn btn-primary float-right">Agregar cliente</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection