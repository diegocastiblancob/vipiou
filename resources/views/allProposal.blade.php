@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <a class="btn float-left mb-3" href="{{route('propuesta')}}">Nueva propuesta</a>
            <button type="button" class="btn mb-5 float-right">Exportar a Excel</button>
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
                    <tr>
                        <th>{{$proposal->name_customer}} {{$proposal->lastname_customer}}</th>
                        <td>{{$proposal->title_proposal}}</td>
                        <td>{{$proposal->description_proposal}}</td>
                        <td>{{$proposal->date_proposal}}</td>
                        <td>
                            <a href="propuesta/{{$proposal->propasal_id}}">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection