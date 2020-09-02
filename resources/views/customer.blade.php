@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-striped mt-5">
                <thead class="cabeza-tabla">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    <th rowspan="4" class="titulo-items">Clientes <br>Actuales</th>
                    @foreach($customers as $customer)
                    @if($loop->index < 3) <tr>
                        <td>{{$customer->name_customer}} {{$customer->lastname_customer}}</td>
                        <td>{{$customer->company_customer}}</td>
                        <td>{{$customer->email_customer}}</td>
                        </tr>
                        @endif
                        @endforeach
                </tbody>
            </table>
            <!-- Button trigger modal -->
            <button type="button" class="btn mb-1 float-right" data-toggle="modal" data-target="#ModalCliente">+</button>
        </div>
        <div class="cabeza-tabla col-12"></div>
        <div class="col-12 mt-4">
            <table class="table table-striped">
                <tbody>
                    <th rowspan="4" class="titulo-items">Clientes <br>Potenciales</th>
                    @foreach($customerPotencials as $customer)
                    @if($loop->index < 3) <tr>
                        <td>{{$customer->name_customer}} {{$customer->lastname_customer}}</td>
                        <td>{{$customer->company_customer}}</td>
                        <td>{{$customer->email_customer}}</td>
                        </tr>
                        @endif
                        @endforeach
                </tbody>
            </table>
            <!-- Button trigger modal -->
            <button type="button" class="btn mb-1 float-right" data-toggle="modal" data-target="#ModalCliente">+</button>
        </div>
        <div class="cabeza-tabla col-12"></div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 mt-3 mb-5 cajas">
            @if (session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
            <form method="POST" action="{{ route('cliente.crear') }}">
                @csrf
                <h3 class="text-light text-center">Registrar datos del nuevo cliente</h3>
                <div class="form-row mt-3">
                    <div class="input-group mb-3 col-md-6">
                        <input id="name_customer" type="text" class="form-control @error('name_customer') is-invalid @enderror" name="name_customer" placeholder="Nombre del cliente" required autocomplete="name_customer" autofocus>
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <input id="lastname_customer" type="text" class="form-control @error('lastname_customer') is-invalid @enderror" name="lastname_customer" placeholder="Apellido del cliente" required autocomplete="lastname_customer" autofocus>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group mb-3 col-md-6" include="form-input-select()">
                        <input id="identification_customer" type="text" class="form-control @error('identification_customer') is-invalid @enderror" name="identification_customer" placeholder="Identificación del cliente" required autocomplete="identification_customer" autofocus>
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <input id="city_customer" type="text" class="form-control @error('city_customer') is-invalid @enderror" name="city_customer" placeholder="Ciudad del ciente" required autocomplete="city_customer" autofocus>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group mb-3 col-md-6">
                        <input id="address_customer" type="text" class="form-control @error('address_customer') is-invalid @enderror" name="address_customer" placeholder="Dirección del cliente" required autocomplete="address_customer" autofocus>
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <input id="phone_customer" type="text" class="form-control @error('phone_customer') is-invalid @enderror" name="phone_customer" placeholder="Teléfono del cliente" required autocomplete="phone_customer" autofocus>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group mb-3 col-md-6">
                        <input id="email_customer" type="text" class="form-control @error('email_customer') is-invalid @enderror" name="email_customer" placeholder="Email del cliente" required autocomplete="email_customer" autofocus>
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <input id="company_customer" type="text" class="form-control @error('company_customer') is-invalid @enderror" name="company_customer" placeholder="Empresa del cliente" required autocomplete="company_customer" autofocus>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group mb-3 col-md-6">
                        <input id="website_customer" type="text" class="form-control @error('website_customer') is-invalid @enderror" name="website_customer" placeholder="Sitio web" required autocomplete="website_customer" autofocus>
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <select id="status_customer" type="text" class="form-control @error('status_customer') is-invalid @enderror" name="status_customer" required>
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
        <div class="col-lg-3"></div>
    </div>

    <!-- <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 mt-3 mb-5 caja">
            <form id="propuestaForm">
                <h2 class="titulo text-center">Detalle de propuesta comercial</h2>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" placeholder="Titulo" name="titulo" #titulo="ngModel" [(ngModel)]="propuesta.nombre" required pattern="[a-zA-Z ]+">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="date" class="form-control" name="fechaProp" #fechaProp="ngModel" [(ngModel)]="propuesta.fecha_propuesta">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <textarea name="" class="form-control" cols="30" rows="5" name="decripcionProp" #decripcionProp="ngModel" [(ngModel)]="propuesta.descripcion">

                        </textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <angular-file-uploader [config]="afuConfigArchivo" [resetUpload]="" (ApiResponse)="UploadArchivo($event)">
                        </angular-file-uploader>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" placeholder="Proxima Accion" name="acciones" #acciones="ngModel" [(ngModel)]="propuesta.proximas_acciones" required pattern="[a-zA-Z ]+">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" style="color: #fff;">Selecionar fecha de notificación</label>
                        <input type="date" class="form-control" name="notificacion" #notificacion="ngModel" [(ngModel)]="propuesta.fecha_notificacion">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" checked>
                        <label class="form-check-label" for="gridCheck" style="color: #fff;">
                            Deseo asociar una propuesta comercial
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-entrar float-right" (click)="validar()">Agregar
                    Cliente</button>
            </form>
        </div>
        <div class="col-lg-3"></div>
    </div> -->
</div>

<div class="modal fade" id="ModalCliente" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Información de mis clientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="actuales-tab" data-toggle="tab" href="#actuales" role="tab" aria-controls="actuales" aria-selected="true">Clientes Actuales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="potenciales-tab" data-toggle="tab" href="#potenciales" role="tab" aria-controls="potenciales" aria-selected="false">Clientes Potenciales</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade  show active" id="actuales" role="tabpanel" aria-labelledby="actuales-tab">
                        <!-- <form class="form-inline mt-2">
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" placeholder="Buscar Cliente" name="filtrar" [(ngModel)]="filtrar">
                            </div>
                            <button type="submit" class="btn btn-second mb-2">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form> -->
                        <table class="table table-striped">
                            <thead class="cabeza-tabla">
                                <tr>
                                    <th scope="col">Cédula</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Empresa</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Pagina Web</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>{{$customer->identification_customer}}</td>
                                    <td>{{$customer->name_customer}} {{$customer->lastname_customer}}</td>
                                    <td>{{$customer->company_customer}}</td>
                                    <td>{{$customer->phone_customer}}</td>
                                    <td>{{$customer->website_customer}}</td>
                                    <td>{{$customer->email_customer}}</td>
                                    <td>
                                        <a href="{{ route('cliente', ['id'=>$customer->id])}}">Ver</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="potenciales" role="tabpanel" aria-labelledby="potenciales-tab">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Cédula</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Empresa</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Pagina Web</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customerPotencials as $customer)
                                <tr>
                                    <td>{{$customer->identification_customer}}</td>
                                    <td>{{$customer->name_customer}} {{$customer->lastname_customer}}</td>
                                    <td>{{$customer->company_customer}}</td>
                                    <td>{{$customer->phone_customer}}</td>
                                    <td>{{$customer->website_customer}}</td>
                                    <td>{{$customer->email_customer}}</td>
                                    <td>
                                        <a href="{{ route('cliente', ['id'=>$customer->id])}}">Ver</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection