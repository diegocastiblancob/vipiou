@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card cajas">
                <h4 class="text-center text-light">{{ __('Verifique su de correo electrónico') }}</h4>

                <div class="card-body text-light">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado un nuevo enlace de verificación a su correo electrónico.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, verifique su correo electrónico para ver un enlace de verificación.') }}
                    {{ __('Si no recibió el correo electrónico') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Haga clic aquí para solicitar otro') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
