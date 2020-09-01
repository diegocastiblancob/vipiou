@extends('layouts.app')

@section('content')

<h2>Resumen Transacción</h2>
<h2>{{$estado}}</h2>
<table class="table">
    <tr>
        <td>Estado de la transaccion</td>
        <td>{{$estadoTx}}</td>
    </tr>
    <tr>
    <tr>
        <td>ID de la transaccion</td>
        <td>{{$transactionId}}</td>
    </tr>
    <tr>
        <td>Referencia de la venta</td>
        <td>{{$reference_pol}}</td>
    </tr>
    <tr>
        <td>Referencia de la transaccion</td>
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
        <td><?php echo ($extra1); ?></td>
    </tr>
    <tr>
        <td>Entidad:</td>
        <td><?php echo ($lapPaymentMethod); ?></td>
    </tr>
</table>

@endsection