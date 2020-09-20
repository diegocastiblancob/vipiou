@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <h3 class="mt-3 mb-2">Resumen Transacción</h3>
            <table class="table">
                <tr>
                    <td>Estado de la transacción</td>
                    <td>{{$estadoTx}}</td>
                </tr>
                <tr>
                    <td>ID de la transacción</td>
                    <td>{{$transactionId}}</td>
                </tr>
                <tr>
                    <td>Referencia de la venta</td>
                    <td>{{$reference_pol}}</td>
                </tr>
                <tr>
                    <td>Referencia de la transacción</td>
                    <td>{{$referenceCode}}</td>
                </tr>
                @if ($pseBank != null)
                <tr>
                    <td>cus </td>
                    <td>{{$cus}}</td>
                </tr>
                <tr>
                    <td>Banco</td>
                    <td>{{$pseBank}}</td>
                </tr>
                @endif
                <tr>
                    <td>Valor total</td>
                    <td>$<?php echo number_format($TX_VALUE); ?></td>
                </tr>
                <tr>
                    <td>Moneda</td>
                    <td>{{$currency}}</td>
                </tr>
                <tr>
                    <td>Descripción</td>
                    <td>{{$extra1}}</td>
                </tr>
                <tr>
                    <td>Entidad:</td>
                    <td>{{$lapPaymentMethod}}</td>
                </tr>
            </table>
            <a href="{{route('home')}}" class="btn btn-primary float-right mt-3 mb-5">Aceptar</a>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>

@endsection