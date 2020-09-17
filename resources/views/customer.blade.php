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
                        @error('name_customer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <input id="lastname_customer" type="text" class="form-control @error('lastname_customer') is-invalid @enderror" name="lastname_customer" placeholder="Apellido del cliente" required autocomplete="lastname_customer" autofocus>
                        @error('lastname_customer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group mb-3 col-md-6" include="form-input-select()">
                        <input id="identification_customer" type="text" class="form-control @error('identification_customer') is-invalid @enderror" name="identification_customer" placeholder="Identificación del cliente" required autocomplete="identification_customer" autofocus>
                        @error('identification_customer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <input id="city_customer" type="text" class="form-control @error('city_customer') is-invalid @enderror" name="city_customer" placeholder="Ciudad del cliente" required autocomplete="city_customer" autofocus>
                        @error('city_customer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group mb-3 col-md-6">
                        <input id="address_customer" type="text" class="form-control @error('address_customer') is-invalid @enderror" name="address_customer" placeholder="Dirección del cliente" required autocomplete="address_customer" autofocus>
                        @error('address_customer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <input id="phone_customer" type="text" class="form-control @error('phone_customer') is-invalid @enderror" name="phone_customer" placeholder="Teléfono del cliente" required autocomplete="phone_customer" autofocus>
                        @error('phone_customer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group mb-3 col-md-6">
                        <input id="email_customer" type="text" class="form-control @error('email_customer') is-invalid @enderror" name="email_customer" placeholder="Email del cliente" required autocomplete="email_customer" autofocus>
                        @error('email_customer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <input id="company_customer" type="text" class="form-control @error('company_customer') is-invalid @enderror" name="company_customer" placeholder="Empresa del cliente" required autocomplete="company_customer" autofocus>
                        @error('company_customer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group mb-3 col-md-6">
                        <input id="website_customer" type="text" class="form-control @error('website_customer') is-invalid @enderror" name="website_customer" placeholder="Sitio web" required autocomplete="website_customer" autofocus>
                        @error('website_customer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <select id="status_customer" type="text" class="form-control @error('status_customer') is-invalid @enderror" name="status_customer" required>
                            <option value="0" hidden>Estado Del Cliente</option>
                            <option value="2">Cliente</option>
                            <option value="3">Cliente potencial</option>
                        </select>
                        @error('status_customer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="chec" type="checkbox" id="chec" onChange="comprobar(this);">
                        <label class="form-check-label text-light" for="gridCheck">
                            Deseo asociar una propuesta comercial
                        </label>
                    </div>
                </div>
                <div id="propuesta" style="display:none">
                    <h3 class="text-light text-center">Detalle de propuesta comercial</h3>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="title_proposal" type="text" class="form-control @error('title_proposal') is-invalid @enderror" name="title_proposal" placeholder="Titulo de la propuesta" autocomplete="title_proposal" autofocus>
                            @error('title_proposal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input id="date_proposal" type="date" class="form-control @error('date_proposal') is-invalid @enderror" name="date_proposal">
                            @error('date_proposal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <textarea id="description_proposal" rows="4" class="form-control @error('description_proposal') is-invalid @enderror" name="description_proposal"></textarea>
                            @error('description_proposal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="field_wrapper">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="field_action[]" placeholder="Proxima acción">
                            </div>
                            <div class="form-group col-md-5">
                                <input type="date" class="form-control" name="field_date[]">
                            </div>
                            <div class="form-group col-md-1">
                                <a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field">+</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Agregar cliente</button>
            </form>
        </div>
        <div class="col-lg-3"></div>
    </div>
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
                        <a href="{{url('/download/clientes')}}" class="bnt float-right">Exportar a excel</a>
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
                                        <a href="{{ route('cliente.detalle', ['id'=>$customer->id])}}">Ver</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="potenciales" role="tabpanel" aria-labelledby="potenciales-tab">
                        <a href="{{url('/download/clientes')}}" class="btn float-right">Exportar a excel</a>
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
                                        <a href="{{ route('cliente.detalle', ['id'=>$customer->id])}}">Ver</a>
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
<script type="text/javascript">
    $(document).ready(function() {
        var maxField = 12; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="form-row"><div class="form-group col-md-6"><input type="text" class="form-control" name="field_action[]" placeholder="Proxima acción"></div><div class="form-group col-md-5"><input type="date" class="form-control" name="field_date[]"></div><div class="form-group col-md-1"><a href="javascript:void(0);" class="remove_button" title="Remove field">-</a></div></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        $(addButton).click(function() { //Once add button is clicked
            if (x < maxField) { //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
            }
        });
        $(wrapper).on('click', '.remove_button', function(e) { //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    function comprobar(obj) {
        if (obj.checked) {
            document.getElementById('propuesta').style.display = "";
        } else {
            document.getElementById('propuesta').style.display = "none";
        }
    }
</script>
@endsection