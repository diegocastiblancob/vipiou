@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <table class="table mt-5 mb-5">
                <thead>
                    <th>Actividades de venta</th>
                    <th>Fecha de notificación</th>
                </thead>
                <tbody>
                    @foreach($activities as $activiy)
                    <tr>
                        <td>{{$activiy->action_proposal}}</td>
                        <td>{{$activiy->date_action}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table mt-5 mb-5">
                <thead>
                    <th>Tareas por realizar</th>
                    <th>Fecha de notificación</th>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->action_task}}</td>
                        <td>{{$task->date_action_task}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection