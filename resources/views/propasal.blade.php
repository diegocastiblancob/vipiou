@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <button type="button" class="btn mb-5 float-right" *ngIf="vertodas==true">Exportar a Excel</button>
            <table class="table table-striped mt-5">
                <thead class="cabeza-tabla">
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proposals as $proposal)
                    @if($loop->index < 3)
                    <tr>
                        <th>{{$proposal->name_customer}} {{$proposal->lastname_customer}}</th>
                        <td>{{$proposal->title_proposal}}</td>
                        <td>{{$proposal->description_proposal}}</td>
                        <td>{{$proposal->date_proposal}}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>

            </table>
            <a href="{{route('propuestas')}}" class="btn mb-5 float-right">Ver todas las
                propuestas</a>
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
            <form method="POST" action="{{ route('propuesta.crear') }}">
                @csrf
                <h2 class="text-light text-center">Detalle de propuesta</h2>
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
                        <input id="title_proposal" type="text" class="form-control @error('title_proposal') is-invalid @enderror" name="title_proposal" placeholder="Titulo de la propuesta" required autocomplete="title_proposal" autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <input id="date_proposal" type="date" class="form-control @error('date_proposal') is-invalid @enderror" name="date_proposal" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <textarea id="description_proposal" rows="4" class="form-control @error('description_proposal') is-invalid @enderror" name="description_proposal" required></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <a href="" class="text-light">Subir archivo</a>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input id="proposal_action" type="text" class="form-control @error('proposal_action') is-invalid @enderror" name="proposal_action" placeholder="Titulo de la propuesta" required autocomplete="proposal_action" autofocus>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" class="text-light">Selecionar fecha de notificación</label>
                        <input id="date_action" type="date" class="form-control @error('date_action') is-invalid @enderror" name="date_action" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Agregar propuesta</button>
            </form>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>

@endsection