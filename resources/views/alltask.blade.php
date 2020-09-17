@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <a class="btn float-left mb-3" href="{{route('tarea')}}">Nueva tarea</a>
            <a href="{{url('/download/tareas')}}" class="btn float-right">Exportar a excel</a>
            <table class="table table-striped mt-5">
                <thead class="cabeza-tabla">
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Tarea</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha Entrega</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr data-toggle="modal" data-target="#Modal">
                        <th>{{$task->name_customer}} {{$task->lastname_customer}}</th>
                        <td>{{$task->title_task}}</td>
                        <td>{{$task->description_task}}</td>
                        <td>{{$task->date_task}}</td>
                        <td>
                            <a href="{{route('tarea.detalle', ['id'=>$task->task_id])}}">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection