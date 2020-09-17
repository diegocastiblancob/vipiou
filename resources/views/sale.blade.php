@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-4">
            <a href="{{url('/download/ventas')}}" class="btn float-right">Exportar a excel</a>
            <table class="table table-striped mt-5">
                <thead class="cabeza-tabla">
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Objeto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Financiación</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                    @if($loop->index < 4) <tr>
                        <td>{{$sale->name_customer}} {{$sale->lastname_customer}}</td>
                        <td>{{$sale->sale_target}}</td>
                        <td>{{$sale->sale_price}}</td>
                        <td>{{$sale->sale_credit}}</td>
                        <td>{{$sale->sale_date}}</td>
                        </tr>
                        @endif
                        @endforeach
                </tbody>
            </table>

            <a href="{{route('ventas')}}" class="btn mb-5 float-right">Ver todos los egresos</a>
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
            <form method="POST" action="{{ route('venta.crear') }}">
                @csrf
                <h2 class="text-light text-center">Detalle de la venta</h2>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="" class="text-light">Selecionar Cliente</label>
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
                        <input id="sale_target" type="text" class="form-control @error('sale_target') is-invalid @enderror" name="sale_target" placeholder="Nombre de la tarea" required autocomplete="sale_target" autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <input id="sale_date" type="date" class="form-control @error('sale_date') is-invalid @enderror" name="sale_date" placeholder="Nombre de la tarea" required autocomplete="sale_date" autofocus>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <textarea id="sale_description" rows="4" class="form-control @error('sale_description') is-invalid @enderror" name="sale_description" required>
                        </textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input id="sale_price" type="text" class="form-control @error('sale_price') is-invalid @enderror" name="sale_price" placeholder="Precio venta" required autocomplete="sale_price" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="chec" type="checkbox" id="chec" onChange="comprobar(this);">
                        <label class="form-check-label text-light" for="gridCheck">
                            Deseo financiar el contrato
                        </label>
                    </div>
                </div>
                <div id="financiar" style="display:none">
                    <h2 class="text-light text-center">Detalle de Financiación</h2>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="initial_fee" type="text" class="form-control @error('initial_fee') is-invalid @enderror" name="initial_fee" placeholder="Cuota inicial" autocomplete="initial_fee" autofocus>
                        </div>
                        <div class="form-group col-md-6">
                            <input id="no_fees" type="text" class="form-control @error('no_fees') is-invalid @enderror" name="no_fees" placeholder="No. de cuotas" autocomplete="no_fees" autofocus>
                        </div>
                    </div>
                    <div class="field_wrapper">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="field_price[]" placeholder="Cuota inicial">
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

                <button type="submit" class="btn btn-primary float-right">Crear
                    venta</button>
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
        var fieldHTML = '<div class="form-row"><div class="form-group col-md-6"><input type="text" class="form-control" name="field_price[]" placeholder="Cuota inicial"></div><div class="form-group col-md-5"><input type="date" class="form-control" name="field_date[]"></div><div class="form-group col-md-1"><a href="javascript:void(0);" class="remove_button" title="Remove field">-</a></div></div>'; //New input field html 
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
            document.getElementById('financiar').style.display = "";
        } else {
            document.getElementById('financiar').style.display = "none";
        }
    }
</script>


@endsection