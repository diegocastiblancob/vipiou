@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <a href="{{url('/download/propuestas')}}" class="btn float-right">Exportar a excel</a>
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
                    @if($loop->index < 3) <tr>
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
                <button type="submit" class="btn btn-primary float-right">Agregar propuesta</button>
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
</script>
@endsection