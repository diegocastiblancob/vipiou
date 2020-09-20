@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <a href="{{url('/download/tareas')}}" class="btn float-right">Exportar a excel</a>
            <table class="table table-striped mt-5">
                <thead class="cabeza-tabla">
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Tarea</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha Entrega</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    @if($loop->index < 3) <tr data-toggle="modal" data-target="#Modal">
                        <th>{{$task->name_customer}} {{$task->lastname_customer}}</th>
                        <td>{{$task->title_task}}</td>
                        <td>{{$task->description_task}}</td>
                        <td>{{$task->date_task}}</td>
                        </tr>
                        @endif
                        @endforeach
                </tbody>
            </table>
            <a class="btn btn-entrar mb-5 float-right" href="{{route('tareas')}}">Ver todos los
                tareas</a>
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
            <form method="POST" action="{{ route('tarea.crear') }}">
                @csrf
                <h2 class="text-light text-center">Detalle de tarea</h2>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" class="text-light">Selecionar cliente</label>
                        <select class="form-control" id="id_customer" name="id_customer" required>
                            <option value="" hidden></option>
                            @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name_customer}} {{$customer->lastname_customer}}</option>
                            @endforeach
                        </select>
                        @error('id_customer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input id="titulo_tarea" type="text" class="form-control @error('titulo_tarea') is-invalid @enderror" name="titulo_tarea" placeholder="Nombre de la tarea" required autocomplete="titulo_tarea" autofocus>
                        @error('titulo_tarea')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <input id="fecha_tarea" type="date" class="form-control @error('fecha_tarea') is-invalid @enderror" name="fecha_tarea" required>
                        @error('fecha_tarea')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <textarea id="descripcion_tarea" rows="4" class="form-control @error('descripcion_tarea') is-invalid @enderror" name="descripcion_tarea" required></textarea>
                        @error('descripcion_tarea')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="field_wrapper">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" name="field_action[]" placeholder="Próxima actividad">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <input type="date" class="form-control" name="field_date[]">
                        </div>
                        <div class="form-group col-md-2">
                            <a href="javascript:void(0);" class="add_button btn btn-primary float-right" title="Add field">+</a>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Agregar
                    tarea</button>
            </form>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var maxField = 12; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="form-row"><div class="form-group col-md-12"><input type="text" class="form-control" name="field_action[]" placeholder="Próxima actividad"></div></div><div class="form-row"><div class="form-group col-md-12"><input type="date" class="form-control" name="field_date[]"></div></div>'; //New input field html 
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
</script>
@endsection