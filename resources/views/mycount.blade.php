@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        @if (session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
        @endif
    </div>
    <div class="row mb-5">
        <div class="col-lg-8">
            <h2 class="mt-2 mb-4">Información personal</h2>
            <form method="POST" action="{{ route('user.update') }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                    <div class="col-md-6">
                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ Auth::user()->lastname }}" required autocomplete="lastname" autofocus>

                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="identification" class="col-md-4 col-form-label text-md-right">{{ __('Nro. Identificación') }}</label>

                    <div class="col-md-6">
                        <input id="identification" type="text" class="form-control @error('identification') is-invalid @enderror" name="identification" value="{{ Auth::user()->identification }}" required autocomplete="identification" autofocus>

                        @error('identification')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>



                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Actualizar información personal
                        </button>
                    </div>
                </div>

                <h2 class="mt-3 mb-4">Información de mi empresa</h2>
                <div class="form-group row">
                    <label for="name_company" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                    <div class="col-md-6">
                        <input id="name_company" type="text" class="form-control @error('name_company') is-invalid @enderror" name="name_company" value="{{ Auth::user()->name_company }}" required autocomplete="name_company" autofocus>

                        @error('name_company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nit_company" class="col-md-4 col-form-label text-md-right">{{ __('NIT') }}</label>

                    <div class="col-md-6">
                        <input id="nit_company" type="text" class="form-control @error('nit_company') is-invalid @enderror" name="nit_company" value="{{ Auth::user()->nit_company }}" required autocomplete="nit_company" autofocus>

                        @error('nit_company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Ciudad') }}</label>

                    <div class="col-md-6">
                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ Auth::user()->city }}" required autocomplete="city" autofocus>

                        @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ Auth::user()->address}}" required autocomplete="address" autofocus>

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                    <div class="col-md-6">
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ Auth::user()->phone }}" required autocomplete="phone" autofocus>

                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="owner_company" class="col-md-4 col-form-label text-md-right">{{ __('Representante legal') }}</label>

                    <div class="col-md-6">
                        <input id="owner_company" type="text" class="form-control @error('owner_company') is-invalid @enderror" name="owner_company" value="{{ Auth::user()->owner_company }}" required autocomplete="owner_company">

                        @error('owner_company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Actualizar información de la empresa
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            <h2>Información de pago</h2>
            <p class="mt-4"><b>Nombre de usuaio:</b> </p>
            <p><b>Correo electrónico:</b> </p>
            <p><b>Referencia de pago:</b> </p>
            <p><b>Fecha de pago:</b> </p>
            <p><b>Fecha vencimiento:</b> </p>
            <form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
                <input name="merchantId" type="hidden" value="{{$payment->merchantId}}">
                <input name="accountId" type="hidden" value="{{$payment->accountId}}">
                <input name="description" type="hidden" value="{{$payment->description}}">
                <input name="referenceCode" type="hidden" value="{{$payment->referenceCode}}">
                <input name="amount" type="hidden" value="{{$payment->amount}}">
                <input name="tax" type="hidden" value="{{$payment->tax}}">
                <input name="taxReturnBase" type="hidden" value="{{$payment->taxReturnBase}}">
                <input name="currency" type="hidden" value="{{$payment->currency}}">
                <input name="signature" type="hidden" value="{{$payment->signature}}">
                <input name="test" type="hidden" value="{{$payment->text}}">
                <input name="buyerEmail" type="hidden" value="{{$payment->buyerEmail}}">
                <input name="responseUrl" type="hidden" value="{{$payment->responseUrl}}">
                <input name="confirmationUrl" type="hidden" value="{{$payment->confirmationUrl}}">
                <input name="buyerFullName" type="hidden" value="{{$payment->buyerFullName}}">
                <input name="payerDocument" type="hidden" value="{{$payment->payerDocument}}">
                <input name="Submit" type="submit" class="btn btn-primary" value="Pagar">
            </form>
        </div>
    </div>
</div>
@endsection